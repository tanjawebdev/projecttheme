<?php
/**
 * Partial: Intro (Hero)
 * ACF-Felder: kicker (text), title (text), text (wysiwyg),
 *             background_image (image id), cta (link array)
 */

$kicker = get_sub_field('kicker');
$title  = get_sub_field('title');
$body   = get_sub_field('text');
$img_id = get_sub_field('background_image');  // Attachment ID
$cta    = get_sub_field('cta');               // ['url','title','target']

// Überschrift-Tag anpassbar (z. B. auf H2 für Unterseiten):
$heading_tag = apply_filters('theme_intro_heading_tag', 'h1');

// CTA aufbereiten
$cta_url    = is_array($cta) && !empty($cta['url'])   ? $cta['url']   : '';
$cta_title  = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target'])? $cta['target']: '_self';
$cta_rel    = $cta_target === '_blank' ? 'noopener noreferrer' : '';

?>
<div class="row align-items-center g-5">
  <div class="col-12 <?php echo $img_id ? 'col-lg-7' : 'col-lg-10'; ?>">
    <?php if ($kicker): ?>
      <p class="intro-kicker text-uppercase small mb-2"><?php echo esc_html($kicker); ?></p>
    <?php endif; ?>

    <?php if ($title): ?>
      <<?php echo tag_escape($heading_tag); ?> class="intro-title mb-3">
        <?php echo esc_html($title); ?>
      </<?php echo tag_escape($heading_tag); ?>>
    <?php endif; ?>

    <?php if ($body): ?>
      <div class="intro-text rte mb-3">
        <?php echo wp_kses_post($body); ?>
      </div>
    <?php endif; ?>

    <?php if ($cta_url): ?>
      <a class="btn btn-primary"
         href="<?php echo esc_url($cta_url); ?>"
         target="<?php echo esc_attr($cta_target); ?>"
         rel="<?php echo esc_attr($cta_rel); ?>">
        <?php echo esc_html($cta_title ?: __('Mehr', 'projecttheme')); ?>
      </a>
    <?php endif; ?>
  </div>

  <?php if ($img_id): ?>
    <div class="col-12 col-lg-5">
      <?php
      // Wenn du einen Helper wie theme_img() hast, nutze den:
      if (function_exists('theme_img')) {
        echo theme_img($img_id, 'large', ['class' => 'intro-image img-fluid rounded-3', 'loading' => 'lazy', 'decoding' => 'async']);
      } else {
        echo wp_get_attachment_image($img_id, 'large', false, [
          'class'    => 'intro-image img-fluid rounded-3',
          'loading'  => 'lazy',
          'decoding' => 'async',
        ]);
      }
      ?>
    </div>
  <?php endif; ?>
</div>