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
/* 
 * NOTE: 
 *   - Tous les champs sont des liens 
 *   - Tous les champs sont obligatoires ou ont une valeur par défaut
*/
?>

<div class="accueil-blockgris">

	<div class="accueil-block-docs-image">
        <<?php print $fields['field_document_image_fid']->inline_html;?> class="views-field-<?php print $fields['field_document_image_fid']->class; ?>">
            <?php
            // $field->element_type is either SPAN or DIV depending upon whether or not
            // the field is a 'block' element type or 'inline' element type.
            ?>
            <<?php print $fields['field_document_image_fid']->element_type; ?> class="field-content">
                <?php print $fields['field_document_image_fid']->content; ?>
            </<?php print $fields['field_document_image_fid']->element_type; ?>>
        </<?php print $fields['field_document_image_fid']->inline_html;?>>
    </div>

    <div class="accueil-blocgris-titre">
        <span class="texte-blanc-grossi-gras">
            <a title=<?php print '"';print t("read more");print '"';?> href="node/<?php print $fields['nid']->content;?>">
            <?php print $fields['field_document_titre_value']->content; ?>
            </a>
        </span>
    </div>
    
    <div class="accueil-blocgris-content">
		<span class="texte-blanc">
            <a title=<?php print '"';print t("read more");print '"';?> href="node/<?php print $fields['nid']->content;?>">
                <?php print $fields['field_document_description_value']->content; ?>
            </a>
        </span>
    </div>
    
    
    
    <div class="mr-propre"></div>
		
</div>
