<?php
// $Id$
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * @ingroup views_templates
 */
?>
<?php 
/*
print '<pre>';
print_r($fields);
print '</pre>';
*/
 ?>
<div id="ficheile">
<div class="table-report">


<?php 

//print_r($rows);

?>
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <thead>
    <tr>
      <?php foreach ($header as $field => $label): ?>
      	<?php if (! preg_match("/field_bd_t_taxon_[^t]/i", $field)) : ?>
		      <th class="views-field views-field-<?php print $fields[$field]; ?>">
		        <?php print $label; ?>
		      </th>
				<?php endif; ?>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
    
				<?php 
				$info = _get_compartiment_infos($row['field_bd_t_compartiment_value']); 
				//print_r($info);
				$taxon = $row[$info['field_taxon']];
				?>
    
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <?php foreach ($row as $field => $content): ?>
					<?php if (preg_match("/field_bd_t_taxon/i", $field)) : ?>
						<?php if ($field =='field_bd_t_taxon_texte_value') : ?>
		       		<td class="views-field views-field-<?php print $fields[$field]; ?>">
									<?php print $taxon; ?>
				      </td>
				    <?php endif; ?>
					<?php else: ?>
		        <td class="views-field views-field-<?php print $fields[$field]; ?>">
						      <?php print $content; ?>
		        </td>
					<?php endif; ?>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
</div>


<?php
/*
Herpétologie
Faune flore marines
Botanique
Arthopode
Chiroptère
Mammifère terrestre non volant
Ornithologie
Autre sp. terrestres
*/
function _get_compartiment_infos($compartiment) {
/*64	Référentiel autres terrestres
55	Référentiel Botanique
28	Référentiel Chiroptères PIM
56	Référentiel Entomo
29	Référentiel Herpéto PIM
26	Référentiel Mammifère terrestre non volant PIM
21	Référentiel Ornithologie AERC*/
/*
[field_bd_t_taxon_entomo_value] => [field_bd_t_taxon_autre_terrestre_value] =>
[field_bd_t_taxon_bota_value] => [field_bd_t_taxon_chiroptere_value] =>
 [field_bd_t_taxon_herpeto_value] => [field_bd_t_taxon_mam_terrestre_value] => Rattus 
 [field_bd_t_taxon_ornitho_value] => [field_bd_t_taxon_worms_worms_lsid] => */
	$info = array();
	switch ($compartiment ){
		case 'Ornithologie':
			$info['ref']='INT';
			$info['vid']=21;
			$info['field_taxon'] = 'field_bd_t_taxon_ornitho_value';
			$info['content_type'] = 'bd_ni_ornithologie_present';
			break;
		case 'Herpétologie':
			$info['ref']='INT';
			$info['vid']=29;
			$info['field_taxon'] = 'field_bd_t_taxon_herpeto_value';
			$info['content_type']='bd_ni_herpetologie_present';
			break;
		case 'Faune flore marines':
			$info['ref']='EXT';
			$info['ref_detail']='worms';
			$info['field_taxon'] = 'field_bd_t_taxon_worms_worms_lsid';
			$info['content_type']='bd_ni_ornithologie_present';
			break;
		case 'Botanique':
			$info['ref']='INT';
			$info['vid']=55;
			$info['field_taxon'] = 'field_bd_t_taxon_bota_value';
			$info['content_type']='bd_ni_botanique_present';
			break;
		case 'Arthopode':
			$info['ref']='INT';
			$info['vid']=56;
			$info['field_taxon'] = 'field_bd_t_taxon_entomo_value';
			$info['content_type']='bd_ni_entomo_present';
			break;
		case 'Chiroptère':
			$info['ref']='INT';
			$info['vid']=28;
			$info['field_taxon'] = 'field_bd_t_taxon_chiroptere_value';
			$info['content_type']='bd_ni_chiroptere_present';
			break;
		case 'Mammifère terrestre non volant':
			$info['ref']='INT';
			$info['vid']=26;
			$info['field_taxon'] = 'field_bd_t_taxon_mam_terrestre_value';
			$info['content_type']='bd_ni_mam_terrestres_present';
			break;
		case 'Autre sp. terrestres':
			$info['ref']='INT';
			$info['vid']=64;
			$info['field_taxon'] = 'field_bd_t_taxon_autre_terrestre_value';
			$info['content_type']='bd_ni_autre_terrestre_present';
			break;
	}
	return $info;
}
?>



