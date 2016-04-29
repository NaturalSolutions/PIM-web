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
        $ile_term_id = $node->field_bdi_g_code_ile_ilot[0]['value'];
        $ile_term_name = $node->field_bdi_g_code_ile_ilot[0]['view'];
        
        $synonyms = taxonomy_get_synonyms($ile_term_id);
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
 
	<?php if ($node->field_bdi_g_exist_gestionnaire[0]['value'] == 'Oui'):  ?>
  <table>
    <thead>
			<tr><td>Gestionnaire</td></tr>
		</thead>
    <tbody>
    	<?php if ($node->field_bdi_g_nom_gestionnaire[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_nom_gestionnaire']['field']['#title']; //print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_nom_gestionnaire[0]['value'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_adresse_gestionnaire[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_adresse_gestionnaire']['field']['#title']; //print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_adresse_gestionnaire[0]['value'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_tel_gestionnaire[0]['view'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_tel_gestionnaire']['field']['#title']; //print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_tel_gestionnaire[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_email_gestionnaire[0]['view'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_email_gestionnaire']['field']['#title']; //print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <a title="<?php print t('email');?>" href="mailto:<?php print $node->field_bdi_g_email_gestionnaire[0]['view'];?>">
            <?php print $node->field_bdi_g_email_gestionnaire[0]['view'];?>
            </a>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_fax_gestionnaire[0]['view'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_fax_gestionnaire']['field']['#title']; //print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_fax_gestionnaire[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_website_gestionnaire[0]['value'] != ''):  ?>
       <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_website_gestionnaire']['field']['#title']; //print t("Autres Noms"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <a title="<?php print t('Web site');?>" href="<?php print $node->field_bdi_g_website_gestionnaire[0]['value'];?>">
            <?php print $node->field_bdi_g_website_gestionnaire[0]['value'];?>
            </a>
          </div>
        </td>
      </tr>
			<?php endif; ?>
	</tbody>
	</table>
	<?php endif; ?>
	
	 <table>
	  <thead>
		 	<tr><td>Type d'accord de gestion du site</td></tr>
		 </thead>
    <tbody>
    	<?php if ($node->field_bdi_g_type_accord_gestion[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_type_accord_gestion']['field']['#title']; //print t("Zone géographique"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_type_accord_gestion[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_dbi_g_annee_plan_gestion[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_dbi_g_annee_plan_gestion']['field']['#title']; //print t("Communes"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_dbi_g_annee_plan_gestion[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_annee_debut_gestion[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_annee_debut_gestion']['field']['#title']; //print t("Communes"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_annee_debut_gestion[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_surveillance_de_site[0]['value'] != ''):  ?>
	   <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_surveillance_de_site']['field']['#title']; //print t("Zone géographique"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_surveillance_de_site[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_comite_gestion[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_etat_plan_gestion']['field']['#title']; //print t("Communes"); ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_etat_plan_gestion[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_comite_gestio[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label">
          <div class="texte-gris">
                <?php print $node->content['field_bdi_g_comite_gestion']['field']['#title'];  ?>
          </div>
        </td>
        <td class="ficheile-value">
          <div class="texte-gris">
            <?php print $node->field_bdi_g_comite_gestion[0]['view'];?>
          </div>
        </td>
      </tr>
			<?php endif; ?>
     </tbody>
	</table>
	
	
	 <table>
		 <thead>
		 	<tr><td><?php print $node->content['group_bdi_g_ressources']['group']['#title'];  ?></td></tr>
		 </thead>
    <tbody> 
    	<?php if ($node->field_bdi_g_res_nb_gestion[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_nb_gestion']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_nb_gestion[0]['value'];?>
        </div></td>
       </tr> 
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_nb_permanent[0]['value'] != ''):  ?>
       <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_nb_permanent']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_nb_permanent[0]['value'];?>
        </div></td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_nb_saisonniers[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_nb_saisonniers']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_nb_saisonniers[0]['value'];?>
        </div></td>
      </tr>
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_bateau[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_bateau']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_bateau[0]['value'];?>
        </div></td>
      </tr> 
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_plongee[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_plongee']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_plongee[0]['value'];?>
        </div></td>
      </tr> 
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_accueil[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_accueil']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_accueil[0]['value'];?>
        </div></td>
      </tr> 
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_analyse[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_analyse']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_analyse[0]['value'];?>
        </div></td>
      </tr> 
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_transport[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_transport']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_transport[0]['value'];?>
        </div></td>
      </tr> 
			<?php endif; ?>
    	<?php if ($node->field_bdi_g_res_autre[0]['value'] != ''):  ?>
      <tr>
        <td class="ficheile-label"><div class="texte-gris">       		
              <?php print $node->content['group_bdi_g_ressources']['group']['field_bdi_g_res_autre']['field']['#title'];?>
        </div></td>
        <td class="ficheile-value"><div class="texte-gris">
            <?php print $node->field_bdi_g_res_autre[0]['value'];?>
        </div></td>
      </tr> 
			<?php endif; ?>
	  </tbody>
	</table>
	
   <?php if ($node->field_bdi_g_principe_gestion[0]['value'] != ''):  ?>
		 <table>
	  <thead>
		 	<tr><td><?php print $node->content['field_bdi_g_principe_gestion']['field']['#title'];  ?></td></tr>
		 </thead>
    <tbody>
		<?php foreach ($node->field_bdi_g_principe_gestion as $typeAccordGestion):  ?>
     <tr>
     <td class="ficheile-value">
          <div class="texte-gris">
		  	<?php print_r($typeAccordGestion['view']); ?>
     </td>
     </tr>
		<?php endforeach; ?>
   </tbody>
  <?php endif; ?>
	</table>
	
</div>
