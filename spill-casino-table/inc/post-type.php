<?php
// Creates Table Entries Custom Post Type
function STZ_add_post_type() {
    $labels = array(
        'name'               => __('Spill Table'),
        'singular_name'      => __('Table'),
        'add_new'            => __('Add table'),
        'add_new_item'       => __('Add new table'),
        'not_found'          => __('No entries found.'),
    );

    // Create an array for the $args
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'menu_icon'          => 'dashicons-id-alt',
        'hierarchical'       => false,
        'menu_position'      => null,
        'has_archive'        => true,
        'supports'           => array( 'title' )
    );
    register_post_type( 'spilltablezino', $args );

    // register post_types
    $labels = array(
        'name'               => __('Spill Entries'),
        'singular_name'      => __('Entry'),
        'add_new'            => __('Add entry'),
        'add_new_item'       => __('Add new entry'),
        'not_found'          => __('No entries found.'),
    );

    // Create an array for the $args
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true, // show only in developer mode. Change to false for productions
        'query_var'          => true,
        'rewrite'            => true,
        'menu_icon'          => 'dashicons-welcome-widgets-menus',
        'hierarchical'       => false,
        'menu_position'      => null,
        'has_archive'        => true,
        'supports'           => array( 'title' )
    );

    register_post_type( 'stz_entries', $args );
}
add_action( 'init', 'STZ_add_post_type' );