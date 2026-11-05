<?php
/**
 * Bildboxen (Cards Grid)
 * Felder: boxes (repeater: image(id), title, text, link), columns (2|3|4)
 */
$boxes   = get_sub_field('boxes') ?: [];
$columns = (int) (get_sub_field('columns') ?: 3);
$col_md  = 12 / max(1, $columns);
?>
<?php if (!empty($boxes)): ?>
<div class="row g-4">
  <?php foreach ($boxes as $box): 
    $img = $box['image'] ?? 0;
    $ttl = $box['title'] ?? '';
    $txt = $box['text'] ?? '';
    $lnk = $box['link'] ?? [];
    $url = is_array($lnk) ? ($lnk['url'] ?? '') : '';
    $label = is_array($lnk) ? ($lnk['title'] ?? '') : '';
    $target = is_array($lnk) ? ($lnk['target'] ?? '_self') : '_self';
  ?>
  <div class="col-12 col-md-<?php echo esc_attr($col_md); ?>">
    <div class="card h-100">
      <?php if ($img) : ?>
        <div class="ratio ratio-16x9">
          <?php echo wp_get_attachment_image($img, 'medium_large', false, ['class'=>'card-img-top object-fit-cover']); ?>
        </div>
      <?php endif; ?>
      <div class="card-body d-flex flex-column">
        <?php if ($ttl): ?><h3 class="h5 card-title"><?php echo esc_html($ttl); ?></h3><?php endif; ?>
        <?php if ($txt): ?><p class="card-text mb-3"><?php echo esc_html($txt); ?></p><?php endif; ?>
        <?php if ($url): ?>
          <div class="mt-auto">
            <a class="btn btn-outline-primary" href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
              <?php echo esc_html($label ?: __('Mehr','projecttheme')); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>