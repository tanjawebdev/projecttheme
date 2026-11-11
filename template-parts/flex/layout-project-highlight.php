<?php
/**
 * Project Highlight Layout
 * Felder: image (ID), title (text), text (wysiwyg)
 */
$summary  = get_sub_field('summary');
$img_id   = get_sub_field('image');
$title = get_sub_field('title');
$text     = get_sub_field('text');
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
    <?php if ($summary): ?><p class="lead"><?php echo esc_html($summary); ?></p><?php endif; ?>
    <?php if ($title): ?><h2 class="mb-3"><?php echo esc_html($title); ?></h2><?php endif; ?>
    <?php if ($text): ?><div class="rte"><?php echo wp_kses_post($text); ?></div><?php endif; ?>
  </div>
</div>
