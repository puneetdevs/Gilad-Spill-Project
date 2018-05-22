<?php
/*
Plugin Name: Spill Casino Table
Plugin URI: https://spill.com/
Description: Create design for your casino table
Version: 1.0.0
Author: Elazar
License: GPLv2 or later
*/

define( 'STZ_DIR', dirname( __FILE__ ) );
define( 'STZ_DIR_URL', plugin_dir_url( __FILE__ ) );


if ( !class_exists( 'CMB2_Bootstrap_230', false ) ) {

// Include vendor CMB2 plugin for custom fields

    require_once( STZ_DIR . '/vendor/CMB2/init.php');
    if ( ! class_exists( 'OWN_Field_Slider', false ) ) {
        require_once( STZ_DIR . '/vendor/cmb2-field-slider/cmb2_field_slider.php');
    }
    require_once( STZ_DIR . '/vendor/cmb2-tabs/plugin.php');
    require_once( STZ_DIR . '/vendor/cmb2-switch-button/cmb2-switch-button.php');

}

require_once( STZ_DIR . '/inc/post-type.php' );
require_once( STZ_DIR . '/inc/taxonomies.php' );
require_once( STZ_DIR . '/inc/meta-settings.php' );
require_once( STZ_DIR . '/inc/entry-meta.php' );
require_once( STZ_DIR . '/inc/table-meta.php' );
require_once( STZ_DIR . '/inc/add-entries-custom-field.php' );
require_once( STZ_DIR . '/inc/short-code.php' );
require_once( STZ_DIR . '/inc/spill-ajax.php' );

add_action('wp_enqueue_scripts', 'add_spilltable_styles');

function add_spilltable_styles() {
    wp_enqueue_style('spill-table-data', STZ_DIR_URL . 'inc/css/spill-table.css', array(), '1.0.0');
}

