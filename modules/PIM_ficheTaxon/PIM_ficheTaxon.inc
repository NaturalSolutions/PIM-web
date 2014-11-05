<?php


function select_nodeId_by_content_type($tid,$content_type, $ref='taxonomy'){
	if ($ref=='taxonomy') {
		$result = db_query(
					"SELECT t.nid FROM {term_node} t
					JOIN (SELECT * FROM {node} WHERE type ='%s' )n
					ON t.nid = n.nid
					WHERE t.tid = %d",$content_type, $tid);
	}
	elseif ($ref=='worms') {
		$result = db_query("SELECT t.nid FROM {content_type_bd_t_fichetaxon} t WHERE field_bd_t_taxon_worms_worms_lsid = %d ", $tid);
	}
	$nodes = array();
	while ($row = db_fetch_array($result)) {
			$nid = $row['nid'];
			$nodes[] = node_load($nid);
	}
	return $nodes;
}
 

function get_taxonomy_termField($tid){
	$result = db_query("SELECT t.tid, t.rbota_initial_id,t.rbota_rang, t.rbota_referentiel FROM {term_fields_term} t	WHERE t.tid = %d", $tid);
	while ($row = db_fetch_array($result)) {
			$tfield['rbota_initial_id'] = $row['rbota_initial_id'];
			$tfield['rbota_rang'] = $row['rbota_rang'];
			$tfield['rbota_referentiel'] = $row['rbota_referentiel'];
	}
	/*//Récupération de l'image si elle n'existe pas
	$url = 'http://www.ville-ge.ch/musinfo/bd/cjb/africa/carte/carte_a/'.$tfield['rbota_initial_id'].'.jpg';
	$filename = '/home/data/apache/drupal/drp_PIM/sites/default/files/AFN-repartition/carte_a/'.$tfield['rbota_initial_id'].'.jpg';
	if (file_exists($filename)) {
		  print "Le fichier $filename existe";
	} 
	else {
		  print "Le fichier $filename n'existe pas";
			$cmd = "wget \"$url\" -O \"$filename\""; 
			print "--------------------<br/>";
			print $cmd;
			print "--------------------<br/>";
			exec($cmd); 
	}*/
	
	return $tfield;
}
 
 
function formatTermFicheNode ($tid, $ref='taxonomy'){
	$spReglemente =false;
	$taxnodes = select_nodeId_by_content_type($tid,'bd_t_fichetaxon', $ref);
	$taxon = array();
	//taxon['content']['compartiment'] = $node->field_bd_t_compartiment[0]['value'];
	foreach ($taxnodes as $node) {
	if (!empty($node->field_bd_t_uicn_monde[0]['value'])) {
			$taxon['content']['UICN_monde']['value'] = getTermNameDescription($node->field_bd_t_uicn_monde[0]['value']);
			$taxon['content']['UICN_monde']['label'] = t('UICN monde');
		}
		if (!empty($node->field_bd_t_uicn_medit[0]['value'])) {
			$taxon['content']['UICN_medit']['value'] = getTermNameDescription($node->field_bd_t_uicn_medit[0]['value']);
			$taxon['content']['UICN_medit']['label'] = t('UICN méditerranée');
		}
		if (!empty($node->field_bd_t_protection[0]['value'])) {
			$protection = "<ul>";
			foreach ($node->field_bd_t_protection as $val) {
				$protection .="<li>".getTermNameDescription($val['value'])."</li>";
			}
			$protection .= "</ul>";
			$taxon['content']['protection']['label'] = t('Protection');
			$taxon['content']['protection']['value'] = $protection;
		}
		if (!empty($node->field_bd_t_uicn_pays[0]['value'])) {
			$uicnPays = "<ul>";
			foreach ($node->field_bd_t_uicn_pays as $val) {
				$uicnPays .="<li>".getTermNameDescription($val['value'])."</li>";
			}
			$uicnPays .= "</ul>";
			$taxon['content']['UICN_pays']['value'] = $uicnPays;
			$taxon['content']['UICN_pays']['label'] = t('UICN pays');
		}
		//Est ce que le taxon fait l'objet d'une réglementation ?
		if ((!empty($node->field_bd_t_uicn_pays[0]['value']))
				|| (!empty($node->field_bd_t_uicn_monde[0]['value']))
				|| (!empty($node->field_bd_t_uicn_medit[0]['value']))
				|| (!empty($node->field_bd_t_protection[0]['value']))
			) {
			$taxon['warning']['spReglemente'] = "<div class='statutEspeces'>".t("Reglemented species")."</div>";
		}
		if ((!empty($node->field_bd_t_endemisme[0]['value'])) && (strtolower($node->field_bd_t_endemisme[0]['value']) != 'non')) {
			$taxon['warning']['spEndemisme'] = "<div class='statutEspeces'>".t("Endemic")."</div>";
			$taxon['content']['spEndemisme']['value'] = $node->field_bd_t_endemisme[0]['value'];
			$taxon['content']['spEndemisme']['label'] = t('Endemism');
		}
		if ((!empty($node->field_bd_t_envahissante[0]['value'])) && ($node->field_bd_t_envahissante[0]['value'] ==1)) {
			$taxon['warning']['spEnvahissante'] = "<div class='statutEspeces'>".t("Invasive")."</div>";
		}
		
	}
	return $taxon;
}




##Clé Flicker compte amandine.sahl
##test-taxon-app
##Clé : ba88ef4277c659b1f36682238edfc2e7
##Secret : d208dd943ec42488
require_once('phpFlickr-3.1/phpFlickr.php');
function flickr_fichetaxon_callback($term_name, $limit = 50, $offset = 0, $cached_urls = array()) {
  $api_key = "ba88ef4277c659b1f36682238edfc2e7";
  $perPage =  $limit;
  $url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search';
  $url.= '&api_key='.$api_key;
  $url.= '&per_page='.$perPage;
  $url.= '&text='.urlencode ($term_name);
  $url.= '&format=json';
  $url.= '&nojsoncallback=1';
  $response = json_decode(file_get_contents($url));
  if($response->stat == 'ok') {
    $photos = $response->photos->photo;
    if(count($photos) > 0)  {
      foreach($photos as $photo)  {
          $item = new stdClass ( );
          $imagePathThumbnail = 'http://static.flickr.com/' . $photo->server . '/' .  $photo->id . '_' . $photo->secret.'_s.jpg';
          $imagePathLarge = 'http://static.flickr.com/' . $photo->server . '/' .  $photo->id . '_' . $photo->secret.'_b.jpg';
          $photo_url = 
          $item = array(
            'body' => '<div><a class="lightbox" rel="lightbox[flickr]" href="' . $imagePathLarge. '" title="'.$photo->title.'<br/>Original Flickr page: <a href=\'http://www.flickr.com/photos/'.$photo->owner.'/'.$photo->id.'\'>http://www.flickr.com/photos/'.$photo->owner.'/'.$photo->id.'</a>"><img src="' . $imagePathThumbnail.'" width="75" height="75" alt="Thumbnail"/></a></div>',
            'page_url' => 'http://www.flickr.com/photos/' . $photo ->owner . '/' . $photo ->id,
            'photo_url'=>$imagePathLarge,
          );
          $items ['http://www.flickr.com/photos/' .$photo ->owner . '/' . $photo ->id] = $item;
          $urls[] = $item['page_url'];

      }
      $urls = array('name'=> 'Flickr', 'url' => 'http://www.flickr.com', 'urls' => $urls);
      $items['urls'] = $urls;
      $items['citation'] = theme('citation_url', $urls);
      //print_r($items);exit;
      return $items;
    }
  }
 }
