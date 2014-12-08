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
/*                VUE AFFICHE FIELDS OF ENCYCPLOPEDIE PART                 */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'title') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $title = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $nid = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encylop_author_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encylop_author_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encylop_body_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encylop_body_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>



<?php endforeach; ?>

<?php if($language->language == 'fr'): ?>

  <a class='titleSSbassin' title='Editer' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Rédigé par : <i><?php echo $field_encylop_author_value; ?></i>

  <br/>
  <br/>
  <br/>


  
  <!-- <h3>1 - Introduction</h3> -->
  <!-- <div class='indentRight1'> -->
    
    <?php echo $field_encylop_body_value; ?>
    
  <!-- </div> -->

  

<?php else: ?>


  <a class='titleSSbassin' title='Edit' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Written by: <i><?php echo $field_encylop_author_value; ?></i>


     <br/>
  <br/>
  <br/>
  <!-- <h3>1 - Introduction</h3> -->
  <!-- <div class='indentRight1'> -->
    
    <?php echo $field_encylop_body_value; ?>
    
  <!-- </div> -->

  
<?php endif; ?>