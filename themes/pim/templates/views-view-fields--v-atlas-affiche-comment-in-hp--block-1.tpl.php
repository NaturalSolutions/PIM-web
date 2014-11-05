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
/*                   VUE AFFICHE FIELDS OF SOUS BASSIN                     */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $user, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'name') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $name = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'comment') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $comment = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'timestamp') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $timestamp = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'edit_comment') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $edit_comment = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'delete_comment') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $delete_comment = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'subject') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $subject = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'uid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $uid = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'type') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $type = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'path') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $path = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php endforeach; ?>



<div class='containerOfOneComment'>

  <?php if($language->language == 'fr'): ?>
    <p>Par <?php echo $name; ?><br/><i>le <?php echo $timestamp."</i> sur le contenu : <a href='$path' target='_blank'>$type</a></p>"; ?>
  <?php else: ?>
    <p>By <?php echo $name; ?><br/><i>At <?php echo $timestamp."</i> on the content: <a href='$path' target='_blank'>$type</a></p>"; ?>
  <?php endif; ?>
  
  
  <?php echo $comment; ?>
  
  <?php if($uid == $user->uid): ?>
    <?php echo $edit_comment; ?>
    <?php echo $delete_comment; ?>
  <?php endif; ?>


</div>