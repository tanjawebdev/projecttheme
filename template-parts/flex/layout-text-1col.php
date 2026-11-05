<?php
$headline = get_sub_field('headline');
$body     = get_sub_field('body');
?>
<div class="row">
  <div class="col-lg-10 mx-auto">
    <?php if ($headline): ?>
      <h2 class="mb-3"><?php echo esc_html($headline); ?></h2>
    <?php endif; ?>
    <?php if ($body): ?>
      <div class="rte">
        <?php echo wp_kses_post($body); ?>
      </div>
    <?php endif; ?>
  </div>
</div>