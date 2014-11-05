<?php
/*
CREATE table drp_custom_import_logs (
	lid INT( 4 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	log_date TIMESTAMP, 
	uid int(11),
	nodes_created varchar(500),
	nodes_updated varchar(500)
)
*/
/*
%s | String
%d | Integer
%b | Binarys
%% | Inserts a literal % sign
%f | Float
*/

function getAllLogs ($userLog=-1) {
	$sql = "SELECT * FROM {custom_import_logs} ";
	if ($userLog==-1) {
		$records = db_query($sql);
	}
	else {
		$sql .= " WHERE  uid = %d";
		$records = db_query($sql, $userLog);
	}
	$logs = returnLogRecord ($records) ;
	return $logs;
}

function getCancelLogs ( $isCanceled = 0, $userLog=-1) {
	//Si l'utilsateur à le droit d'annuler tous les logs alors $userLog = -1
	//Sinon  $userLog =uid
	$sql = "SELECT * FROM {custom_import_logs} WHERE is_canceled=%d";
	if ($userLog==-1) {
		$records = db_query($sql, $isCanceled );
	}
	else {
		$sql .= " AND uid = %d";
		$records = db_query($sql, $isCanceled, $userLog);
	}
	$logs = returnLogRecord ($records) ;
	return $logs;
}

function returnLogRecord (&$records) {
	while ($record = db_fetch_array($records)) {
		$logs[$record['lid']]= array(
			'log_date'=>$record ['log_date'],
			'uid'=>$record ['uid'],
			'nodes_created'=>$record ['nodes_created'],
			'nodes_updated'=>$record ['nodes_updated'],
			'file_name'=>$record ['file_name'],
			'is_canceled'=>$record ['is_canceled'],
		);
	}
	return $logs;
}

function getUserName($uid) {
  return db_result(db_query("SELECT name FROM {users} WHERE uid = %d", $uid));
}


function cancelOneLog ($lid) {
	$nodeCreated;
	$sql = "SELECT * FROM {custom_import_logs} WHERE lid= %d";
	$records = db_query($sql, $lid);
	while ($record = db_fetch_array($records)) {
		$nodeCreated =$record['nodes_created'];
	}
	$nodeToDelete = array();
	
	if ( $nodeCreated != '') {
		$nodeToDelete = explode(",", $nodeCreated);
		foreach ($nodeToDelete as $nid) {
			node_delete($nid);
		}
	}
	$sql = "UPDATE {custom_import_logs} SET is_canceled = 1 WHERE lid=$lid";
	$records = update_sql($sql);
}
