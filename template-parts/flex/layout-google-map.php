<?php
/**
 * Google Map (ohne API – via Embed)
 * Felder: location (ACF google_map array), zoom (1..21)
 */
$loc  = get_sub_field('location'); // ['address','lat','lng']
$zoom = (int) (get_sub_field('zoom') ?: 14);

if (is_array($loc) && isset($loc['lat'], $loc['lng'])) :
  $lat = (float) $loc['lat'];
  $lng = (float) $loc['lng'];
  // Google Maps Embed (ohne Key) – zeigt Standardkarte
  $q   = rawurlencode($lat . ',' . $lng);
  $src = "https://www.google.com/maps?q={$q}&z={$zoom}&output=embed";
?>
<div class="ratio ratio-16x9">
  <iframe
    src="<?php echo esc_url($src); ?>"
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    allowfullscreen
    style="border:0"></iframe>
</div>
<?php endif; ?>
