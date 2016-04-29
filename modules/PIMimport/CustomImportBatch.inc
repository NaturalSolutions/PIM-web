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
	//WARNING : ne jamais faire de print dans le mode batch (debug = FALSE)
  // !!Attention pour chaque field les hook_formatter_[displayname] sont appelés!!
	$debug = FALSE;
	
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
		//'file'=>'PIMimport.inc',
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
  if ($line_number == 0) {
    unset($_SESSION['custom_import_results']);
    $_SESSION['custom_import_results']['message']['summary_result']='No data to import';
    return true;
  }
	//Lancement du batch 
	if ($debug) {
		mybatch_set($batch);
	}
	else {
		batch_set($batch);
	}
}
/**********************/
/* used in debug only */
function mybatch_set($batch) {
  $mycontext = array();
  
  $success = TRUE;
  
  foreach($batch['operations'] as $batchop) {
    $func = $batchop[0];
    $key = $batchop[1][0];
    $mappingUnit = $batchop[1][1];
    $line_number = $batchop[1][2];
    $tableName = $batchop[1][3];
    $fileName = $batchop[1][4];
    
    $success0 = $func($key,$mappingUnit,$line_number,$tableName,$fileName,$mycontext,TRUE);
    $success = ($success and $success0);
    
  }
  batch_test_finished($success, $mycontext['results'], array());
}
/**************/

function batch_test_finished($success, $results, $operations) {
	unset($_SESSION['custom_import_results']);
	
	
	if ($success) {
		$message = format_plural(count($results), 'One post processed.', '@count records processed.');
	}
	else {
		$message = t('Finished with an error.');
	}

	if ($results['debug_mod']) {
		$messageUnitText = "<div class='field-label'>Debug mod TRUE </div>";
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
	
	//Suppression de la table d'import
	cancelImport($results['tableName']);
}

/**
 * Fonction qui lance les import et controle la progression du batch
**@param : $key String: Identifiant de l'unité de mapping
**@param : $mapping Array : paramètres d'import
**@param : $line_number int : nombre de ligne à traiter
**@param : $tableName Strong : nom de la table sql où les données sont loadées
**@param : &$context array : Context du batch
 */
function csv_import_batch_process($key,$mapping,  $line_number, $tableName, $fileName,  &$context, $debug=FALSE) {

	global $user;
	$uid = $user->uid;
	$context['results']['tableName'] = $tableName;
	$context['results']['debug_mod']= $debug;
	$context['results']['log']['filename'] =  $fileName;
	$context['results']['log']['uid'] = $uid ;
	//Gestion de la progression du batch
	$context['results']['mapping'][$key]['title'] = $mapping['name'];	
  if (empty($context['sandbox'])) {
		$context['sandbox']['progress'] = 0;
		$context['sandbox']['max'] =$line_number;
	}
	$limit = 50;
	$sql =$mapping['query'] ;
	
	//Récupération des l'enregistrements a traiter dans l'itération du batch
	if ($debug) {
		$result = db_query($sql); 	
	} 
	else {
		$result = db_query_range("SELECT * FROM ( $sql ) AS q WHERE importid > %d ORDER BY importid ASC", $context['sandbox']['current_node'], 0,$limit); 
	}
	
	$titleField = $mapping['titleField'];
	//Pour chaque ligne : création d'un noeud + récupération des messages
	while ($row = db_fetch_array($result)) {
		$message = batchgenerateNodeObject($key,$mapping, $row, $uid) ;
    if ($debug == TRUE) {
      if (!isset($message) or empty($message)) {
        return FALSE;
      }
    }
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
  if ($debug == TRUE) {
    return TRUE;
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
	$separator =  ',';
	if (isset($mappingUnit['multivalueSeparator'])) {
		$separator =  $mappingUnit['multivalueSeparator'];
	}
	
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
		$NodeChanged = FALSE;
	
	foreach ($fields as $field) {
		$recValue = trim($record[$field['importTableField']]);
		
		if (!isset($recValue) || ($recValue === '')) {
			if (isset($field['default'])) $recValue = $field['default'];
			//else continue;
		}
		if ($isNew) {
			$fieldvalue = generateFieldValue($field,  $recValue, NULL, $separator );
		} 
		else {
			$fieldvalue = generateFieldValue($field,  $recValue, getNodeFieldValue($node->$field['contentField'], $field['typeImpl']), $separator );
		}
		
		if (!isset($recValue) || ($recValue === '')) {
			if ($isNew) $fieldvalue = array(); else continue;
		}
		
		if (isset($fieldvalue)) {
			$NodeChanged = TRUE;
			$node->$field['contentField'] = array();
			$node->$field['contentField'] = $fieldvalue ;
		}
	}
	
  if ($NodeChanged == FALSE) {
      $message['create'] = $nbcreate;
			$message['update'] = $nbupdate;
			$message['logCreated'] = $logCreated;
			$message['logUpdated'] = $logUpdated;
			$message['error'] = $nberror;
      return $message;
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
			$node = node_load($nload, NULL, True); // Note GB 4-nov-2014 : set $reset param to True to disable node caching beacause there may be multiple lines for the same node in a dataset
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
**@param : $dbValue field = Valeur existante dans le noeud
**@param : $separator String = Séprateur de champ pour le cas des champs multivalue
**/
function generateFieldValue($field, $recValue, $dbValue=NULL, $separator=",") {
    //$recValue déjà testée: elle contient une valeur
    //Delta correspond a l'indice de la valeur pour le champ X (peut être incrémenté dans le cas des données nultivaluées) 
    $delta=0;
    $fieldvalue = array();
    $values = array();
    
		
    if ($field['mutlivalue']) {
      //print "string values: ".$recValue."<br/>";
      $values= explode($separator,  $recValue);
      array_walk($values, 'arrayTrim');
      if (isset($field['formatFunc']))  array_walk($values, $field['formatFunc']);
      
       
      if (isset($dbValue) and (!empty($dbValue) or ($dbValue <> ''))) {
        $dbValueList = explode(",",  $dbValue);
      //Si le champ est de type thésaural => remplacement de l'id du term par son name
      if ($field['type'] =='taxonomy') {
          $dbValueListName= array();
          foreach($dbValueList as $dbValuetid) {
            $dbValueListName[] = taxonomy_get_term($dbValuetid)->name;
          }
           $dbValueList = $dbValueListName;
        }
        //print "dbList tid: ";var_dump($dbValueList);print "<br/>";
        array_walk($dbValueList, 'arraySetTermName');
        //print "dbList names: ";var_dump($dbValueList);print "<br/>";
        
        //trouve les valeurs à ajouter
        $dbValueList = array_unique (array_filter($dbValueList));
        $values = array_unique (array_filter($values));
        $diffValues = array_diff($values, $dbValueList);

        if ((!isset($diffValues)) or empty($diffValues)) return NULL;
        //concatène les nouvelles valeurs avec les valeurs existantes
        foreach($diffValues as $value2add) {
          $dbValueList[] = $value2add;
        }
       //if (($field['name'] == "field_bd_t_protection") or ($field['name'] == "field_bd_t_uicn_pays")) {
        //print "dbList final: ";var_dump($dbValueList);print "<br/>";
        //print "diffList: ";var_dump($diffValues);print "<br/>";
        
        $values = $dbValueList;
      }
    }
    else {
			
         if (isset($dbValue) and ($dbValue !== '') and ($dbValue === $recValue)) {
           return NULL;
         }
         $values[0] = $recValue;
    }
    
    for($delta = 0; $delta < count($values); $delta++){
			$values[$delta] = trim($values[$delta]);
			switch ($field['type']) {
				case 'taxonomy':
					$name= $values[$delta];
					$description = '';
					$synonyms='';
					if ($field['taxonomyDesc']) {
						$tax = explode("|", $name);
						$name= $tax [0];
						$description = $tax [1];
						$synonyms= $tax [2];
					}
					$tid =getTermIdFromValue ($name,$field['taxonomyVoc'], $field['taxonomyOpen'],$field['taxonomyFather'], $description, $synonyms) ;
					if ($tid>0) {
						$fieldvalue[$delta][$field['typeImpl']]=$tid ;
					} else if ($delta == 0) {
						$fieldvalue = NULL;
					}
					//print "fieldval: " .var_dump($fieldvalue);
					break;
				case 'geoData':
					$fieldvalue[$delta] = createGeoDataArray($values[$delta]) ;
					break;
				default:
					$fieldvalue[$delta][$field['typeImpl']]= $values[$delta];  
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

/**Fonction qui créée le tableau associatif de la valeur d'une propriété

**/
function getNodeFieldValue($nodeField, $type) {
  $i = 0;
	foreach ($nodeField as $delta => $val) {
		if ($val[$type]) {
      if ($i > 0) $value .= ",". $val[$type];
      else $value = $val[$type];
    }
    $i++;
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
************			Fonctions en relation avec le thésaurus
*****************************************************************************/

/** Fonction qui renvoie l'identifiant thésaural d'un terme à partir de son nom
**@param : $term String = Nom du terme
**@param : $vid int = Identifiant du vocabulaire de la terminologie
**@param : $ isOpen boolean = spécifie si la liste thésaurale est ouverte ou non. 
		Si ouverte alors ajout du terme au vocabulaire s'il n'existe pas 
**@return : identifiant du terme. Si le terme n'existe pas et que la liste est fermée revoie -1
**/
function getTermIdFromValue ($term,$vid, $isOpen, $isHierachical, $termDescription='',  $termSynonyms='') {
	$termFeuille = $term;
    //Si $isHierachical == true alors gestion des parents : création des nouveau terme
	if ($isHierachical == true) {
		$terms= explode(">",  $term);
		$termFeuille  = $terms[count($terms)-1];
	}
	
	$tid=-1;
    $query = db_query("SELECT tid FROM {term_data} WHERE  LOWER(name)=trim(LOWER('%s')) and vid=%d", $termFeuille,$vid);
    $possible_term = db_fetch_object($query);
    //if the term doesn't already exist, add it to the cloud
    if  (!$possible_term->tid) {
        if ($isOpen) {
				$tidFather = -1;
			if ($isHierachical) {
				for ($i = 0; $i < count($terms) -1; $i++) {
					$termName = $terms[$i];
					//Test si le terme n'est pas la feuille et si il n'esiste pas déjà.
					$query = db_query("SELECT tid FROM {term_data} WHERE  LOWER(name)=trim(LOWER('%s')) and vid=%d", $termName,$vid);
					$possible_term = db_fetch_object($query);
					if  (!$possible_term->tid) {
						$tidFather= insertTermIntoTax ($termName, $vid, $tidFather);
					}
					else {
						$tidFather= $possible_term->tid;
					}
				}
			}	
			$tid= insertTermIntoTax ($termFeuille, $vid, $tidFather, $termDescription, $termSynonyms);
			
		}
	}
    else {
        $tid= $possible_term->tid;
    }
	
    return $tid;
}

function insertTermIntoTax ($termName, $vid, $tidFather, $termDescription='', $termSynonyms='') {
	$new_term = array('vid' => $vid, 'name' => $termName, 'description'=> $termDescription,'synonyms' =>$termSynonyms);
	if ($tidFather >0) {
		$new_term['parent'] = $tidFather;
	}
	if (taxonomy_save_term($new_term)) {
		return $new_term['tid'];
	}
	return -1;
}

function arraySetTermName(&$item, $key) {
  $term = taxonomy_get_term($item);
  $item = $term->name;
}

function arrayTrim(&$item, $key) {
  $item = trim($item);
}


//Vérifie que les données sont bien définie dans le thésaurus
function _checkTaxonomyData ($checkunit, $tableName) {
	//Récupération des valeurs
	$sql = "SELECT  CAST(GROUP_CONCAT(importid +1 ) AS CHAR)  as invalidLine, `".$checkunit['field']."` AS termName FROM $tableName WHERE NOT `".	$checkunit['field']."` IS NULL  AND  NOT `".	$checkunit['field']."` ='' GROUP BY `".	$checkunit['field']."` ";

	$records = db_query($sql);
	$errorLine='';
	while ($record = db_fetch_array($records)) {
		//Split des valeurs
		$termNames= explode(';', $record['termName']);
		
		foreach ($termNames as $term) {
			//Recherche du terme dans la taxonomy
			$tid = getTermIdFromValue ($term,$checkunit['vid'], false,false);
			//Si tid = -1 alors le terme n'éxiste pas dans la taxonomy
			if ($tid==-1)  $errorString .=' '.$record['invalidLine']. ' (' . $term .'), ' ;
		}
	}
	return $errorString;
}


/*****************************************************************************
************			Fonctions de validation des données de WORMS
*****************************************************************************/

function _checkWORMSTaxa ($checkunit, $tableName) {

	$sql = "SELECT  CAST(GROUP_CONCAT(importid +1 ) AS CHAR)  as invalidLine, `".$checkunit['field']."`  AS taxonName FROM $tableName  GROUP BY `".	$checkunit['field']."` ";
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

