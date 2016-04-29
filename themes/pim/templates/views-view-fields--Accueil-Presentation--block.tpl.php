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

<div class="accueil-block-presentation">

    <div class="accueil-block-presentation-header">

        <h1> 
            <span class="accueil-titre-bleu-mini ">
                <?php print $fields['title']->content; ?> 
            </span>
            <span class="accueil-soustitre-bleu-mini">
                <?php print $fields['field_chapeau_soustitre_value']->content; ?> 
            </span>
        </h1>
    </div>
    
    <div class="accueil-block-presentation-content">
        <div class="texte-gris"> 
            <?php print $fields['field_chapeau_texte_value']->content; ?>
        </div>
    </div>

</div>