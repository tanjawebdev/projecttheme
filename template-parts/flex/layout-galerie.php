<?php
/**
 * Galerie (Grid)
 * Felder: images (gallery IDs), show_captions (bool)
 */
$ids           = get_sub_field('images') ?: [];
$show_captions = (bool) get_sub_field('show_captions');
?>
<?php if (!empty($ids)): ?>
<div class="row g-3">
  <?php foreach ($ids as $img_id): 
    $caption = wp_get_attachment_caption($img_id);
  ?>
  <div class="col-6 col-md-4 col-lg-3">
    <figure class="figure w-100">
      <div class="ratio ratio-1x1 mb-2">
        <?php echo wp_get_attachment_image($img_id, 'medium', false, ['class'=>'w-100 h-100 object-fit-cover rounded','loading'=>'lazy','decoding'=>'async']); ?>
      </div>
      <?php if ($show_captions && $caption): ?>
        <figcaption class="figure-caption small"><?php echo esc_html($caption); ?></figcaption>
      <?php endif; ?>
    </figure>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>
