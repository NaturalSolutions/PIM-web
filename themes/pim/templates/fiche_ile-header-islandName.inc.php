<?php 

function get_template_ficheIle_headerContent ($ile_term_id,$ile_term_name) {
	global $user;
	global $base_url;
	$synonyms = taxonomy_get_synonyms($ile_term_id);

	if ((in_array("Admin PIM", $user->roles)) or (in_array("Mega Admin", $user->roles))) {
		$htmlout .= '<a href="'.$base_url.'/admin/content/taxonomy_manager/voc/4/'.$ile_term_id.'">';
		$htmlout .= $synonyms[0]." - ".$ile_term_name;
		$htmlout .= '</a>';
	} 
	else {
		if (isset($synonyms[0])) {
			$htmlout .= $synonyms[0];
		}
		else {
			$htmlout .= $ile_term_name;
		}
	}
	return $htmlout;
}
