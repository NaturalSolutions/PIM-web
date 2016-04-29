<?php 


function _getSqlString($text) {
	$text = str_replace(".","",$text);
	$text = str_replace(" ","_",$text);
	$text =  str_replace("'", "&#039", $text);
	return $text;
}

function _getQueryCheckFormat( $fieldName, $tableName, $label, $message, $type='', $regexp='-1') {
	$sql = "SELECT CAST(GROUP_CONCAT(importid) AS CHAR)  as invalidformat FROM  $tableName WHERE NOT ( $fieldName ='' OR $fieldName IS NULL ) AND  NOT $fieldName REGEXP '%s' ";
	if ($type!='') $regexp= _getRegexpForType($type);
	if ($regexp!=-1 ) $query= db_query($sql, $regexp);
	if ($query) {
		$result = $query;
		while ($record = db_fetch_array($result)) {
			if ($record['invalidformat']) $errorString = "<span class='field-label'>$label</span>: ".t('line')." ".$record['invalidformat']." <div class='description'>$message</div>";
		}
	}
	return $errorString;
}

function _getRegexpForType($type) {
	switch($type)  {
		case 'integer' : 
			return '^.?[0-9]+$';
		break;
		case 'decimal' : 
			return '^.?[0-9]*\\.?[0-9]*$';
		break;
		case 'date' : 
			return '^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$';
		break;
	}
	return -1;
}



function _getSqlDropTempTable( $tableName ) {
	$sqlDropTable= "DROP TABLE IF EXISTS $tableName;";
	return $sqlDropTable;
}


function _getSqlGetDuplicate($tableName) {
    $sqlGetDuplicate=  "SELECT CAST(GROUP_CONCAT(importid) AS CHAR) duplicates FROM  $tableName WHERE isdoublon = true";
	return $sqlGetDuplicate;
}



function _getSqlCreateTable( $tableName ) {
	$fields= explode(",",_getTemplateField());
	foreach ($fields as &$field) {
		$field = "`"._getSqlString($field)."`";
	}
	$insertTemplateFields =  join(" text,",$fields)." text ";
	$sqlCreateTable = array();
	$sqlCreateTable[0]= "DROP TABLE IF EXISTS $tableName;";
	$sqlCreateTable[1]= "CREATE  TABLE $tableName  (importid INT( 4 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,  isvalid boolean, isdoublon boolean, ".$insertTemplateFields.") CHARACTER SET UTF8 COLLATE utf8_general_ci;   ";
	return $sqlCreateTable;
}

function _getSqlLoadData($filePath, $tableName , $fieldDelimiter=';', $textDelimiter='"', $lineDelimiter='\n') {
	$fields= explode(",",_getTemplateField( ));
	foreach ($fields as &$field) {
            $field = "`"._getSqlString($field)."`";
	}
	$insertTemplateFields =  join(" ,",$fields);
	$sqlLoadData = "LOAD DATA LOCAL INFILE '$filePath' INTO TABLE  $tableName CHARACTER SET utf8  FIELDS TERMINATED BY '$fieldDelimiter'  ENCLOSED BY '$textDelimiter' 
LINES TERMINATED BY '$lineDelimiter' IGNORE 1 LINES ($insertTemplateFields );";
	return $sqlLoadData ;
}


function _dropEmptyLine($tableName) {
	$fields= explode(",",_getTemplateField());
	foreach ($fields as &$field) {
		$field = "`"._getSqlString($field)."`";
	}
	$nullField =join(" IS NULL  AND ",$fields)." IS NULL ";
	//$nullField = substr($nullField,1);
  $deleteEmptyLine=  "DELETE FROM $tableName WHERE ".$nullField;
	return $deleteEmptyLine;
}


function _dropLastLine($tableName) {
 	$result = db_query("SELECT max(importid) AS lastID FROM $tableName");
  while ($record = db_fetch_array($result)) {
		$lastID = $record['lastID'];  
  }
  if ($lastID>0) {
  	$result = update_sql( "DELETE FROM $tableName WHERE importid =$lastID");
		if (! $result['success']) {
			$message['error_system']= 'Unable to clean temporary table';
			cancelImport($tableName);
			return $message;
		}
  }
}


/*---------------------------------------
** Function de formattage de champs
-----------------------------------------*/
/* 1. fonctions pour champs multi évalués */

function arrayFormatUICNPays(&$item, $key) {
  $item = preg_replace('/([a-zA-Z]{2})\s*\(*([a-zA-Z]{2})\)*/',strtoupper('$1').'('.strtolower('$2').')',$item);
}

/* 2. fonctions pour champs mono évalués */
