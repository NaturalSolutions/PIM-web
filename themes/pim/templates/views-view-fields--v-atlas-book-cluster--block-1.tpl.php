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
/*                   VUE AFFICHE FIELDS OF ILE                             */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url;
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

<?php if ($id == 'field_cluster_have_ile_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_iles = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_connaiss_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $connaissances = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_interet_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $interet = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_pression_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $pression = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_gest_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $gestion = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_image_fid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $url_picture = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_have_ss_bassin_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_ss_bassin = $field->content; ?>
  <?php endif; ?>
<?php endif;?>


<?php if ($id == 'field_cluster_biblio_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $biblio = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_autor_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $author = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_desc_gen_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $descGen = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_tab_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $tab = $field->content; ?>
  <?php endif; ?>
<?php endif;?>



<?php endforeach; ?>

<a class='titleCulster' title='Editer' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
<br/>Rédigé par : <i><?php echo $author; ?></i>

<br/>
<br/>
<?php if($url_picture): ?>

  <div>
    <?php echo $url_picture; ?>
  </div>
  <!--  <img class='imageMap' src="<?php //echo $base_url.'/sites/default/files/atlas/ss_bassin/'.$url_picture; ?>" alt='' title='' /> -->

<?php endif; ?>
<br/>


<?php echo $tab; ?>

<h3> Description générale</h3>

<?php echo $descGen; ?>

<h4>Connaissances :</h4>

<?php echo $connaissances; ?>

<h4>Intérêts :</h4>
<?php echo $interet; ?>
  
<h4>Pressions :</h4>
<?php echo $pression; ?>

<h4>Gestion / conservation :</h4>
<?php echo $gestion; ?>
  
  


<h3>Principales ressources bibliographiques :</h3>
<div class='indentRight1'>
  
  <?php echo $biblio; ?>
  
</div>

<!-- <h3>Est présent dans le sous bassin :</h3> -->
<!-- <div class='indentRight1'> -->
 
 <!-- <?php //echo $have_ss_bassin; ?> -->
  
<!-- </div> -->

<h3>Îles présentes dans ce cluster :</h3>
<div class='indentRight1'>
 
 <?php if($have_iles) echo $have_iles; else echo 'Aucune'; ?>
  
</div>
