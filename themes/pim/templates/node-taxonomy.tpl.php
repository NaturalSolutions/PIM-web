<div id="node-<?php echo $node->nid; ?>"
        class="<?php if($sticky) echo ' sticky'; ?><?php if(!$status) echo ' node-unpublished'; ?>">
  <div class="taxonomy-node">
      <div class="node-body">
      	<?php print $term; ?>
      	<?php echo $title ?>
                                  
      </div>                
  </div>
</div>
