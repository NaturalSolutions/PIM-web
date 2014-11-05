<?php

require_once('PIMimport.inc');

/***********************************************************************************************************
 * 					FONCTIONS IMPORT DES DONNEES DANS LA BASE
************************************************************************************************************/

/** Fonction qui lance un processus batch d'import des données dans la base
**@param : $form associative array = Stucture du formulaire
**@param : $form_state keyed array = Contient variable saisie par l'utilisate
**/
function custom_import_batch(&$form, &$form_state){
	//Récupération du mapping d'import sélectionné par l'utilisateur
	$importType =  $form_state['values']['import_type'];

	include('mappings/'.$importType.'.mapping'); 	
	$tableName =$form_state['storage']['values']['tableName'];
	$fileName =$form_state['storage']['values']['fileName'];
	//COnfiguration du batch
	$batch = array(
		'finished' => 'batch_test_finished',
		'title' => t('Importing'),
		'error_message' => t('The import has encountered an error.'),
		'progressive' => TRUE,
		'file'=>'PIMimport.inc',
	);
	
	// Récupération des mappings spécifiant l'import
  $mappings = _getMappingNodeSelectImportableData($tableName);
  //Pour chaque unité de mapping (c-a-d type de contenu)
	foreach ($mappings as $key=>$mappingUnit) {
		//Calcul du nombre de taches à réaliser
		$sql =$mappingUnit['query'] ;
		$sql = "SELECT COUNT(*) AS records_nb FROM ( ".$sql." ) AS query";
		$records = db_query($sql);
		while ($record = db_fetch_array($records)) {
			$line_number = $record['records_nb'];
		}
		//Attribution des opérations au batch
		$batch['operations'][]= array('csv_import_batch_process',array($key, $mappingUnit, $line_number , $tableName, $fileName));
	}
	//Lancement du batch 
	batch_set($batch);
}


function batch_test_finished($success, $results, $operations) {
	unset($_SESSION['custom_import_results']);
	if ($success) {
		$message = format_plural(count($results), 'One post processed.', '@count records processed.');
	}
	else {
		$message = t('Finished with an error.');
	}
	if (is_array($results['mapping'] )) {  
	  foreach ($results['mapping'] as $key=> $result) {
		$messageUnitText .= "<span class='field-label'>".$result['title']."</span><ul>";
		$messageUnitText .= "<li><b>".t('Node created').": </b>".$result['create']."</li>";
		$messageUnitText .= "<li><b>".t('Node updated').": </b>".$result['update']."</li>";
		$messageUnitText .= "<li><b>".t('Error').": </b>".$result['error']."</li>";
		$messageUnitText .= "</ul>";
	  }
	}
	
	$_SESSION['custom_import_results']['message']['summary_result']=$messageUnitText;
	//Traitement des logs
	if (is_array($results['log'] )) {  
		insertLogs ( $results['log'] ['uid'], $results['log'] ['logCreated'], $results['log'] ['logUpdated'], $results['log'] ['filename']) ;
	}
}

/**
 * Fonction qui lance les import et controle la progression du batch
**@param : $key String: Identifiant de l'unité de mapping
**@param : $mapping Array : paramètres d'import
**@param : $line_number int : nombre de ligne à traiter
**@param : $tableName Strong : nom de la table sql où les données sont loadées
**@param : &$context array : Context du batch
 */
function csv_import_batch_process($key,$mapping,  $line_number, $tableName, $fileName,  &$context) {

	global $user;
	$uid = $user->uid;
	$context['results']['log']['filename'] =  $fileName;
	$context['results']['log']['uid'] = $uid ;
	//Gestion de la progression du batch
	$context['results']['mapping'][$key]['title'] = $mapping['name'];	
    if (empty($context['sandbox'])) {
		$context['sandbox']['progress'] = 0;
		$context['sandbox']['max'] =$line_number;
	}
	$limit = 5;
	$sql =$mapping['query'] ;
	
	//Récupération des l'enregistrements a traiter dans l'itération du batch
	$result = db_query_range("SELECT * FROM ( $sql ) AS q WHERE importid > %d ORDER BY importid ASC", $context['sandbox']['current_node'], 0,1); 
	$titleField = $mapping['titleField'];
	//Pour chaque ligne : création d'un noeud + récupération des messages
	while ($row = db_fetch_array($result)) {
		$message = batchgenerateNodeObject($key,$mapping, $row, $uid) ;
		$context['sandbox']['current_node'] = $row['importid'];
		$context['results'][] = $row[$titleField];
		$context['results']['mapping'][$key]['create'] += $message['create'] ;
		$context['results']['mapping'][$key]['update'] += $message['update'] ;
		$context['results']['mapping'][$key]['error'] +=$message['error'] ;
		$context['sandbox']['progress']++;
		$context['message'] = $key."--" .$row[$titleField];
		$context['results']['log']['logCreated']  .= $message['logCreated'];
		$context['results']['log']['logUpdated']  .= $message['logUpdated'];
	}
	if ($context['sandbox']['progress'] != $context['sandbox']['max']) {
		$context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
	}
}
/** Fonction qui controle la création d'un noeud à partir d'un enregistrement
**@param : $key String: Identifiant de l'unité de mapping
**@param : $mappingUnit Array : paramètres d'import
**@param : $record Record : Enregistrement à insérer
**@param : $uid int : identifiant de l'utilisateur
 */
function batchgenerateNodeObject($key,$mappingUnit, $record, $uid) {
	//Paramètres globaux aux noeuds créés
	$cfdebuglevel = 3; // 0 = no debug; 1 = error; 2 = warning; 3 = info; 4 = debug
	$nodepromoted = 0;
	$nodesticky = 0;
	//Pour chaque mapping défini
	// Une unité de mapping correspond à un type de contenu
	$contenttype = $mappingUnit['contentType'];
	$titleField = $mappingUnit['titleField'];
	// Le charger node_load
	//Le modifier
	$isupdatable = $mappingUnit['update'];
	$nodeLoadId= $mappingUnit['updateNidField'];
	$message=array();
	$message['title']= $mappingUnit['name'];		
	$nbcreate=0;
	$nbupdate=0;
	$nberror=0;
	//Pour chaque enregistrement => Création d'un noeud
	if ($record) {
		$node = getOrCreateNode($isupdatable, $mappingUnit['updateSelectNid'] ,  $record['importid']);
		$isNew = $node->is_new;
		$node->type = $contenttype; 
		$node->status = 1;
		$node->title = $record[$titleField]; 
		// Traitement des champs CCK
		//Pour chaque champs
		$fields = $mappingUnit['fields'];
		foreach ($fields as $field) {
			//print '<br/> A :'.$field['name'];
			$recValue = $record[$field['importTableField']];
			if(  ! ((! $isNew) && (getNodeFieldValue($node->$field['contentField'], $field['typeImpl']) !='' ) ) 
								&& ((! is_null( $recValue)) || ($recValue !=''))){
				$fieldvalue = generateFieldValue($field,  $recValue);
				if ($fieldvalue) {
					$node->$field['contentField'] = array();
					$node->$field['contentField'] = $fieldvalue ;
				}
			}
		}
		//Création du noeud dans la base physiquement
		try {
			//node_validate($node);
			$node = node_submit($node);
			$node->uid = $uid;
			$status = node_save($node); 
			$nid = $node->nid;
			//DEBUG Level Info
			if (((is_null($initialChanged)) && (! is_null($node->changed ))) || ((! is_null($initialChanged)) && ($node->changed > $initialChanged)) ) {
				if ($isNew ) {
					$logCreated  .=$nid.",";
					$nbcreate++;
				}
				else  {
					$logUpdated.=$nid.",";
					$nbupdate++;
				}
			}
			else {
				$nberror++;
			}
			$message['create'] = $nbcreate;
			$message['update'] = $nbupdate;
			$message['logCreated'] = $logCreated;
			$message['logUpdated'] = $logUpdated;
			$message['error'] = $nberror;
		}
		catch (Exception $e){
			drupal_set_message("... Error: ".$e);
		}
	 }
	return $message; 
}



/** Fonction qui renvoie un noeud 
 ** Si ajout -> créer un noeud 
 ** Sinon charge le noeud
**@param : $field array() = Ensemble des données relative au champ CCK à importer
**@param : $recValue String = Valeur à importer
**/
function getOrCreateNode($isupdatable, $sqlupdateSelectNid, $importRowid ) {
	//Si le mapping permet la modification des noeuds alors
	$isNew = true;
	if ($isupdatable ) {
		$nload =-1;
		/// Rechercher le noeud existant
		$sqlupdateSelectNid = str_replace("XXupdateSelectNidXX", $importRowid, $sqlupdateSelectNid);
		$resultnid = db_query($sqlupdateSelectNid);
		while ($recnid= db_fetch_array($resultnid)) {
				$nload = $recnid['nid'] ;
		}
		if ($nload>-1 ) {
			$node = node_load($nload);
			//Permet de vérifier si la fonction node_save c'est bien passée
			$initialChanged =$node->changed ;
			//Mise à jour de la date de modification nécessaire pour l'invocation de node_validate
			$node->changed = mktime(Date("Y.m.d H:i:s"));
			$isNew = false;
		}
	}
	if ($isNew) {
		$node = new stdClass();
	}
	$node->is_new = $isNew; 
	return $node;
}


/** Fonction qui génére le contenu d'un champ CCK
**@param : $field array() = Ensemble des données relative au champ CCK à importer
**@param : $recValue String = Valeur à importer
**/
function generateFieldValue($field, $recValue) {
     //Delta correspond a l'indice de la valeur pour le champ X (peut être incrémenté dans le cas des données nultivaluées) 
    $delta=0;
    $fieldvalue = array();
    $values = array();
    if ($field['mutlivalue']) {
         $values= explode(",",  $recValue);
    }
    else {
         $values[0] = $recValue;  
    }
    for($delta = 0; $delta < count($values); $delta++){
        //Netoyage de la valeur : suppression des espaces devant et après la valeur
        $values[$delta] = trim($values[$delta]);
         switch ($field['type']) {
              case 'taxonomy':
                    $tid =getTermIdFromValue ($values[$delta],$field['taxonomyVoc'], $field['taxonomyOpen']) ;
                    if ($tid>0) {
                       $fieldvalue [$delta][$field['typeImpl']]=$tid ;
                    }
                    break;
                case 'geoData':
                    $fieldvalue [$delta] = createGeoDataArray($values[$delta]) ;
                    break;
                default:
                    $fieldvalue [$delta][$field['typeImpl']]= $values[$delta];  
                    break;
        }
    }
    return  $fieldvalue;
}

/** Fonction qui génére le contenu d'un champ CCK de type geoData
		TODO => Pour le moment uniquement import de points
					=> Ajouter des vérification sur le formatage du champ coordonnées
**@param : $coordinates String = Valeur à importer format Lat Lon
**/
function createGeoDataArray ($coordinates) {
	$cooArray = explode(" ", $coordinates);
	$item = array();
	$item['geo']= array();
	$item['geo']['lat']=$cooArray[0];
	$item['geo']['lon']=$cooArray[1];
	return $item;
}

/**Fonction qui créer le tableau associatif de la valeur d'une propriété

**/
function getNodeFieldValue($nodeField, $type) {
	foreach ($nodeField as $delta => $val) {
		if ($val[$type]) $value .=$val[$type] .",";
	}
	return $value;
}


/*****************************************************************************
************			Fonctions de logs
*****************************************************************************/
function insertLogs ( $uid, $nodeCreated, $nodeUpdated, $fileName) {
	$row = new stdClass();
	$row->uid = $uid;
	$row->log_date = Date("Y.m.d H:i:s");
	$row->nodes_created = $nodeCreated;
	$row->nodes_updated = $nodeUpdated;
	$row->file_name = $fileName;
	drupal_write_record('custom_import_logs', $row);
}

/*****************************************************************************
************			Fonctions en relation avec le tésaurus
*****************************************************************************/

/** Fonction qui renvoie l'identifiant thésaural d'un terme à partir de son nom
**@param : $term String = Nom du terme
**@param : $vid int = Identifiant du vocabulaire de la terminologie
**@param : $ isOpen boolean = spécifie si la liste thésaurale est ouverte ou non. 
		Si ouverte alors ajout du terme au vocabulaire s'il n'existe pas 
**@return : identifiant du terme. Si le terme n'existe pas et que la liste est fermée revoie -1
**/
function getTermIdFromValue ($term,$vid, $isOpen) {
    $tid=-1;
    $query = db_query("SELECT tid FROM {term_data} WHERE name='%s' and vid=%d", $term,$vid);
    $possible_term = db_fetch_object($query);
    //if the term doesn't already exist, add it to the cloud
    if  (!$possible_term->tid) {
        if ($isOpen) {
            $new_term = array('vid' => $vid, 'name' => $term);
            if (taxonomy_save_term($new_term)) {
               $tid = $new_term['tid'];
            }
        }
    }
    else {
        $tid= $possible_term->tid;
    }
	
    return $tid;
}


/*****************************************************************************
************			Fonctions de validation des données de WORMS
*****************************************************************************/

function _checkWORMSTaxa ($checkunit, $tableName) {

	$sql = "SELECT  CAST(GROUP_CONCAT(importid +1 ) AS CHAR)  as invalidLine, ".$checkunit['field']." AS taxonName FROM $tableName  GROUP BY ".	$checkunit['field']." ";
	$records = db_query($sql);
	$errorLine='';
	while ($record = db_fetch_array($records)) {
		$taxonName= $record['taxonName'];
		$result = getWORMS_ID_AphiaRecords_by_Name($taxonName);
		if (empty($result))  $errorString .=' '.$record['invalidLine']. ' (' . $taxonName .'),' ;
		else {
			if (!$result['id']) $errorString .=' '.$record['invalidLine']. ' (' . $taxonName .'),' ;
		}
	}
	return $errorString;
}

function getWORMS_ID_AphiaRecords_by_Name($taxonString) {
	$taxon=import_search_worms_AphiaRecords_by_likeName($taxonString) ;
	if (!empty($taxon)) {
		foreach ($taxon as $key => $value) {
			$result = array('id'=>$value->valid_AphiaID, 'valid_name'=>$value->valid_name);
		}
	}
	return $result;
}


function import_search_worms_AphiaRecords_by_likeName($taxonString) {
	$client = new SoapClient("http://www.marinespecies.org/aphia.php?p=soap&wsdl=1");
	$taxon=$client->getAphiaRecords($taxonString);
	return $taxon;
}

