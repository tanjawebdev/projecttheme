<?php
$left  = get_sub_field('left');
$right = get_sub_field('right');
?>
<div class="row g-5">
  <div class="col-md-6">
    <?php echo wp_kses_post($left); ?>
  </div>
  <div class="col-md-6">
    <?php echo wp_kses_post($right); ?>
  </div>
</div>