<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<?php
global $user;
//print "<pre>";
    //var_dump($fields['field_document_titre_value']);
	//drupal_set_message(var_dump($fields['field_document_titre_value']));
	//print $fields;
    //print "</pre>";
	
/* var_dump($fields['view_node']); */
if ((in_array("Admin PIM", $user->roles)) or (in_array("Mega Admin", $user->roles))): ?>
<div class="bloc-admin-extras">
    <span class="admin-links">
        <?php print $fields['view_node']->content; print " "; ?>
        <?php print $fields['edit_node']->content; ?>
        <?php print $fields['delete_node']->content; ?>
    </span>
</div>

<div class="mr-propre"></div>

<?php endif; ?>	

<!--l'entête-->

<div class="bloc-gris">
	<span class="bloc-gris-titre">
		<h2><?php print $fields['field_document_titre_value']->content; ?> </h2>
	</span>
	<span class="bloc-gris-date">
		<?php
      if (! empty($fields['field_document_date_value']->content)):
        print $fields['field_document_date_value']->content;
      else:
		    $date = explode('-', $fields['field_document_annee_value']->raw);
		  	$year = $date[0] ;
	 			if ($year == 1666): print t('inédit');
        else : print $fields['field_document_annee_value']->content;
        endif;
      endif;
		?>
	</span>
	
	<div class="mr-propre"></div>
</div>

<div class="mr-propre"></div>


<!--le corps-->
<div class="views-view--content-apresblocgris">
	
	<div class="views-view--DocsPIM-attachment-1-content-image">
	<?php
		//on affiche l'image avec en lien le fichier
		//var_dump($fields['field_document_image_fid']->content);
		//var_dump($fields['field_document_fichier_fid']->content);
	  global $base_url;
	  $imagepath = $base_url.'/'.$fields['field_document_image_fid']->content;
      if (! empty($fields['field_document_fichier_fid']->content)) {
        $file_path = $base_url.'/'.$fields['field_document_fichier_fid']->content;
        print '<a href="'.$file_path.'" alt="'.t("Document Source").'" class="blank">';
        print "<img src='$imagepath' alt='$alt' height='168' width='118'/> ";
        print '</a>';
      }
      else {
        print "<img src='$imagepath' alt='$alt' height='168' width='118'/> ";
      }
	 ?>
	</div>
	
	
	<div class="texte-gris">	
		<?php print $fields['field_document_description_value']->content; ?>
	</div>
	
    
	<div class="texte-gris">
		<p>
      <label class="texte-gris-em">
          <?php 
          print t("Authors(s)")." : ";
          ?>
      </label>
		<?php print $fields['field_document_auteur_value']->content; ?>
		</p>
	</div>
	
	
	<?php if($fields['field_document_langue_value']->raw): ?>
		<div class="texte-gris">
			<p>
        <label class="texte-gris-em">
            <?php 
            print t("Language")." : ";
            ?>
        </label>
			<?php print $fields['field_document_langue_value']->content; ?>
			</p>
		</div>
	<?php endif; ?>
	
	<?php if($fields['field_document_nb_pages_value']->raw): ?>
		<div class="texte-gris">	
			<p>
				<label class="texte-gris-em">
          <?php 
          print t("Num. of pages")." : ";
          ?>
        </label>
				<?php print $fields['field_document_nb_pages_value']->content; ?>
			</p>
		</div>
	<?php endif; ?>
    
	<?php if($fields['field_document_cote_isbn_value']->raw): ?>	
		<div class="texte-gris">	
			<p>
				<label class="texte-gris-em">
            <?php 
            print t("Cote ISBN")." : ";
            ?>
        </label>
				<?php print $fields['field_document_cote_isbn_value']->content; ?>
			</p>
		</div>
	<?php endif; ?>
	
	<?php if($fields['field_document_edition_value']->raw): ?>
		<div class="texte-gris">	
			<p>
				<label class="texte-gris-em">
            <?php 
            print t("Edition")." : ";
            ?>
        </label>
				<?php print $fields['field_document_edition_value']->content; ?>
			</p>
		</div>
	<?php endif; ?>
	
	<?php if($fields['field_document_type_de_document_value']->raw): ?>
		<div class="texte-gris">	
			<p>
				<label class="texte-gris-em">
            <?php 
            print t("Type")." : ";
            ?>
        </label>
				<?php print $fields['field_document_type_de_document_value']->content; ?>
			</p>
		</div>
	<?php endif; ?>
	
	

</div>

