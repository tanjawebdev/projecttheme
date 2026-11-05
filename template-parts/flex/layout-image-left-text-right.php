<?php
/**
 * Bild links – Text rechts
 * Felder: image (ID), headline (text), text (wysiwyg)
 */
$img_id   = get_sub_field('image');
$headline = get_sub_field('headline');
$body     = get_sub_field('text');
?>
<div class="row align-items-center g-5">
  <div class="col-md-6">
    <?php
    if ($img_id) {
      echo wp_get_attachment_image($img_id, 'large', false, [
        'class'    => 'img-fluid rounded',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
    }
    ?>
  </div>
  <div class="col-md-6">
    <?php if ($headline): ?><h2 class="mb-3"><?php echo esc_html($headline); ?></h2><?php endif; ?>
    <?php if ($body): ?><div class="rte"><?php echo wp_kses_post($body); ?></div><?php endif; ?>
  </div>
</div>
