<?php

$wormsurl = "http://www.marinespecies.org/aphia.php?p=soap&wsdl=1";

function search_worms_AphiaRecords_by_likeName($taxonString) {
	$client = new SoapClient("http://www.marinespecies.org/aphia.php?p=soap&wsdl=1");
	$taxon=$client->getAphiaRecords($taxonString."%");
	
	return $taxon;
}

function get_worms_AphiaID_with_validName($taxonString) {
	$client = new SoapClient("http://www.marinespecies.org/aphia.php?p=soap&wsdl=1");
	$aphiaID=$client->getAphiaID($taxonString."%");
	return $aphiaID;
}


function get_worms_name_with_AphiaID($lsid) {
	$client = new SoapClient("http://www.marinespecies.org/aphia.php?p=soap&wsdl=1");
	$aphiaName=$client->getAphiaNameByID($lsid);
	return $aphiaName;
}
