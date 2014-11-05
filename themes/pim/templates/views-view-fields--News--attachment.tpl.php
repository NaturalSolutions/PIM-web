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
if ((in_array("Admin PIM", $user->roles)) or (in_array("Mega Admin", $user->roles))): ?>
<div class="bloc-admin-extras">
    <span class="admin-links">
        <?php print $fields['view_node']->content; print " "; ?>
        <?php print $fields['edit_node']->content; ?>
    </span>
</div>

<div class="mr-propre"></div>

<?php endif; ?>	

<!--l'entête-->

<div class="bloc-gris" id="news-<?php print $fields['nid']->content; ?>">
	<span class="bloc-gris-titre">
		<?php if($fields['title']->content): ?>
			<?php print $fields['title']->content; ?> -
		<?php endif; ?>
		<?php if( $fields['field_news_soustitre_value']->content): ?>
			<?php print $fields['field_news_soustitre_value']->content; ?>
		<?php endif; ?>	
	</span>
	<!-- 2011-06-27T00:00:00 -->
	<!-- mktime(heure, minute, seconde, mois, jour, annee) mktime(0,0,0,07,28,2011) -->
	<?php if($fields['field_news_date_value']->raw): ?>
		<span class="bloc-gris-date">
		<?php preg_match("/(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})/", $fields['field_news_date_value']->raw, $matches);
				    $datetime = mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]);
                    /* ce format ne convient pas à toutes les langues
				    echo date("d/m/Y",$datetime); 
                    */
                    /* $type can be 'small', 'medium' or 'large' */
                    print format_date($datetime, $type = 'small', 
                        $format = '', $timezone = NULL, $langcode = i18n_get_lang()); 
                    ?>
		</span>
	<?php endif; ?>
	<div class="mr-propre"></div>
</div>

<div class="mr-propre"></div>

<div class="views-view--content-apresblocgris">

		<?php if($fields['field_news_image_fid']): ?>
			<div class="views-view--topnews-attachment-1-content-image">
                <<?php print $fields['field_news_image_fid']->inline_html;?> class="views-field-<?php print $fields['field_news_image_fid']->class; ?>">
				
						<?php
						// $field->element_type is either SPAN or DIV depending upon whether or not
						// the field is a 'block' element type or 'inline' element type.
						?>
						<<?php print $fields['field_news_image_fid']->element_type; ?> class="field-content"> 
                            <?php print $fields['field_news_image_fid']->content; ?>
						</<?php print $fields['field_news_image_fid']->element_type; ?>>
				</<?php print $fields['field_news_image_fid']->inline_html;?>>
			</div>
		<?php endif; ?>
	
		
		<div class="texte-gris">
            <?php print $fields['field_news_texte_value']->content; ?>
		</div>
		
</div>
