<?php
// $Id$
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
$principe_gestion_tid = $_GET['field_bdi_g_principe_gestion_value'];
$principe_gestion = taxonomy_get_term($principe_gestion_tid);
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
 <?php 
	$sql = "SELECT DISTINCT field_bdi_g_adresse_gestionnaire_value  AS adresse  FROM {content_type_bd_i_gestionnaire} WHERE UPPER(field_bdi_g_nom_gestionnaire_value) LIKE UPPER('%s%')";
	$cleantitle =  htmlspecialchars_decode($title, ENT_QUOTES);
	$result = db_query($sql, $cleantitle);
	if ($result->num_rows>0) {
		while ($row = db_fetch_array($result)) {
			print  '<div>'.$row['adresse'].'</div>';
		}
	}
		print '<div>'. t('Number of managed islands'). ': ';
		print count($rows); 
		print '</div>';
	?>
<?php else: ?>
  <h3><?php print t('No manager'); ?></h3>
<?php endif; ?>

<?php if (($principe_gestion->name)): ?>
	<div>
		<?php 
			print  t('Management principles and actions'). ': ';
			print $principe_gestion->name; 
		?>
	</div>
	<div id="ficheile" class="texte-gris">
			<?php foreach ($rows as $id => $row): ?>
				<?php print $row; ?>
			<?php endforeach; ?>
	</div>
<?php else: ?>
<div id="ficheile">
	<table class="<?php print $classes[$id]; ?>">
	<?php foreach ($rows as $id => $row): ?>
		  <?php print $row; ?>
	<?php endforeach; ?>
	</table>
</div>
<?php endif; ?>	
		

