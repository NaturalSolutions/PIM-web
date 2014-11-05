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
  $display_pager = 1 ;
 	$v_search = array();
	global $base_url;
	switch ($css_name) {
    case "v-search-manager":
    case "v-search-taxon-unfound":
    case "v-search-protection":
    case "v-search-islands-archipelagos":
    case "v-search-inventory":
        if (($classes_array[4] == "view-display-id-page_1") || ($classes_array[4] == "view-display-id-page_2")) {
         $v_search['v-search-islands-archipelagos'] = array(
            'name' => 'Island',
            'page' => 'search_island_archipelago',
          );
         $v_search['v-search-manager'] = array(
            'name' => 'Manager',
            'page' => 'search_manager',
          );
         $v_search['v-search-inventory'] = array(
            'name' => 'Taxon',
            'page' => 'search_taxon',
          );
         $v_search['v-search-protection'] = array(
            'name' => 'Protection',
            'page' => 'search_protection',
          );
          if ( empty($rows) ) {
            $display_pager = 0;
          }
				}
			break;
    }
	if (i18n_get_lang() == "fr") {
		$lang = "";
	} else {
		$lang = i18n_get_lang()."/";
	}
 
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


<?php if ($v_search): ?>
<h1> 
    	<span class="page-titre-bleu">
        <?php print t('Explore').' :' ?>
    </span>
    	<span class="page-soustitre-bleu">
        <?php print t('PIM database') ?>
    </span>
</h1>
	<div class="section">
		<div class="tabs">
			<ul class="tabs primary clearfix" style="padding :0;">
				<?php foreach ($v_search as $viewName => $val): ?>
					<li <?php if ( $viewName == $css_name) print 'class="active"'; ?> >
						<a <?php if ( $viewName == $css_name) print 'class="active"'; ?> href="<?php print $base_url.'/'.$lang; ?>search_data/<?php print $val['page']; ?>">
							<span class="tab"><?php print t($val['name']); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>
  

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>
  
<?php if ($v_search): ?>
  <?php if ( ($display_pager == 1 ) && ($view->total_rows>0) ): ?>
    <div class="view-result-count"> <?php print t('Result number : ') . $view->total_rows; ?></div>
   <?php endif; ?>
<?php endif; ?>
  
  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>
  
  <?php if ( ($pager) && ($display_pager ==1 )): ?>
    <div class="pager-pim"><?php print $pager; ?></div>
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

  
 <?php if ( ($pager) && ($display_pager ==1 )): ?>
    <div class="pager-pim"><?php print $pager; ?></div>
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

