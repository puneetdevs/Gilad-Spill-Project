<?php
/**
 * Add taxonomies and taxonomy metadata
 */
function STZ_add_taxonomies() {
    register_taxonomy( "stz_payment_methods",
        array( "stz_entries" ),
        array(
            'hierarchical' => true,
            'label'        => 'Payment methods',
            'public'       => false,
            'show_ui'      => true,
            'query_var'    => true
        )
    );

    register_taxonomy( "stz_software",
        array( "stz_entries" ),
        array(
            'hierarchical' => true,
            'label'        => 'Software',
            'public'       => false,
            'show_ui'      => true,
            'query_var'    => true
        )
    );

    register_taxonomy( "stz_devices",
        array( "stz_entries" ),
        array(
            'hierarchical' => true,
            'label'        => 'Devices',
            'public'       => false,
            'show_ui'      => true,
            'query_var'    => true
        )
    );

    register_taxonomy( "stz_icons",
        array( "stz_entries" ),
        array(
            'hierarchical' => true,
            'label'        => 'Icons',
            'public'       => false,
            'show_ui'      => true,
            'query_var'    => true
        )
    );
}

add_action('init', 'STZ_add_taxonomies');

add_action( 'cmb2_init', 'STZ_taxonomies_meta' );

function STZ_taxonomies_meta() {
    $prefix = 'STZ_';

    $cmb_entry = new_cmb2_box( array(
        'id'           => $prefix . 'metabox_tax',
        'title'        => esc_html__( 'Details' ),
        'object_types'     => array( 'term' ),
        'taxonomies' => array( 'stz_software', 'stz_payment_methods', 'stz_devices', 'stz_icons' ),
    ) );

    $cmb_entry->add_field( array(
        'name'   => esc_html__( 'Logo' ),
        'id'     => $prefix . 'logo',
        'type'   => 'file',
        'column' => true,
    ) );
}