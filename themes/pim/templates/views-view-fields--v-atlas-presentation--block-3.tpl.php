<?php
// $Id$
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
/***************************************************************************/
/***************************************************************************/
/*                   VUE AFFICHE PRESENTATION                              */
/*                                                                         */
/*                        DISPLAY : Affiche Derniere connexion             */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'login') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $login = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'name') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $name = $field->content; ?>
  <?php endif; ?>
<?php endif;?>







<?php endforeach; ?>



  <p>Dernière connexion le <?php echo $login; ?> par <?php echo $name; ?></p>



