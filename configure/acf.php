<?php

// ACF functions here

// ACF helper functions
function section_open(array $opts = []) {
    $name      = $opts['name'] ?? '';
    $id        = $opts['id'] ?? '';
    $bg        = $opts['bg'] ?? 'none';
    $container = $opts['container'] ?? 'container-lg';
    $py        = $opts['padding_y'] ?? 'py-5';
    $show      = $opts['show_on'] ?? 'everywhere'; // everywhere | only-mobile | only-desktop

    // Sichtbarkeits-Klassen mappen (Bootstrap)
    $visClass = '';
    if ($show === 'only-mobile')  $visClass = 'd-lg-none';
    if ($show === 'only-desktop') $visClass = 'd-none d-lg-block';

    $classesSection = trim("section section--bg-{$bg} {$py} {$visClass}");
    echo '<section'.($id ? ' id="'.esc_attr($id).'"' : '').' class="'.$name.' '.esc_attr($classesSection).'">';
    
    if ($container !== 'none') {
        echo '<div class="'.esc_attr($container).'">';
    }
}

function section_close(array $opts = []) {
    $container = $opts['container'] ?? 'container-lg';
    if ($container !== 'none') {
        echo '</div>';
    }
    echo '</section>';
}



// Enable ACF Local JSON
add_filter('acf/settings/save_json', function() {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
});