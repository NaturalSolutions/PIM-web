<?php
/**
 * @file
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $submitted: Themed submission information output from
 *   theme_node_submitted().
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $build_mode: Build mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $build_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * The following variable is deprecated and will be removed in Drupal 7:
 * - $picture: This variable has been renamed $user_picture in Drupal 7.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess()
 * @see zen_preprocess_node()
 * @see zen_process()
 */
?>

<!-- !!Attention ne pas mettre de "mr-propre" ici!! -->
<!-- <div class="mr-propre"></div> -->

<div id="ficheile" class="desc-phys">

  <div class="ficheile-titre">
    <span class="texte-orange">
      <?php 
        global $user;
        global $base_url;
        $ile_term_id = $node->field_bdi_dp_nom_ile_code_ile[0]['value'];
        $ile_term_name = $node->field_bdi_dp_nom_ile_code_ile[0]['view'];
        
        $synonyms = explode(', ', $node->field_bdi_dp_autres_noms_calcules[0]['value']);
        if ((in_array("Admin PIM", $user->roles)) or 
            (in_array("Mega Admin", $user->roles))) {
            //print '<a href="'.$base_url.'/admin/content/taxonomy/edit/term/'.$ile_term_id.'">';
            print '<a href="'.$base_url.'/admin/content/taxonomy_manager/voc/4/'.$ile_term_id.'">';
            print $synonyms[0]." - ".$ile_term_name;
            print '</a>';
        } 
        else {
          print $synonyms[0]." - ".$ile_term_name;
        }
      ?>
    </span>
  </div>
 
  <?php
  $is_archipel = 0;
  $result = db_query("SELECT is_archipel FROM {term_fields_term} WHERE tid =%d",
										 $ile_term_id);
  while ($archipel = db_fetch_array($result)) {
			/* il n'y a qu'un seul resultat */
    $array_archipel[] = $archipel['is_archipel'];
    break;
  }
  $is_archipel = $array_archipel[0];
  if (empty($is_archipel)) {
    $is_archipel = (strpos($ile_term_name, '000') == strlen($ile_term_name) - 3) ? 1 : 0;
  }
  if ($is_archipel) {
    if (!empty($node->field_bdi_dp_archipel[0]['value'])) {
      $result = db_query("select field_bdi_dp_nom_ile_code_ile_value " .
                         "from {content_type_bd_i_description_physique} " .
                         "where field_bdi_dp_archipel_value like '%%%s%%' " .
                         "and field_bdi_dp_nom_ile_code_ile_value <> %d",
                         $node->field_bdi_dp_archipel[0]['value'],
                         $ile_term_id);
      while ($island = db_fetch_array($result)) {
        $array_islands_id[] = $island['field_bdi_dp_nom_ile_code_ile_value'];
      }
    } else {
      $archipel_strcode = substr($ile_term_name, 0, 4);
      $result = db_query("select tid from {term_data} " .
                         "where vid = 4 and name like '%s%%' " .
                         "and tid <> %d",
                         $archipel_strcode, $ile_term_id);
      while ($island = db_fetch_array($result)) {
        $array_islands_id[] = $island['tid'];
      }
    }
    
  } else {
    if (!empty($node->field_bdi_dp_archipel[0]['value'])) {
      $result = db_query("select d.field_bdi_dp_nom_ile_code_ile_value, t.name " .
                         "from {content_type_bd_i_description_physique} d " .
                         "inner join {term_fields_term} tf " .
                         "on d.field_bdi_dp_nom_ile_code_ile_value = tf.tid " .
                         "inner join {term_data} t " .
                         "on d.field_bdi_dp_nom_ile_code_ile_value = t.tid " .
                         "where tf.is_archipel = 1 and " .
                         "d.field_bdi_dp_archipel_value like '%%%s%%'",
                         $node->field_bdi_dp_archipel[0]['value']);
      while ($archipel = db_fetch_array($result)) {
			/* il n'y a qu'un seul resultat */
        $array_archipel_id[] = $archipel['name'];
        break;
      }
      $archipel_id = $array_archipel_id[0];
      
    } else {
      $archipel_strcode = substr($ile_term_name, 0, 4);
      $result = db_query("select t.tid, t.name from {term_data} t " .
                 "inner join {term_fields_term} tf " .
                 "on t.tid = tf.tid " .
                 "where t.vid = 4 and tf.is_archipel = 1 " .
                 "and t.name like '%s%%' ",
                 $archipel_strcode);
      while ($archipel = db_fetch_array($result)) {
			/* il n'y a qu'un seul resultat */
        $array_archipel_id[] = $archipel['name'];
        break;
      }
      $archipel_id = $array_archipel_id[0];
    }
  }
  ?>
 
  <table>
    <tbody>
    
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
            <?php   
            //$parts = explode(':', $field_bdi_dp_archipel_rendered, 2);
            //print $parts[0];

            //print $node->nid;
            if ($is_archipel) {
              print t("Archipel's Islands");
            } else {
              print $node->content['field_bdi_dp_archipel']['field']['#title'];
            }
            ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-orange">
            <?php 
            if ($is_archipel) {
              $i = 0;
              
              foreach($array_islands_id as $island_id) {
                if ($i > 0) {
                  print ", ";
                }
                $island_term = taxonomy_get_term($island_id);
                $island_code = $island_term->name;
                
                $result = db_query('SELECT name FROM {term_synonym} WHERE tid = %d ORDER BY tsid ASC LIMIT 1', $island_id);
                $row = db_fetch_array($result);
                $island_name = $row['name'];

                print '<a href="'.$base_url.'/fiche-Ile/'.$island_code.'">';
                print $island_name; //." - ".$island_code;
                print '</a>';
                $i += 1;
              }
            } else {
              if (! empty($archipel_id)) {
                print '<a href="'.$base_url.'/fiche-Ile/'.$archipel_id.'">';
                print $node->field_bdi_dp_archipel[0]['value'];
                print '</a>';
              } else {
                print $node->field_bdi_dp_archipel[0]['value'];
              }
            }
            ?>
          </div>
        </td>
      </tr>
	  <!-- end Archipel / Archipel's Islands field -->
     	
	  <?php if ($node->field_bdi_dp_ispim_island[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print t($node->content['field_bdi_dp_ispim_island']['field']['#title']); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_ispim_island[0]['value'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
      <?php
        if (count($synonyms) > 1) {
            array_shift($synonyms);
        ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print implode(', ', $synonyms);?>
          </div>
        </td>
      </tr>
	  <?php } ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_zone_geographique']['field']['#title']; //print t("Zone géographique"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_zone_geographique[0]['view'];?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print  t($node->content['field_bdi_dp_topo_region']['field']['#title']); //print t("Communes"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_topo_region[0]['view'];?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print  t($node->content['field_bdi_dp_topo_province']['field']['#title']); //print t("Communes"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_topo_province[0]['view'];?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print  t($node->content['field_bdi_dp_topo_communes']['field']['#title']); //print t("Communes"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_topo_communes[0]['view'];?>
          </div>
        </td>
      </tr>
	  
	  <?php if ($node->field_bdi_dp_localite_proche[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_localite_proche']['field']['#title']; //t("Localité la plus proche"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_localite_proche[0]['value'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  
	  <?php if ($node->field_bdi_dp_sup_terrestre_ha[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_sup_terrestre_ha']['field']['#title']; //print t("Superficie terrestre (hectares)"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_sup_terrestre_ha[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_sup_amp_ha[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_sup_amp_ha']['field']['#title']; //print t("Superficie de l'aire marine protégee (hectares)"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_sup_amp_ha[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_altitude_metre[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_altitude_metre']['field']['#title']; //print t("Altitude(mètre)"); print(" : "); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_altitude_metre[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_dist_cote_cont[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_dist_cote_cont']['field']['#title']; //print t("Distance à la cote continentale (miles nautiques)"); print(" : "); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_dist_cote_cont[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_dist_ile_proche[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_dist_ile_proche']['field']['#title']; //print t("Distance île la proche"); print(" : "); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_dist_ile_proche[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_cote_cont_reference[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_cote_cont_reference']['field']['#title']; //print t("Distance de l'ile principale la plus proche (miles nautiques)"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_cote_cont_reference[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_ile_principal_ref[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_dp_ile_principal_ref']['field']['#title']; //print t("Ile principale de référence"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_ile_principal_ref[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
	  <?php if ($node->field_bdi_dp_lineaire_cote_metre[0]['value'] != null):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print  t($node->content['field_bdi_dp_lineaire_cote_metre']['field']['#title']); //print t("Lineaire cotier (metres)"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_dp_lineaire_cote_metre[0]['view'];?>
          </div>
        </td>
      </tr>
	  <?php endif; ?>
    </tbody>
  </table>
</div>
