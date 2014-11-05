<?php
//require('phpsqlajax_dbinfo.php');

function nsExport_customreports_render_kml($result) {

	// Creates the Document.
	$dom = new DOMDocument('1.0', 'UTF-8');

	// Creates the root KML element and appends it to the root document.
	$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
	$parNode = $dom->appendChild($node);

	// Creates a KML Document element and append it to the KML element.
	$dnode = $dom->createElement('Document');
	$docNode = $parNode->appendChild($dnode);

	// Creates the two Style elements, one for restaurant and one for bar, and append the elements to the Document element.
	$restStyleNode = $dom->createElement('Style');
	$restStyleNode->setAttribute('id', 'pimStyle');
	$restIconstyleNode = $dom->createElement('IconStyle');
	$restIconstyleNode->setAttribute('id', 'pimStyle');
	$restIconNode = $dom->createElement('scale', '0.6'); 
	$restIconstyleNode->appendChild($restIconNode);
	$restIconNode = $dom->createElement('Icon');
	$restHref = $dom->createElement('href', 'http://www.initiative-pim.org/sites/default/files/icones/kml_icone.png');
	$restIconNode->appendChild($restHref);
	$restIconstyleNode->appendChild($restIconNode);
	$restStyleNode->appendChild($restIconstyleNode);
	$docNode->appendChild($restStyleNode);

	// Iterates through the MySQL results, creating one Placemark for each row.
	while ($row = db_fetch_array($result)) {
		// Creates a Placemark and append it to the Document.
		$node = $dom->createElement('Placemark');
		$placeNode = $docNode->appendChild($node);

		// Creates an id attribute and assign it the value of id column.
		$placeNode->setAttribute('id', 'placemark' . $row['id']);

		// Create name, and description elements and assigns them the values of the name and address columns from the results.
		$name = $row['Taxon'] ? $row['Taxon'] :$row['Code_ile_ilot'] ;
		$content = htmlentities('<ul>');
		foreach ($row as $key=>$value) {
			$content .= htmlentities('<li>').$key.' : '.htmlspecialchars($value).htmlentities('</li>');
		}
		$content .= htmlentities('</ul>');
		$nameNode = $dom->createElement('name',$name);
		$placeNode->appendChild($nameNode);
		$descNode = $dom->createElement('description',$content);
		$placeNode->appendChild($descNode);
		$styleUrl = $dom->createElement('styleUrl', '#pimStyle');
		$placeNode->appendChild($styleUrl);

		// Creates a Point element.
		$pointNode = $dom->createElement('Point');
		$placeNode->appendChild($pointNode);

		// Creates a coordinates element and gives it the value of the lng and lat columns from the results.
		$coorStr = $row['Lon'] . ','  . $row['Lat'];
		$coorNode = $dom->createElement('coordinates', $coorStr);
		$pointNode->appendChild($coorNode);
	}
	$kmlOutput = $dom->saveXML();
	$timestamp = date("Y-m-d"); // Create a timestamp for the filename.
	$filename = 'Export'.$timestamp.'.kml';
	header('Content-type: application/vnd.google-earth.kml+xml');
	header('Content-Disposition: attachment; filename="'. $filename .'"');
	echo $kmlOutput;
}

