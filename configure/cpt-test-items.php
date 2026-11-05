<?php
/**
 * Custom Post Type: Test Items
 */

add_action( 'init', 'projecttheme_register_test_items' );

function projecttheme_register_test_items() {

    $labels = array(
        'name'                  => _x( 'Test Items', 'Post type general name', 'projecttheme' ),
        'singular_name'         => _x( 'Item', 'Post type singular name', 'projecttheme' ),
        'menu_name'             => _x( 'Test Items', 'Admin Menu text', 'projecttheme' ),
        'name_admin_bar'        => _x( 'Item', 'Add New on Toolbar', 'projecttheme' ),
        'add_new'               => __( 'Add New', 'projecttheme' ),
        'add_new_item'          => __( 'Add New Item', 'projecttheme' ),
        'new_item'              => __( 'New Item', 'projecttheme' ),
        'edit_item'             => __( 'Edit Item', 'projecttheme' ),
        'view_item'             => __( 'View Item', 'projecttheme' ),
        'all_items'             => __( 'All Test Items', 'projecttheme' ),
        'search_items'          => __( 'Search Items', 'projecttheme' ),
        'not_found'             => __( 'No items found.', 'projecttheme' ),
        'not_found_in_trash'    => __( 'No items found in Trash.', 'projecttheme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,                      // sichtbar im Frontend
        'show_in_menu'       => true,                      // eigener Menüpunkt im Backend
        'menu_position'      => 20,                        // Position in der Admin-Sidebar
        'menu_icon'          => 'dashicons-screenoptions', // WP Dashicons Icon
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'items' ), // URL-Slug: /items/
        'show_in_rest'       => true,                      // wichtig für Gutenberg + REST API
    );

    register_post_type( 'test_item', $args );
}