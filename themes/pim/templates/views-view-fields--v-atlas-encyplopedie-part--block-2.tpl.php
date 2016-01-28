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
/*                VUE AFFICHE FIELDS OF ENCYCPLOPEDIE PART1                */
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

<?php if ($id == 'field_encyclop_part1_h1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_h1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_aut1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_aut1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_h2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_h2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_aut2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_aut2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_h3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_h3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_aut3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_aut3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_h4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_h4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_aut4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_aut4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_h5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_h5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_aut5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_aut5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_biblio1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_biblio1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>



<?php endforeach; ?>

<?php if($language->language == 'fr'): ?>

  <a class='titleSSbassin' title='Editer' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  
  <br/>
  <br/>
  <br/>
        
    <h4><?php echo $field_encyclop_part1_h1_value; ?></h4> <p><?php echo $field_encyclop_part1_aut1_value; ?></p>
    <?php echo $field_encyclop_part1_txt1_value; ?>

    <h4><?php echo $field_encyclop_part1_h2_value; ?></h4> <p><?php echo $field_encyclop_part1_aut2_value; ?></p>
    <?php echo $field_encyclop_part1_txt2_value; ?>

    <h4><?php echo $field_encyclop_part1_h3_value; ?></h4> <p><?php echo $field_encyclop_part1_aut3_value; ?></p>
    <?php echo $field_encyclop_part1_txt3_value; ?>

    <h4><?php echo $field_encyclop_part1_h4_value; ?></h4> <p><?php echo $field_encyclop_part1_aut4_value; ?></p>
    <?php echo $field_encyclop_part1_txt4_value; ?>

    <h4><?php echo $field_encyclop_part1_h5_value; ?></h4> <p><?php echo $field_encyclop_part1_aut5_value; ?></p>
    <?php echo $field_encyclop_part1_txt5_value; ?>

    <?php if($field_encyclop_biblio_value): ?>
      <h4>Principales ressources bibliographiques :</h4>
      <?php echo $field_encyclop_biblio1_value; ?>
    <?php endif; ?>
    

<?php else: ?>


  <a class='titleSSbassin' title='Edit' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  
  <br/>
  <br/>
  <br/>
    
    <h4><?php echo $field_encyclop_part1_h1_value; ?></h4> <p><?php echo $field_encyclop_part1_aut1_value; ?></p>
    <?php echo $field_encyclop_part1_txt1_value; ?>

    <h4><?php echo $field_encyclop_part1_h2_value; ?></h4> <p><?php echo $field_encyclop_part1_aut2_value; ?></p>
    <?php echo $field_encyclop_part1_txt2_value; ?>

    <h4><?php echo $field_encyclop_part1_h3_value; ?></h4> <p><?php echo $field_encyclop_part1_aut3_value; ?></p>
    <?php echo $field_encyclop_part1_txt3_value; ?>

    <h4><?php echo $field_encyclop_part1_h4_value; ?></h4> <p><?php echo $field_encyclop_part1_aut4_value; ?></p>
    <?php echo $field_encyclop_part1_txt4_value; ?>

    <h4><?php echo $field_encyclop_part1_h5_value; ?></h4> <p><?php echo $field_encyclop_part1_aut5_value; ?></p>
    <?php echo $field_encyclop_part1_txt5_value; ?>

    <?php if($field_encyclop_biblio_value): ?>
      <h4>Principales ressources bibliographiques :</h4>
      <?php echo $field_encyclop_biblio1_value; ?>
    <?php endif; ?>
    
  
<?php endif; ?>