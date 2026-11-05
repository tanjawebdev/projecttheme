<?php
$headline = get_sub_field('headline');
$text     = get_sub_field('text');
$image_id = get_sub_field('image');
?>
<div class="row align-items-center g-5">
  <div class="col-md-6">
    <?php if ($headline): ?><h2><?php echo esc_html($headline); ?></h2><?php endif; ?>
    <?php if ($text): ?><div class="rte"><?php echo wp_kses_post($text); ?></div><?php endif; ?>
  </div>
  <div class="col-md-6">
    <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'img-fluid rounded']); ?>
  </div>
</div>