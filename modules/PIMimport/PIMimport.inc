<?php

require_once('SqlQueries.inc');
require_once('utils/Excel/reader.php');


/** Fonction général qui controle la vérification des données
**@param : $form_state Formulaire = Contient variable saisie par l'utilisateur
**@return : Liste des message d'erreurs
**/
function PIMimport_check(&$form_state) {
	//Récupération du mapping d'import sélectionné par l'utilisateur
	$importType =  $form_state['values']['import_type'];
	include('mappings/'.$importType.'.mapping'); 	
	
	//Récupération des validateurs de fichiers
	$validators = _PIMimport_upload_validators();
	//upload et validation du fichier
	$file = file_save_upload('PIMimport_file_upload', $validators);
	if ($file !=0){
		//Génération de la table où les import seront effectués
		// Format ImportType_uid_date
		global $user;
		$tableName = 'PIMimport_'.$user->uid.'_'.date("Ymd_His");
		$form_state['values']['fileName'] = $file->filename;
		$form_state['values']['tableName'] = $tableName;
		$fileCsv = checkXlsTemplate($file->filepath, $delimiter=";") ;
		if ($fileCsv ) {
			//Réalisation de l'import
			$message = csv_to_importableTable($fileCsv, $file->filename ,$tableName);
			if (! empty($message)) {
				foreach ($message as $key=>$messageUnit) {
					$form_state['value']['message'][$key]=$messageUnit;
				}
			}
		}
		else {
			global $base_url;
			$href =  $base_url.'/sites/default/files/Espace-Collaboratif/modeles_import/'.$importType.'.xls';
			$message['error_system'] = t('Invalid template. Import impossible ! <a id="getTemplate" class="blank cleanlink" href="'.$href .'">Get template</a>');
		}
	}
	else {
		$message['error_system'] = t('You must select a  file.');
	}
	return $message;
}


/*****************************************************************************
*************		Fonctions relatives aux interactions avec le fichier
******************************************************************************/

function checkCsvTemplate($filePath, $delimiter=";") {
	try{
	 if (($handle = fopen("$file", "r")) !== FALSE) {
		  $columns = fgetcsv($handle,1, $delimiter);
			$fileFields= implode(",", $columns);
		}
		$templateFields=  _getTemplateField( );
		print $fileFields;
		print "<br/>";
		print $templateFields;
		if ($fileFields != $templateFields) return false;
		else return true; 
	}
	catch (Exception $e){
		drupal_set_message("... Error: ".$e);
	}
}

/** Fonction qui vérifie que le fichier est valide (Même nom d'entête) et le transforme en csv
*** Etape 1  -> Vérification des entêtes
*** Etape 2  -> Transformation en csv. Utilsation de l'utilitaire xls2csv de la librarie catdoc
**@param : $fileName String = Nom du fichier uploadé
**@param : $tableName String = Délimiteur du fichier csv
**@return : False quand fichier non valide OU Nom du fichier généré
**/
function checkXlsTemplate($filePath, $delimiter=";") {
	try{
		$data = new Spreadsheet_Excel_Reader();
		$data->read($filePath);
		$data->setOutputEncoding('UTF-8');
		$numCol = $data->sheets[0]['numCols'];
		for ($i = 1; $i <= $numCol; $i++) {
			$fileFields .= "".$data->sheets[0]['cells'][1][$i].",";
		}
		$fileFields = preg_replace("/(.*[a-z],),*$/", "\\1", $fileFields);
		$templateFields=  _getTemplateField( ).",";
		if ($fileFields != $templateFields) {
		  return false;
		}
		else {
			$filePathClean=cleanFileName($filePath);
			rename($filePath, $filePathClean);
			$fileCsv=substr($filePathClean, 0,-4).'.csv';
			_xls2csv($filePathClean, $fileCsv);
			return $fileCsv;
		}
	
	}
	catch (Exception $e){
		drupal_set_message("... Error: ".$e);
	}
}

/** Fonction qui nétoye le nom du fichier csv
**@param : $fileName String = Nom du fichier 
**/
function cleanFileName($fileName) {
	$fileName  = str_replace("(","_",$fileName);
	$fileName  = str_replace(")","_",$fileName);
	$fileName  = str_replace(" ","_",$fileName);
	$fileName  = str_replace("&","_",$fileName);
	$fileName  = str_replace("\"","_",$fileName);
	$fileName  = str_replace("'","_",$fileName);
	$fileName  = str_replace("[","_",$fileName);
	$fileName  = str_replace("]","_",$fileName);
	return $fileName;
}

/*****************************************************************************
*************		Fonctions relatives aux taches de vérification des données
*************			Passage du fichier csv à une table importable
******************************************************************************/

/** Fonction qui prépare l'import : permet de passer d'un fichier csv à une table en base de données
*** Etape 1  -> Création de la table dans mysql
*** Etape 2  -> Chargement des données dans la base
*** Etape 3  -> Vérification du format des données (Champ date, decimal, ....)
*** Etape 4  -> Vérification des données 
*** Etape 5  ->Vérification des doublons
**@param : $filePath String = Chemin complet du fichier uploadé
**@param : $fileName String = Nom du fichier uploadé
**@param : $fieldDelimiter String =Délimiteur de champ du fichier csv
**@param : $textDelimiter String =Délimiteur de text du fichier csv
**@param : $lineDelimiter String = Délimiteur de linge du fichier csv
**@return : Liste des message d'erreurs
**/
function csv_to_importableTable($filePath, $fileName, $tableName , $fieldDelimiter=';', $textDelimiter='"', $lineDelimiter='\n') {
	$message = array();
	//Génération des requêtes qui génère la table où sera stocké les données brutes issues du fichier csv
	$sql = _getSqlCreateTable( $tableName );
	foreach ($sql as $sqlunit) {
		 $result = update_sql($sqlunit);
		 if (! $result['success']) {
 				$message['error_system']= 'Unable to create temporary table';
        cancelImport($tableName);
        return $message;
		}
	}
	//Génération de la requête qui remplie la table a partir du fichier csv
	$sql = _getSqlLoadData($filePath, $tableName , $fieldDelimiter, $textDelimiter, $lineDelimiter);
	$result = update_sql($sql);
	if (! $result['success']) {
		$message['error_system']= t('Unable to load data');
		cancelImport($tableName);
		return $message;
	}
	//Test ligne vide à la fin ... 
	//TODO pourquoi xls2csv créer une ligne pourrie?
	$message = _dropLastLine($tableName) ;
	if ($message) {
		$message['error_system']= t('Unable to clean temporary table');
		cancelImport($tableName);
		return $message;
	}
	 //Vérification des formats
	$errorString = checkFormat($tableName);
	if ($errorString) {
		$message['error_format']= $errorString;
		cancelImport( $tableName);
		return $message;
	}
  //Vérification des données
	$errorString  = checkData($tableName);
	if ($errorString) {
		$message['error_data']= $errorString;
		cancelImport( $tableName);
		return $message;
	}
	//Vérification des warning
	$duplicateString  = checkWarning($tableName);
	if ($duplicateString)  {
		$message['warning_data']= $duplicateString;
	}
	//Suppression des doublons 
	$duplicateString  = checkDuplicate($tableName);
	if ($duplicateString)  {
		$message['duplicate_data']= $duplicateString;
	}
	return $message;
}


function checkFormat($tableName) {
	$fieldsToCheck = _getCheckFormatField( ) ;
	$invalid=array();
	foreach ($fieldsToCheck as $fieldName=> $check) {
		$errorString = _getQueryCheckFormat( $check['field'] , $tableName, $fieldName, $check['message'],  $check['type'], $check['format']) ;
		if ($errorString) $invalid [] =$errorString;
	}
	return $invalid;
}


/** Fonction qui vérifie si les données sont correctes
**@param : $tableName String = Nom de la table "temporaire"
**@return : Liste des message d'erreurs
**/
function checkData($tableName) {
   $errorString;
   $check =  _getSqlCheckValue( $tableName );
	foreach ($check as $checkunit) {
		//Vérification des données taxons avec le webservices WORMS.
		if ($checkunit['type']=='worms') {
			$errorLine = _checkWORMSTaxa($checkunit, $tableName);
		}
		//Vérification des données de taxonomy
		elseif ($checkunit['type']=='taxonomy') {
			$errorLine = _checkTaxonomyData($checkunit, $tableName);
		}
		//Cas des vérifications intraSQL
		else {
			if (isset($checkunit['sql'])) $sql= $checkunit['sql'];
			else $sql = _generateCheckSql($checkunit, $tableName);
			$result = db_query($sql);
			$errorLine='';
			while ($record = db_fetch_array($result)) {
				if ((!isset($record[$checkunit['field']])) or empty($record[$checkunit['field']])) {
				  if (isset($checkunit['mandatory']) and ($checkunit['mandatory'] == FALSE)) continue;
				  else if (isset($checkunit['hasDefault']) and ($checkunit['hasDefault'] == TRUE)) continue;
				}
				$errorLine .= $record['importid'].": ".$checkunit['field']." = ".$record[$checkunit['field']]." ,";
			}
		}
		if ($errorLine != '') {
			$errorString .= "<li><span class='field-label'> ".$checkunit['message']." :</span> ".t('line'). " ".$errorLine;
			if (! empty($checkunit['description'])) $errorString .=" <div class='description'>".$checkunit['description']."</div>";
			$errorString .="</li>";
		}
	}
	if ($errorString !='') $errorString = "<ul>".$errorString."</ul>";
	return $errorString;
}


function _generateCheckSql($checkunit, $tableName) {
	$sql = "SELECT importid, ". $checkunit['field'] ." FROM $tableName ";
	if ($checkunit['type']=='taxonomy') {
		$sql .= " LEFT OUTER JOIN (SELECT DISTINCT * FROM {term_data} WHERE vid = ".$checkunit['vid'] .") AS thes ";
		$sql .= " ON ".$checkunit['field'] ."= thes.name  ";
		$sql .= " WHERE thes.tid IS NULL ";
	}

	if ($checkunit['mandatory']) {
		if ($checkunit['type']=='taxonomy') {
			$sql .= " AND NOT";
		}
		else {
				$sql .= " WHERE ";
		}
		$sql.=" (".$checkunit['field']." IS NULL OR ".$checkunit['field']."='')";
	}

	return $sql;
}
/** Fonction qui vérifie si les données sont déjà présentes en base ou si elle existe plusieurs fois dans le fichier importé
**@param : $tableName String = Nom de la table "temporaire"
**@return : Liste des message d'erreurs de duplication
**/
function checkDuplicate($tableName) {
   $errorString;
   $sqlDuplicate =  _getSqlCheckDuplicate( $tableName );
	foreach ($sqlDuplicate as $sqlunit) {
		$result = update_sql($sqlunit);
			 if (! $result['success']) {
				drupal_set_message('Unable to create temporary table', 'error' );
				cancelImport($tableName);
				return;
			}
     }
	//Récupération des numéro de lignes qui ne seront pas importées
	$sqlIsDuplicate = _getSqlGetDuplicate( $tableName );
	$result = db_query($sqlIsDuplicate);
	while ($record = db_fetch_array($result)) {
		if ($record['duplicates']) $errorString =  "<span class='field-label'>".t('Duplicate data')."</span>: ".t('line')." ".$record['duplicates']." <div class='description'>".t('Not imported')."</div>";
    }
	return $errorString;
}

function checkWarning($tableName) {
 	$errorString;
 	$sqlWarning =  _getSqlCheckWarning( $tableName );
	foreach ($sqlWarning as $sqlunit) {
		if (isset($sqlunit['sql'])) $sql= $sqlunit['sql'];
		$result = db_query($sql);
		$errorLine='';
		while ($record = db_fetch_array($result)) {
			$errorLine .= "<li>".$record['val']." ".t('line'). " : (". $record['importid'] .")</li>";
		}
		if ($errorLine != '') {
			$errorString .= "<span class='field-label'> ".$sqlunit['message']." :</span> <ul> ".$errorLine. '</ul>';
			if (! empty($checkunit['description'])) $errorString .=" <div class='description'>".$checkunit['description']."</div>";
		}
  }
  
	return $errorString;
}


/** Fonction qui annule l'import
	Pour le moment supprime la table d'import
	TODO -> A finaliser
**@param : $tableName String = Nom de la table "temporaire"
**/
function  cancelImport($tableName) {
  $sql = _getSqlDropTempTable($tableName);
	$result = update_sql($sql);
}


/*****************************************************************************
************			Fonctions de validation du fichier d'import
*****************************************************************************/

/** Fonction qui Transforme un fichier xls en fichier csv
//TODO : variable des paramètres de xls2csv (délimiteur, encodage, ..;)
//TODO : traiter message de retour
**@param : $xls_file String = Nom du fichier excel
**@param : $csv_file String = Nom du fichier csv à générer 
**/
function _xls2csv($xls_file,$csv_file) { 
    // "sed" command is used to discard any content after a formfeed character 
    // (which is the sheet separator of xls2csv)
	$cmd = "export LANG=\"fr_FR.UTF-8\" && xls2csv -q '1' -c ';' -d 'UTF-8' -f 'd/m/Y' \"$xls_file\" | sed -n -e '/\f/ i\\\\' -e '/\f/q' -e 'p' > \"$csv_file\""; 
	@exec($cmd,$stdout,$errocode); 
	unlink("$xls_file"); 
	if ($errorcode > 0) return $errocode; 
	return false;
} 

function _PIMimport_upload_validators() {
  $validators = array(
    '_PIMimport_validator_extensions' => array(array_filter(variable_get('herpeto_sp_presente_upload_extensions',array('xls')))),
    '_PIMimport_validator_filesize' => array( 2 ),
  );
  return $validators; 
}


function _PIMimport_validator_extensions($file, $extensions) {
  $errors = array();
  $ext = substr($file->filename, strrpos($file->filename, '.') + 1);
  // Bypass validation for uid  = 1.
  if ($user->uid != 1) {
    if (!in_array($ext, $extensions)) {
      $errors[] = t('Sorry, accepted file extensions are %extensions.', array('%extensions' => implode(', ', $extensions)));
    }
  }
  return $errors;
}

function _PIMimport_validator_filesize($file, $size) {
  global $user;
  $errors = array();
  // Bypass validation for uid  = 1.
  if ($user->uid != 1) {
    if ($file->filesize < $size) {
      $errors[] = t('Sorry, your file did not have any content.');
    }
  }
  return $errors;
}

function _herpeto_sp_presente_validators() {
	$langs = array();
	foreach(language_list() as $iso => $language) {
	  $langs[$iso] = $iso;
	}
	$validators = array(
	  'licenses' => array_filter(creativecommons_lite_get_license_array()),
	  'states' => array(
		'Draft' => 'Draft',
		'Published' => 'Published'),
	  'languages' => $langs,
	);
	return $validators;
}



