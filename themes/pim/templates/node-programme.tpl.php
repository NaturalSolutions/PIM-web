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

<div class="page-header"> 
	<h1>
        <!--ici le titre title du programme-->
        <?php if( $node->title <> $node->field_programme_sous_titre[0]['value']): ?>
        <span class="page-titre-bleu">
			<?php print $node->title; ?>
        </span>
		<?php endif; ?>
        
        <!--ici le sous titre dans la même classe que le sous titre de la view Top news-->
        <span class="page-soustitre-bleu"> 
			<?php print $node->field_programme_sous_titre[0]['value'];?> 
        </span>
	</h1>

	<!--ici la description dans la même classe que la description de la view Top news-->
	<?php if($node->field_programme_description[0]['value']): ?>
    <h2>
        <span class="description-orange">
            <?php print $node->field_programme_description[0]['value'];?>
        </span>
    </h2>
	<?php endif; ?>

	
    <div class="page-content">
        <!--ici le texte dans la même classe que le texte de la view Top news-->
        <span class="texte-gris">
		<?php
			//le node concerné
			//$node = node_load($nid); //INUTILE ET TRES MAUVAIS POUR LE TEMPS DE CHARGEMENT DE LA PAGE
			//on cherche le texte pour le node concerné
			$texte = $node->field_programme_texte[0][value];
			if ($texte):
			
				print $texte;
				?><br /><?php
			
			endif;
            ?> 
        </span>

	
        <!--ici l'image-->
        <span class="node-programme-image"> 
            <?php
			//le node concerné
			//$node = node_load($nid);
				
			global $base_url;
			$image_path = $base_url.'/'. $node->field_programme_photo[0][filepath];
			$alt = $node->field_programme_photo[0][data][alt];
			//on affiche l'image
			echo "<img src='$image_path' alt='$alt'/> ";
            ?>
        </span>

	
        <!--ici la vidéo-->
        <span class="node-programme-video"> 
            <?php
			//le node concerné
			//$node = node_load($nid);
			//ici le site internet dailymotion
			$site = 'http://www.dailymotion.com/swf';
			$src = $site.'/'.$node->field_programme_video[0][value];
		
			if($node->field_programme_video[0][value]){
			
			//vidéo embeded mais pas accepté par les normes W3C
			//echo "<embed src='$src' width='400' height='300' autostart='true' loop='0'></embed> ";
			
			//animation flash accepté par les normes W3C
			echo "<object type='application/x-shockwave-flash' data='$src' width='400' height='300'>
					<param name='movie' value='$src' /> 
					<param name='wmode' value='transparent' /> 
					<p>Image ou texte alternatif</p> 
				</object> ";
			}
            ?>
        </span>
	</div>
</div>
