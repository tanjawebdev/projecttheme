<?php
/**
 * Partial: Breaker
 * Felder: text (string), style (line|space|headline)
 */

$text  = get_sub_field('text');
$style = get_sub_field('style') ?: 'space';

switch ($style) {
  case 'line':
    echo '<hr class="my-5" />';
    break;

  case 'headline':
    echo '<h2 class="section-breaker text-center my-5">' . esc_html($text) . '</h2>';
    break;

  case 'space':
  default:
    echo '<div class="my-5"></div>';
    break;
}
