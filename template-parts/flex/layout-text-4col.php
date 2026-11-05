<?php
$col1 = get_sub_field('col1');
$col2 = get_sub_field('col2');
$col3 = get_sub_field('col3');
$col4 = get_sub_field('col4');
?>
<div class="row g-4">
  <div class="col-md-3"><?php echo wp_kses_post($col1); ?></div>
  <div class="col-md-3"><?php echo wp_kses_post($col2); ?></div>
  <div class="col-md-3"><?php echo wp_kses_post($col3); ?></div>
  <div class="col-md-3"><?php echo wp_kses_post($col4); ?></div>
</div>