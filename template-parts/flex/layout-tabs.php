<?php
/**
 * Tabs
 * Felder: items (repeater: title, content)
 */
$items = get_sub_field('items') ?: [];
if (empty($items)) return;

$uid = 'tabs-' . wp_unique_id();
?>
<ul class="nav nav-tabs" id="<?php echo esc_attr($uid); ?>" role="tablist">
  <?php foreach ($items as $i => $it): 
    $active = $i === 0 ? 'active' : '';
    $tab_id = $uid . '-tab-' . $i;
  ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link <?php echo $active; ?>"
            id="<?php echo esc_attr($tab_id); ?>"
            data-bs-toggle="tab"
            data-bs-target="#<?php echo esc_attr($tab_id); ?>-pane"
            type="button" role="tab"
            aria-controls="<?php echo esc_attr($tab_id); ?>-pane"
            aria-selected="<?php echo $i===0 ? 'true':'false'; ?>">
      <?php echo esc_html($it['title'] ?? sprintf(__('Tab %d','projecttheme'), $i+1)); ?>
    </button>
  </li>
  <?php endforeach; ?>
</ul>

<div class="tab-content pt-4">
  <?php foreach ($items as $i => $it): 
    $active = $i === 0 ? 'show active' : '';
    $tab_id = $uid . '-tab-' . $i;
  ?>
  <div class="tab-pane fade <?php echo $active; ?>" id="<?php echo esc_attr($tab_id); ?>-pane" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id); ?>">
    <div class="rte"><?php echo wp_kses_post($it['content'] ?? ''); ?></div>
  </div>
  <?php endforeach; ?>
</div>