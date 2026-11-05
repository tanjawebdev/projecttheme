<?php
/**
 * Interaktiver Image Slider (Bootstrap Carousel)
 * Felder: images (gallery IDs), autoplay (bool), interval (ms)
 */
$ids      = get_sub_field('images') ?: [];
$autoplay = (bool) get_sub_field('autoplay');
$interval = max(5000, (int) (get_sub_field('interval') ?: 7000));

if (!empty($ids)) :
  $carousel_id = 'carousel-' . wp_unique_id();
?>
<div id="<?php echo esc_attr($carousel_id); ?>"
     class="carousel slide projecttheme-image-slider"
     <?php if ($autoplay) : ?>
       data-bs-ride="carousel"
       data-bs-interval="<?php echo esc_attr($interval); ?>"
     <?php endif; ?>>

  <div class="carousel-indicators">
    <?php foreach ($ids as $i => $img_id): ?>
      <button type="button"
              data-bs-target="#<?php echo esc_attr($carousel_id); ?>"
              data-bs-slide-to="<?php echo esc_attr($i); ?>"
              <?php if ($i === 0) echo 'class="active" aria-current="true"'; ?>
              aria-label="<?php echo esc_attr(sprintf(__('Slide %d','projecttheme'), $i+1)); ?>"></button>
    <?php endforeach; ?>
  </div>

  <div class="carousel-inner rounded">
    <?php foreach ($ids as $i => $img_id): ?>
      <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
        <?php
        echo wp_get_attachment_image(
          $img_id,
          'extra-large',
          false,
          array(
            'class'    => 'd-block w-100',
            'loading'  => $i === 0 ? 'eager' : 'lazy',
            'decoding' => 'async',
          )
        );
        ?>
      </div>
    <?php endforeach; ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo esc_attr($carousel_id); ?>" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden"><?php _e('Previous'); ?></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#<?php echo esc_attr($carousel_id); ?>" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden"><?php _e('Next'); ?></span>
  </button>
</div>
<?php endif; ?>