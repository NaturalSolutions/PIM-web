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
/*                       VUE AFFICHE ALL ENCADRE                           */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'field_ile_connaiss_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ile_connaiss_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_interet_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ile_interet_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_pression_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ile_pression_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_gest_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ile_gest_conserv_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_desc_gen_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ile_desc_gen_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_connaiss_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_cluster_connaiss_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_interet_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_cluster_interet_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_pression_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_cluster_pression_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_gest_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_cluster_gest_conserv_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_desc_gen_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_cluster_desc_gen_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_caract_env_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_caract_env_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_context_eco_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_context_eco_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_occupation_hum_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_occupation_hum_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_terrestre_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_dom_terrestre_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_marrin_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_dom_marrin_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_terrestre_e_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_dom_terrestre_e_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_dom_marin_e_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_dom_marin_e_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_status_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_status_conserv_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ss_bassin_strat_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_ss_bassin_strat_conserv_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'path') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $path = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>
<!-- -- -->
<?php if ($id == 'field_encyclop_part1_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part1_txt5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part1_txt5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>
<!-- -- -->
<?php if ($id == 'field_encyclop_part2_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part2_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part2_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part2_txt2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part2_txt3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part2_txt3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part2_txt4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part2_txt4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part2_txt5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part2_txt5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<!-- -- -->

<?php if ($id == 'field_encyclop_part3_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt6_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt6_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt7_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt7_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt8_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt8_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt9_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt9_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt10_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt10_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part3_txt11_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part3_txt11_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<!-- -- -->

<?php if ($id == 'field_encyclop_part4_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part4_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part4_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part4_txt2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part4_txt3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part4_txt3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part4_txt4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part4_txt4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part4_txt5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part4_txt5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part4_txt6_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part4_txt6_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<!-- -- -->

<?php if ($id == 'field_encyclop_part5_txt1_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part5_txt1_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part5_txt2_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part5_txt2_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part5_txt3_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part5_txt3_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part5_txt4_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part5_txt4_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part5_txt5_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part5_txt5_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_encyclop_part5_txt6_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_encyclop_part5_txt6_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php endforeach; ?>


<?php 
if (strpos($field_ile_connaiss_value,'encadreStyle') !== false) {
 
	echo "<div class='conteneurRelatif'>";
   
    echo $field_ile_connaiss_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ile_interet_value,'encadreStyle') !== false) {
    
	echo "<div class='conteneurRelatif'>";
   
    echo $field_ile_interet_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ile_pression_value,'encadreStyle') !== false) {
    
	echo "<div class='conteneurRelatif'>";
   
    echo $field_ile_pression_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ile_gest_conserv_value,'encadreStyle') !== false) {
    
	echo "<div class='conteneurRelatif'>";
   
    echo $field_ile_gest_conserv_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ile_desc_gen_value,'encadreStyle') !== false) {
    
	echo "<div class='conteneurRelatif'>";
   
    echo $field_ile_desc_gen_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_cluster_connaiss_value,'encadreStyle') !== false) {
    
	echo "<div class='conteneurRelatif'>";
   
    echo $field_cluster_connaiss_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_cluster_interet_value,'encadreStyle') !== false) {

	echo "<div class='conteneurRelatif'>";
   
    echo $field_cluster_interet_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_cluster_pression_value,'encadreStyle') !== false) {

  echo "<div class='conteneurRelatif'>";
   
    echo $field_cluster_pression_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_cluster_gest_conserv_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_cluster_gest_conserv_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_cluster_desc_gen_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_cluster_desc_gen_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_caract_env_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_caract_env_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_context_eco_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_context_eco_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_occupation_hum_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_occupation_hum_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_dom_terrestre_value,'encadreStyle') !== false) {
    
	echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_dom_terrestre_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
  	echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_dom_marrin_value,'encadreStyle') !== false) {
    
	 echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_dom_marrin_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_dom_terrestre_e_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_dom_terrestre_e_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_dom_marin_e_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_dom_marin_e_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_status_conserv_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_status_conserv_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_ss_bassin_strat_conserv_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_ss_bassin_strat_conserv_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part_txt1_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part_txt1_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part_txt2_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part_txt2_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
/*--*/
if (strpos($field_encyclop_part1_txt1_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part1_txt1_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part1_txt2_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part1_txt2_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part1_txt3_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part1_txt3_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part1_txt4_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part1_txt4_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part1_txt5_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part1_txt5_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
/**/
if (strpos($field_encyclop_part2_txt1_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part2_txt1_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part2_txt2_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part2_txt2_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part2_txt3_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part2_txt3_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part2_txt4_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part2_txt4_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part2_txt5_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part2_txt5_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
/**/
if (strpos($field_encyclop_part3_txt1_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt1_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt2_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt2_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt3_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt3_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt4_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt4_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt5_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt5_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt6_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt6_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt7_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt7_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt8_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt8_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt9_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt9_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt10_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt10_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part3_txt11_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part3_txt11_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
/*--*/
if (strpos($field_encyclop_part4_txt1_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part4_txt1_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part4_txt2_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part4_txt2_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part4_txt3_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part4_txt3_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part4_txt4_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part4_txt4_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part4_txt5_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part4_txt5_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part4_txt6_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part4_txt6_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}

/*--*/

if (strpos($field_encyclop_part5_txt1_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part5_txt1_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part5_txt2_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part5_txt2_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part5_txt3_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part5_txt3_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part5_txt4_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part5_txt4_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}
if (strpos($field_encyclop_part5_txt5_value,'encadreStyle') !== false) {
    
  echo "<div class='conteneurRelatif'>";
   
    echo $field_encyclop_part5_txt5_value;
    echo '<div class="enSavoirPlus">Voir+</div>';
    echo $path;
    echo '<br/><br/>';
 
  echo "</div>";
}

// if (strpos($field_ss_bassin_dom_terrestre_value,'encadreStyle') !== false) {

//   //$img = $dom->getElementsByTagName('encadreStyle')->item(0);
//   //echo $img->attributes->getNamedItem("src")->value;
  
//   echo $field_ss_bassin_dom_terrestre_value;
  
//   $tab = explode("<p class='encadreStyle'", $field_ss_bassin_dom_terrestre_value);
//   //echo $tab[0]; 


//   echo $path;
//   echo '<br/><br/>';


// }

?>
