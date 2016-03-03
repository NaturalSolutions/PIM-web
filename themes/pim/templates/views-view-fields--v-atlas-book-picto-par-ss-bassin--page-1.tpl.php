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
?><?php //Get nid of island ?>
<?php foreach ($fields as $id => $field): ?>
  <?php if($id == 'nid' && $field->content != ''): ?>
    <?php $nid = $field->content; ?>
  <?php endif; ?>
<?php endforeach; ?>
<?php //Get code ile renseigné  ?>
<?php foreach ($fields as $id => $field): ?>
  <?php if($id == 'field_ile_code_value' && $field->content != ''): ?>
    <?php $field_ile_code_value = $field->content; ?>
  <?php endif; ?>
<?php endforeach; ?>
<?php


//On va chercher la valeur du champs "field_ile_have_ss_bassin" de book_ile pour savoir à quel sous_bassin appartient l'ile
$sql = "SELECT s.field_ile_have_ss_bassin_nid FROM drp_content_field_ile_have_ss_bassin s where s.nid = '".$nid."';";           
$result = db_query($sql);
$result = db_fetch_array($result); 
$id_sous_bassin_of_current_island = $result['field_ile_have_ss_bassin_nid'];

//On va chercher le nom du sous bassin 
$sql = "SELECT n.title FROM pimPierre.drp_node n where n.nid = '".$id_sous_bassin_of_current_island."';"; 
$result = db_query($sql);
$result = db_fetch_array($result); 
$title_of_sous_bassin = $result['title'];




//echo "ID de l'ile : ".$nid.'<br/>';
//echo "field_ile_code_value : ".$field_ile_code_value.'<br/>';

$currentIsland = node_load($nid);

echo "<h2>".$title_of_sous_bassin.'</h2>';
echo "<h4>".$currentIsland->title.'</h4>';




//Get termName
$termName = $field_ile_code_value;     


/*-- ----------------------------------------------------------------------------
-- État des connaissances
-- ----------------------------------------------------------------------------*/

//Bota
$sql = "select b.niveau from picto_etaco_bota b where code_ile = '".$termName."'";           
$result = db_query($sql);
$result = db_fetch_array($result); 
$etatBota = $result['niveau'] - 1;
echo "Bota : ".$etatBota."<br/>";

//Ornithologie
$sql = "select b.niveau from picto_etaco_ornitho b where code_ile = '".$termName."'";           
$result = db_query($sql);
$result = db_fetch_array($result);             
$etatOrni = $result['niveau'] - 1;
echo "Ornithologie : ".$etatBota."<br/>";

//Herpétologie
$sql = "select b.niveau from picto_etaco_herpeto b where code_ile = '".$termName."'";           
$result = db_query($sql);
$result = db_fetch_array($result);
$etatHerpe = $result['niveau'] - 1;
echo "Herpétologie : ".$etatBota."<br/>";

//Mammifères
$sql = "select b.niveau from picto_etaco_mamm b where code_ile = '".$termName."'";           
$result = db_query($sql);
$result = db_fetch_array($result);             
$etatMami = $result['niveau'] - 1;
echo "Mammifères : ".$etatBota."<br/>";

echo "<br/><center>-------------------------------------------------------------------------------------------------------------------------</center><br/>";
?>