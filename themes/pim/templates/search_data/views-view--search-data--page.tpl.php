<?php
// $Id$
/**
 * @file views-view.tpl.php
 * Main view template
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 * - $admin_links: A rendered list of administrative links
 * - $admin_links_raw: A list of administrative links suitable for theme('links')
 *
 * @ingroup views_templates
 */
 global $base_url;
 print_r($classes_array);
 print_r($css_name);
 $v_search = array();
 $v_search['v-gestion'] = array(
 		'name' => 'Manager',
 		'page' => 'search_manager',
 	);
 $v_search['v-gestion'] = array(
 		'name' => 'Manager',
 		'page' => 'search_manager',
 	);
 $v_search['v-gestion'] = array(
 		'name' => 'Island',
 		'page' => 'search_archipelago_island',
 	);
 $v_search['v-gestion'] = array(
 		'name' => 'Protection',
 		'page' => 'search_protection_tw',
 	);
 $v_search['v-search-taxon'] = array(
 		'name' => 'Observed sp.',
 		'page' => 'search_taxon_present',
 	);
?>
<div class="<?php print $classes; ?>">
  <?php if ($admin_links): ?>
    <div class="views-admin-links views-hide">
      <?php print $admin_links; ?>
    </div>
  <?php endif; ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>
<div class="section">
<div class="tabs">
<ul class="tabs primary clearfix">
<li class="active">
<a class="active" href="<?php print $base_url; ?>/search_data/search_manager">
<span class="tab"><?php print t('Manager'); ?></span>
</a>
</li>
<li>
<a href="<?php print $base_url; ?>/search_data/search_archipelago_island">
<span class="tab"><?php print t('Island'); ?></span>
</a>
</li>
<li>
<a href="<?php print $base_url; ?>/search_data/search_protection_tw">
<span class="tab"><?php print t('Protection'); ?></span>
</a>
</li>
<li>
<a href="<?php print $base_url; ?>/search_data/search_taxon_present">
<span class="tab"><?php print t('Sp. Observées'); ?></span>
</a>
</li>
</ul>
</div>
</div>
  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div> <?php /* class view */ ?>

