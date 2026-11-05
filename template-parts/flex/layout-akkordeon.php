<?php
/**
 * Akkordeon (Bootstrap Accordion)
 * Felder: items (repeater: title, body), first_open (bool)
 */
$items      = get_sub_field('items') ?: [];
$first_open = (bool) get_sub_field('first_open');
if (empty($items)) return;

$acc_id = 'acc-' . wp_unique_id();
?>
<div class="accordion" id="<?php echo esc_attr($acc_id); ?>">
  <?php foreach ($items as $i => $it): 
    $heading_id = $acc_id . '-h-' . $i;
    $collapse_id = $acc_id . '-c-' . $i;
    $is_open = $first_open && $i === 0;
  ?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
      <button class="accordion-button <?php echo $is_open ? '' : 'collapsed'; ?>"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
              aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
              aria-controls="<?php echo esc_attr($collapse_id); ?>">
        <?php echo esc_html($it['title'] ?? sprintf(__('Eintrag %d','projecttheme'), $i+1)); ?>
      </button>
    </h2>
    <div id="<?php echo esc_attr($collapse_id); ?>"
         class="accordion-collapse collapse <?php echo $is_open ? 'show' : ''; ?>"
         aria-labelledby="<?php echo esc_attr($heading_id); ?>"
         data-bs-parent="#<?php echo esc_attr($acc_id); ?>">
      <div class="accordion-body">
        <div class="rte"><?php echo wp_kses_post($it['body'] ?? ''); ?></div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>