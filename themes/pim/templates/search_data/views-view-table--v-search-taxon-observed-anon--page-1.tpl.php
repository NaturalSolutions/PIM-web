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
global $base_url;
?>
<div id="ficheile">
<table class="<?php print $class; ?>">
    <tr>
      <?php foreach ($header as $field => $label): ?>
		    <?php if ($field!='TaxonID'):?>
		      <td class="tableile-label">
		        <div class="texte-gris"><?php print $label; ?></div>
		      </td>
        <?php endif; ?>
      <?php endforeach; ?>
    </tr>
    <?php foreach ($rows as $count => $row): ?>
      <tr>
      	 <td class="ficheile-value">
             <div class="texte-gris">                    
                 <?php  
                  $date = new DateTime($row['Date_value']);
                  echo $date->format('d/m/Y');
                  ?>
             </div>
          </td>
      	 <td class="ficheile-value">
             <div class="texte-gris"><?php print $row['Zone_geographique']; ?></div>
          </td>
      	 <td class="ficheile-value">
             <div class="texte-gris"><?php print $row['Noms_ile']; ?></div>
          </td>
      	 <td class="ficheile-value">
             <div class="texte-gris"><?php print $row['compartiment']; ?></div>
          </td>
      	 <td class="ficheile-value">
      	 		<?php if ($row['compartiment']=='Faune flore marines'):?>
             
             <div class="texte-gris"><a href="<?php print $base_url.'/fiche-worms/'.$row['TaxonID']; ?>"><?php print $row['taxon']; ?></a></div>
        		<?php else: ?>
             <div class="texte-gris"><a href="<?php print $base_url.'/fiche-taxon/'.$row['TaxonID']; ?>"><?php print $row['taxon']; ?></a></div>
        		<?php endif; ?>
          </td>
      	 <td class="ficheile-value">
             <div class="texte-gris"><?php print $row['Observateurs']; ?></div>
          </td>
          
      </tr>
    <?php endforeach; ?>
</table></div>
