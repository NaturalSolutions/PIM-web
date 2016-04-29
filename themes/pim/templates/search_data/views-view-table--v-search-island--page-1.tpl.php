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
<?php //print_r($rows); 

//taxonomy_get_term_by_name($tid);

?>
<div id="ficheile">
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <tbody>
    <tr>
    	<td class="tableile-label">
         <div class="texte-gris"><?php print t($header['field_bdi_dp_zone_geographique_value']); ?></div>
        </td>
        <td class="tableile-label">
          <div class="texte-gris"><?php print $header['field_bdi_dp_nom_ile_code_ile_value']; ?></div>
        </td>
        <td class="tableile-label">
          <div class="texte-gris"><?php print t('Name(s)'); ?></div>
        </td>
    </tr>
    <?php foreach ($rows as $count => $row): ?>
    	<?php 
			$term = taxonomy_get_term_by_name($row['field_bdi_dp_nom_ile_code_ile_value_1']);
			$synonyms = taxonomy_get_synonyms($term[0]->tid);
			//print_r($term[0]->tid);
			?>
      <tr >
      	<td class="ficheile-value">
            <div class="texte-gris"><?php print $row['field_bdi_dp_zone_geographique_value']; ?></div>
        </td>
        <td class="ficheile-value">
            <div class="texte-gris"><?php print $row['field_bdi_dp_nom_ile_code_ile_value']; ?></div>
        </td>
        
         <td class="ficheile-value">
		       <div class="texte-gris"><?php foreach ($synonyms as  $synonym): ?>
		          <?php print $synonym .', '; ?>
       			<?php endforeach; ?></div>
          </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
