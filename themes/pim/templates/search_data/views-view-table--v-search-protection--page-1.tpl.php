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
<div id="ficheile">
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <thead>
    <tr>
      <?php foreach ($header as $field => $label): ?>
        <td class="tableile-label">
         <div class="texte-gris"> <?php print $label; ?></div>
        </td>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
      <tr>
        <td class="ficheile-value">
            <div class="texte-gris"><?php print $row['Zone_Geographique']; ?></div>
        </td>
        <td class="ficheile-value">
            <div class="texte-gris"><?php print $row['Noms_ile']; ?></div>
        </td>
        <td class="ficheile-value">
            <div class="texte-gris"><?php print $row['Protection_statut']; ?></div>
        </td>
        <td class="ficheile-value">
          <?php if ( ($row['Protection_annee'] ==0) || ($row['Protection_annee'] ==1666)): ?>
            <div class="texte-gris">NC</div>
          <?php else :?>
            <div class="texte-gris"><?php print $row['Protection_annee']; ?></div>
          <?php endif; ?>
        </td>
        <td class="ficheile-value">
            <div class="texte-gris"><?php print $row['Protection_autre']; ?></div>
        </td>
        <td class="ficheile-value">
            <div class="texte-gris"><?php print $row['Protection_commentaire']; ?></div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
