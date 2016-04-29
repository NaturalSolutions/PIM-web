<?php

$pesiurl = "http://www.eu-nomen.eu/portal/soap.php";

function search_pesi_records_by_likeName($taxonString) {
	$client = new SoapClient("http://www.eu-nomen.eu/portal/soap.php?wsdl=1");
	$taxon=$client->getPESIRecords($taxonString);
	return $taxon;
}

function get_pesi_guid_by_exactName($taxonString) {
	$client = new SoapClient("http://www.eu-nomen.eu/portal/soap.php?wsdl=1");
	$taxon=$client->getGUID($taxonString);
	return $taxon;
}

function get_pesi_vernacularsNames_by_guid($guid) {
	$client = new SoapClient("http://www.eu-nomen.eu/portal/soap.php?wsdl=1");
	$vernacularNames=$client->getPESIVernacularsByGUID($guid);
	return $vernacularNames;
}

function get_pesi_record_by_guid($guid) {
	$client = new SoapClient("http://www.eu-nomen.eu/portal/soap.php?wsdl=1");
	$record=$client->getPESIRecordByGUID($guid);
	return $record;
}

