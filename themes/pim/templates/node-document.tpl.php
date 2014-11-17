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
<?php drupal_set_title(check_plain(substr($node->field_document_titre[0]['value'], 0, 50))); ?>

<div class="mr-propre"></div>
<!--l'entête-->

<div class="bloc-gris">

  <span class="bloc-gris-titre">
    <?php print "<h2>".$node->field_document_titre[0]['value']."</h2>"; ?> 
  </span>
  
  <span class="bloc-gris-date">
  <?php 
    if (!empty($node->field_document_date[0]['view'])): 
        print $node->field_document_date[0]['view'];
    else:
    	$date = explode('-', $node->field_document_annee[0]['value']);
    	$year = $date[0] ;
 			if ($year == 1666): print t('inédit');
      else :  print $node->field_document_annee[0]['view'];
      endif;
    endif;
  ?>
  </span>
    
  <div class="mr-propre"></div>
</div>

<div class="mr-propre"></div>



<!--le corps-->
<div class="views-view--content-apresblocgris">

<!--ici l'image-->
  <span class="views-view--DocsPIM-attachment-1-content-image"> 
    <?php
      //le node concerné
      //$node = node_load($nid);
        
      global $base_url, $language;
	  
      $image_path = $base_url.'/'. $node->field_document_image[0]['filepath'];
	  $node_link = $base_url.'/node/'. $node->nid;
	  $imagecache_path = $base_url.'/'.'sites/default/files/imagecache/Docs_118x168/photos/documents/'. 
			$node->field_document_image[0]['filename'];
      $alt = $node->field_document_image[0][data][alt];
      if (empty($alt)): $alt = t("Picture"); endif;
      
	  //light box avec image source marche pas tout à fait
	  /*
	   print '<a href="'. $image_path .'"';
	   print 'rel="lightbox[field_document_image][Docs Photo&lt;br /&gt;&lt;br /&gt;&lt;'.
		'a href=&quot;'. $node_link  . '&quot;'.
		'id=&quot;lightbox2-node-link-text&quot;&gt;Original Image&lt;/a&gt; - &lt;'.
		'a href=&quot;' . $image_path . '&quot;'.
		'target=&quot;_blank&quot; '.
		'id=&quot;lightbox2-download-link-text&quot;&gt;Download Original&lt;/a&gt;]" '.
		'class="imagefield imagefield-lightbox2 imagefield-lightbox2-Docs_118x168 imagefield-field_docs_image imagecache imagecache-field_docs_image imagecache-Docs_118x168 imagecache-field_docs_image-Docs_118x168 lightbox-processed">'.
		'<img src="' . $imagecache_path .'"'.
		'alt="Document Front Page" title="" height="168" width="118">'.
		'</a>';
	 */
	  //on affiche l'image avec en lien le fichier
      if (! empty($node->field_document_fichier[0]['filepath']) && ($node->field_document_acces_restreint[0]['value'] === '0' || $logged_in)) {
        $file_path = $base_url.'/'.$node->field_document_fichier[0]['filepath'];
        print '<a href="'.$file_path.'" alt="'.t("Document Source").'" title="'.t("Document Source").'" class="blank">';
        echo "<img src='$imagecache_path' alt='$alt' height='168' width='118'/> ";
        print '</a>';
      }
      else {
        echo "<img src='$imagecache_path' alt='$alt' height='168' width='118'/> ";
      }
	  
    ?>
  </span>
  
  
  
    <span class="texte-gris">  
        <?php print $node->field_document_description[0]['value'];?>
    </span>
  
  
  
  <div class="mr-propre"></div>
  
  <table class="nodepageview">
    <tbody>
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
            <?php 
              print t("Related Islands");
            ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-orange">
            <?php
            if (! empty($node->field_document_nom_ile_code_ile[0]['value'])) {
      
              global $base_url;
              $i = 0;
              foreach($node->field_document_nom_ile_code_ile as $ile_term) {
                if ($i > 0) {
                  print ", ";
                }                
                $ile_term_id = $ile_term['value'];
                $ile_term_code = $ile_term['view'];
                $synonyms = taxonomy_get_synonyms($ile_term_id);
                print '<a href="'.$base_url.'/fiche-Ile/'.$ile_term_code.'">';
                print $synonyms[0]; //." - ".$ile_term_code;
                print '</a>';
                $i += 1;
              }
            }
            ?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
            <?php 
              print t("Other Keywords");
            ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_mots_cles[0]['safe'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
            <?php 
              //print $node->content['field_document_auteur']['field']['#title'];
              print t("Author");
            ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_auteur[0]['value'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
            <?php 
              //print $node->content['field_document_type_de_document']['field']['#title'];
              print t("Type of Document");
            ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_type_de_document[0]['view'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
            <?php 
              //print $node->content['field_document_nom_de_la_revue']['field']['#title'];
              print t("Name of the journal");
            ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_nom_de_la_revue[0]['view'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("Language");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_langue[0]['value']; ?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("Edition");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_edition[0]['value'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("ISBN");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_cote_isbn[0]['value'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php 
                //print $node->content['field_document_numero_volume']['field']['#title'];
                print t("Volume number");
              ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_numero_volume[0]['value'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php 
                //print $node->content['field_document_pages_publication']['field']['#title'];
                print t("Publication pages");
              ?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_pages_publication[0]['value'];?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("Number of pages");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php print $node->field_document_nb_pages[0]['value'];?>
          </div>
        </td>
      </tr>
  
          <!-- Pier -->
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php if($language->language == 'fr') print t("Est dans l'Atlas"); else print t("In Atlas");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php if($node->field_document_in_atlas[0]['value'] == 1) echo 'Oui'; else echo 'Non'; ?>
          </div>
        </td>
      </tr>
      <!-- Fin Pier -->

      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("URL");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php 
              if (! empty($node->field_document_site_web[0]['value'])) {
                print '<a href="'.check_url($node->field_document_site_web[0]['value']).'" alt="'.t("Document Source").'" class="blank">';
                print $node->field_document_site_web[0]['value'];
                print '</a>';
              }
            ?>
          </div>
        </td>
      </tr>
      
          <tr>
            <td class="nodepageview-field-label">
              <div class="texte-gris">
                  <?php print t("Access type");?>
              </div>
            </td>
            <td class="nodepageview-field-content">
              <div class="texte-gris">
                <?php
                    print $node->field_document_acces_restreint[0]['view'];
                ?>
              </div>
            </td>
          </tr>

      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("File");?>
          </div>
        </td>
        <td class="nodepageview-field-content">
          <div class="texte-gris">
            <?php 
              if (! empty($node->field_document_fichier[0][filepath])) {
                if ($node->field_document_acces_restreint[0]['value'] === '0' || $logged_in) {
                  $file_path = $base_url.'/'.$node->field_document_fichier[0][filepath];
                  print '<a href="'.$file_path.'" alt="'.t("Document Source").'" class="blank">';
                  print t("View Source");
                  print '</a>';
                }
              }
            ?>
          </div>
        </td>
      </tr>
      
      <?php 
        global $user;
        if ((in_array("Admin PIM", $user->roles)) or 
            (in_array("Mega Admin", $user->roles))): ?>
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php 
                //print $node->content['field_is_inventory_source']['field']['#title'];
                print t("Is inventory source");
              ?>
          </div>
        </td>
        <td class="nodepageview-field-content nodepageview-field-content-admin">
          <div class="texte-gris">
            <?php 
              if ($node->field_is_inventory_source[0]['value'] == 1): 
                print t("Yes");
              else:
                print t("No");
              endif;
            ?>
          </div>
        </td>
      </tr>
      
      <tr>
        <td class="nodepageview-field-label">
          <div class="texte-gris">
              <?php print t("Document PIM"); ?>
          </div>
        </td>
        <td class="nodepageview-field-content nodepageview-field-content-admin">
          <div class="texte-gris">
            <?php print $node->field_document_organisation2[0]['view'];?>
          </div>
        </td>
      </tr>
      <?php endif; ?>
      
    </tbody>
  </table>
    
  <div class="mr-propre"></div>
</div>
