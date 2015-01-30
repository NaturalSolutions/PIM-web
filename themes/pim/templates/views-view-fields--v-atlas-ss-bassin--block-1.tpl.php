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

<?php if ($id == 'field_ss_bassin_author_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $author = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_pic_of_map_data') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $title_picture = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_pic_of_map_fid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $url_picture = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_caract_env_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $caract_env = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_context_eco_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $context_eco = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_occupation_hum_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $occup_hum = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_terrestre_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $usage_dom_terrestre = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_marrin_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $usage_dom_marrin = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_terrestre_e_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $etat_dom_terrestre = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_marin_e_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $etat_dom_marrin = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_status_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $status_conserv = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_strat_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $strategie_conserv = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_biblio_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $biblio = $field->content; ?>
  <?php endif; ?>
<?php endif;?>


<?php endforeach; ?>

<?php if($language->language == 'fr'): ?>

  <a class='titleSSbassin' title='Editer' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Rédigé par : <i><?php echo $author; ?></i>


  <?php if($url_picture): ?><img class='imageMap' src="<?php echo $base_url.'/sites/default/files/atlas/ss_bassin/'.$url_picture; ?>" alt='' title="<?php echo $title_picture; ?>" /><?php endif; ?>


  <div id='containerOfTabRecap'>

    
      <p class='headerLabelLeft'>Archipels retenus <br/><i>(secteurs géographiques)</i></p><p class='headerLabelRight'>Iles retenues pour les fiches<br/>&nbsp;</p>
      <?php print views_embed_view('v_atlas_affiche_tab_ile_cluster', 'block_1', $nid); ?>

  </div>





  <h3>1 - Présentation et caractéristiques générales</h3>
  <div class='indentRight1'>
    
    <h4>1.1 Caractéristiques générales :</h4>
    <?php echo $caract_env; ?>
    

    <h4>1.2 Contexte écologique et patrimoine naturel :</h4>
    <?php echo $context_eco; ?>
    

    <h4>1.3 Occupation humaine ancienne et histoire de l'environnement :</h4>
    <?php echo $occup_hum; ?>
    
  </div>

  <h3>2 - Usages contemporains et pressions</h3>
  <div class='indentRight1'>
    
    <h4>2.1 Usage domaine terrestre :</h4>
    <?php echo $usage_dom_terrestre; ?>
    

    <h4>2.2 Usage domaine marin :</h4>
    <?php echo $usage_dom_marrin; ?>
    
  </div>

  <h3>3 - Etat des connaissances sur la biodiversité et enjeux de conservation</h3>
  <div class='indentRight1'>
    
    <h4>3.1 Etat domaine terrestre :</h4>
    <?php echo $etat_dom_terrestre; ?>
    

    <h4>3.2 Etat domaine marin :</h4>
    <?php echo $etat_dom_marrin; ?>
    
  </div>

  <h3>4 -Status de conservation et gestion</h3>
  <div class='indentRight1'>
    
    
    <?php echo $status_conserv; ?>
    
  </div>

  <h3>5 - Stratégie de conservation</h3>
  <div class='indentRight1'>
    
    
    <?php echo $strategie_conserv; ?>
    
  </div>

  <h3>Principales ressources bibliographiques :</h3>
  <div class='indentRight1'>
    
    <?php echo $biblio; ?>
    
  </div>

<?php else: ?>


  <a class='titleSSbassin' title='Edit' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Written by: <i><?php echo $author; ?></i>


  <?php if($url_picture): ?><img class='imageMap' src="<?php echo $base_url.'/sites/default/files/atlas/ss_bassin/'.$url_picture; ?>" alt='' title='' /><?php endif; ?>


  <div id='containerOfTabRecap'>

    
      <p class='headerLabelLeft'>Selected archipelago<br/><i>&nbsp;</i></p><p class='headerLabelRight'>Selected islands for factsheets<br/>&nbsp;</p>
      <?php print views_embed_view('v_atlas_affiche_tab_ile_cluster', 'block_1', $nid); ?>

  </div>





  <h3>1 - Presentation of the sub-basin and general characteristics </h3>
  <div class='indentRight1'>
    
    <h4>1.1 Environment characteristics:</h4>
    <?php echo $caract_env; ?>
    

    <h4>1.2 Ecological context and natural heritage:</h4>
    <?php echo $context_eco; ?>
    

    <h4>1.3 Ancient human activities and environment history:</h4>
    <?php echo $occup_hum; ?>
    
  </div>

  <h3>2 - Contemporary human activities and pressures existing on the sub-basin</h3>
  <div class='indentRight1'>
    
    <h4>2.1 Terrestrial environment:</h4>
    <?php echo $usage_dom_terrestre; ?>
    

    <h4>2.2 Marine environment:</h4>
    <?php echo $usage_dom_marrin; ?>
    
  </div>

  <h3>3 - State of knowledge concerning biodiversity and its conservation stakes</h3>
  <div class='indentRight1'>
    
    <h4>3.1 Terrestrial environment:</h4>
    <?php echo $etat_dom_terrestre; ?>
    

    <h4>3.2 Marine environment:</h4>
    <?php echo $etat_dom_marrin; ?>
    
  </div>

  <h3>4 - Protection statuses and management issues</h3>
  <div class='indentRight1'>
    
    
    <?php echo $status_conserv; ?>
    
  </div>

  <h3>5 - Preservation strategy  </h3>
  <div class='indentRight1'>
    
    
    <?php echo $strategie_conserv; ?>
    
  </div>

  <h3>Main bibliographic references </h3>
  <div class='indentRight1'>
    
    <?php echo $biblio; ?>
    
  </div>
<?php endif; ?>