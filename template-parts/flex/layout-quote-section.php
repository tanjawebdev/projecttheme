<?php
/**
 * Quote Section Layout
 * Felder: heading (text), subheading (text), quotes (repeater)
 */
$heading    = get_sub_field('heading');
$subheading = get_sub_field('subheading');
?>
<?php if ($heading || $subheading): ?>
  <header class="quote-section-header mb-4">
    <?php if ($heading): ?><h2 class="mb-2"><?php echo esc_html($heading); ?></h2><?php endif; ?>
    <?php if ($subheading): ?><p class="mb-0"><?php echo esc_html($subheading); ?></p><?php endif; ?>
  </header>
<?php endif; ?>

<?php if (have_rows('quotes')): ?>
  <div class="row g-4">
    <?php while (have_rows('quotes')) : the_row();
      $quote       = get_sub_field('quote');
      $image_id    = get_sub_field('image');
      $title       = get_sub_field('title');
      $description = get_sub_field('description');
    ?>
      <div class="col-12 col-md-6 col-lg-4">
        <article class="quote-card h-100">
          <?php if ($quote): ?><blockquote><?php echo esc_html($quote); ?></blockquote><?php endif; ?>
          <?php if ($image_id || $title || $description): ?>
            <div class="quote-card-author">
              <?php if ($image_id): ?>
                <?php echo wp_get_attachment_image($image_id, 'thumbnail', false, [
                  'class' => 'quote-card-avatar',
                  'loading' => 'lazy',
                  'decoding' => 'async',
                ]); ?>
              <?php endif; ?>
              <?php if ($title || $description): ?>
                <div>
                  <?php if ($title): ?><cite><?php echo esc_html($title); ?></cite><?php endif; ?>
                  <?php if ($description): ?><span><?php echo esc_html($description); ?></span><?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </article>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
