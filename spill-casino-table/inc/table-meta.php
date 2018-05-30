<?php 
/**
 * Shortcode Metavalue for Spill Table Pugin
*/

add_action('cmb2_init', 'STZ_table_meta');

function STZ_table_meta()
{
    $prefix = 'STZ_';

    $cmb_info = new_cmb2_box(array(
        'id'           => $prefix . 'table_info_metabox',
        'title'        => esc_html__('Table shortcode'),
        'object_types' => array( 'spilltablezino' ),
        'context'      => 'side'
    ));

    if (isset($_GET['post'])) {
        $cmb_info->add_field(array(
            'name' => '[spilltable id="' . $_GET['post'] . '"]',
            'id'   => 'spill_table',
            'type' => 'title',
        ));
    } else {
        $cmb_info->add_field(array(
            'name' => 'Save the table to get the shortcode',
            'id'   => 'spill_table',
            'type' => 'title',
        ));
    }
}

/**
 * Adding Fields to Spill-Table
 */

add_filter('cmb2_init', 'table_register_meta_boxes');
function table_register_meta_boxes()
{
    $box_options = array(
        'id'           => 'table_tabs_metaboxes',
        'title'        => __('Table Settings', 'cmb2'),
        'object_types' => array( 'spilltablezino' ),
        'show_names'   => true,
    );

    // Setup meta box
    $cmb = new_cmb2_box($box_options);

    // setting tabs
    $tabs_setting = array(
        'config' => $box_options,
        'layout' => 'vertical', // OR vertical
        'tabs'   => array()
    );
           
    $tabs_setting['tabs']['entries'] = array(
        'id'     => 'tab1',
        'title'  => __('Add Entries', 'cmb2'),
        'fields' => array()
    );
    
    $tabs_setting['tabs']['add_columns'] = array(
        'id'     => 'tab2',
        'title'  => __('Set Columns', 'cmb2'),
        'fields' => array()
    );

    $tabs_setting['tabs']['header_settings'] = array(
        'id'     => 'tab3',
        'title'  => __('Header Settings', 'cmb2'),
        'fields' => array()
    );
   
    $tabs_setting['tabs']['table_settings'] = array(
        'id'     => 'tab4',
        'title'  => __('Content Settings', 'cmb2'),
        'fields' => array()
    );

    $tabs_setting['tabs']['show_more_settings'] = array(
        'id'     => 'tab5',
        'title'  => __('Load More Settings', 'cmb2'),
        'fields' => array()
    );

    $tabs_setting['tabs']['button_settings'] = array(
        'id'     => 'tab6',
        'title'  => __('Button Settings', 'cmb2'),
        'fields' => array()
    );

    $tabs_setting['tabs']['other_settings'] = array(
        'id'     => 'tab7',
        'title'  => __('Other Settings', 'cmb2'),
        'fields' => array()
    );


    /* Add Fields in Add entries  */

    $table_prefix = 'table_';

    $tabs_setting['tabs']['entries']['fields'][] = array(
        //'name'    => esc_html__( 'Add Entries'),
        'desc'    => __('Drag Entry from the left column to the right column to attach them to this page.<br />You may rearrange the order of the entries in the right column by dragging and dropping.'),
        'id'      => $table_prefix . 'attached_stz_entries',
        'type'    => 'custom_attached_posts',
        'column'  => true,
        // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
        'options' => array(
            'show_thumbnails' => true, // Show thumbnails on the left
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array(
                'posts_per_page' => 15,
                'post_type'      => 'stz_entries',
            ), // override the get_posts args
        ),
    );
   
   
    $rows_prefix = 'rows_';

    $tabs_setting['tabs']['add_columns']['fields'][] = array(
        'id'   => $rows_prefix . 'group',
        'title'   => 'Columns',
        'type'    => 'group',
        'options' => array(
            'group_title'   => __( 'Table Column {#}' ),
            'add_button'    => __( 'Add' ),
            'remove_button' => __( 'Remove' ),
            'sortable'      => false
        ),
        'fields'  => array(
            array(
                'name' => __( 'Column title' ),
                'id'   => 'title',
                'type' => 'text'
            ),
            array(
                'name'      => __( 'Hide Header' ),
                'id'        => 'hide',
                'type'      => 'checkbox',
                'desc'   => 'check to hide form table',                
            ),
            array(
                'name'      => __( 'Items' ),
                'id'        => 'type',
                'type'      => 'select',
                'default'   => 'none',
                'options'   => stz_columns_list()
            ),
            array(
                'name' => esc_html__('Content font', 'cmb2'),
                'id'   => 'font_family',
                'type'             => 'select',
                'show_option_none' => true,
                //'default'        => 'None',
                'options'          => array(
                    'Roboto'    => __('Roboto', 'cmb2'),
                    'Work+Sans' => __('Work Sans', 'cmb2'),
                    'PT+Sans'   => __('PT Sans', 'cmb2'),
                    'Lato'      => __('Lato', 'cmb2'),
                    'Open+Sans' => __('Open Sans', 'cmb2'),
                    'Oswald'    => __('Oswald', 'cmb2'),
                    'Montserrat'=> __('Montserrat', 'cmb2'),
                )
            ),
            array(
                'name' => esc_html__('Font size', 'cmb2'),
                'id'   => 'font_size',
                //'desc' => __('Enter PX value', 'spill-table'),
                'after_field' => 'px',
                'type' => 'text_small'
            ),
            array(
                'name' => esc_html__('Color', 'cmb2'),
                //'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
                'id'   => 'text_color',
                'type' => 'colorpicker',
            )
        )
    );

    /* Add fields Table Settings */

    $header_prefix = 'header_';

    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Header text color', 'cmb2'),
        //'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
        'id'   => $header_prefix . 'text_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Content font', 'cmb2'),
        'id'   => $header_prefix . 'font_family',
        'type'             => 'select',
        'show_option_none' => true,
        //'default'        => 'None',
        'options'          => array(
            'Roboto'    => __('Roboto', 'cmb2'),
            'Work+Sans' => __('Work Sans', 'cmb2'),
            'PT+Sans'   => __('PT Sans', 'cmb2'),
            'Lato'      => __('Lato', 'cmb2'),
            'Open+Sans' => __('Open Sans', 'cmb2'),
            'Oswald'    => __('Oswald', 'cmb2'),
            'Montserrat'=> __('Montserrat', 'cmb2'),
        ),
    );

    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Header font style', 'cmb2'),
        //'desc' => esc_html__( 'Select font style', 'cmb2' ),
        'id'   => $header_prefix . 'font_style',
        'type'    => 'radio_inline',
        'options' => array(
            'normal' => __('Normal', 'cmb2'),
            'bold'   => '<strong>'.__('Bold', 'cmb2').'</strong>',
            'italic'     => '<i>'. __('Italic', 'cmb2'). ' </i>',
        ),
        //'default' => 'standard',
    );
    
    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Header font size (px)', 'cmb2'),
        'id'   => $header_prefix . 'font_size',
        'type' => 'text_small',
    );

    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Header Background color', 'cmb2'),
        'id'   => $header_prefix . 'bg_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Header Background Hover color', 'cmb2'),
        'id'   => $header_prefix . 'bg_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['header_settings']['fields'][] = array(
        'name' => esc_html__('Hide Header', 'cmb2'),
        'desc' => esc_html__('hide the header from the table', 'cmb2'),
        'id'   => $header_prefix . 'hide',
        'type' => 'checkbox',
    );
    
    
    /* Add fields Table Content Settings */

    $content_prefix = 'content_';
    
    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Content text color', 'cmb2'),
        //'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
        'id'   => $content_prefix . 'text_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Content font', 'cmb2'),
        'id'   => $content_prefix . 'font_family',
        'type'             => 'select',
        'show_option_none' => true,
        //'default'        => 'None',
        'options'          => array(
            'Roboto'    => __('Roboto', 'cmb2'),
            'Work+Sans' => __('Work Sans', 'cmb2'),
            'PT+Sans'   => __('PT Sans', 'cmb2'),
            'Lato'      => __('Lato', 'cmb2'),
            'Open+Sans' => __('Open Sans', 'cmb2'),
            'Oswald'    => __('Oswald', 'cmb2'),
            'Montserrat'=> __('Montserrat', 'cmb2'),
        ),
    );
    

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Content font style', 'cmb2'),
        //'desc' => esc_html__( 'Select font style', 'cmb2' ),
        'id'   => $content_prefix . 'font_style',
        'type'    => 'radio_inline',
        'options' => array(
            'normal' => __('Normal', 'cmb2'),
            'bold'   => '<strong>'.__('Bold', 'cmb2').'</strong>',
            'italic'     => '<i>'. __('Italic', 'cmb2'). ' </i>',
        ),
        //'default' => 'standard',
    );

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Content Font size (px)', 'cmb2'),
        'id'   => $content_prefix . 'font_size',
        'type' => 'text_small',
    );

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Row Background color', 'cmb2'),
        'id'   => $content_prefix . 'row_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Row background color on Hover', 'cmb2'),
        'id'   => $content_prefix . 'row_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Show Row Shadow', 'cmb2'),
        'id'   => $content_prefix . 'show_row_shadow',
        'type' => 'checkbox',
    );

    $tabs_setting['tabs']['table_settings']['fields'][] = array(
        'name' => esc_html__('Row Shadow', 'cmb2'),
        'id'   => $content_prefix . 'row_shadow_color',
        'type' => 'colorpicker',
    );

    
    /* Add Button Settings */
    $btn_prefix = 'btn_';

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Primary Button Text Color', 'cmb2'),
        'id'   => $btn_prefix . 'primary_txt_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Primary Button Hover Text Color', 'cmb2'),
        'id'   => $btn_prefix . 'primary_hover_txt_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Primary Button Color', 'cmb2'),
        'id'   => $btn_prefix . 'primary_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Primary Button Hover Color', 'cmb2'),
        'id'   => $btn_prefix . 'primary_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Primary button font size', 'cmb2'),
        'id'   => $btn_prefix . 'primary_font',
        'type' => 'text_small',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Secondary Button Text Color', 'cmb2'),
        'id'   => $btn_prefix . 'secondary_txt_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Secondary Button Hover Text Color', 'cmb2'),
        'id'   => $btn_prefix . 'secondary_hover_txt_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Secondary Button Color', 'cmb2'),
        'id'   => $btn_prefix . 'secondary_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Secondary Button Hover Color', 'cmb2'),
        'id'   => $btn_prefix . 'secondary_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('Secondary button font size', 'cmb2'),
        'id'   => $btn_prefix . 'secondary_font',
        'type' => 'text_small',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('View More Button Text Color', 'cmb2'),
        'id'   => $btn_prefix . 'view_more_txt_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('View More Button Hover Text Color', 'cmb2'),
        'id'   => $btn_prefix . 'view_more_hover_txt_color',
        'type' => 'colorpicker',
    );
    
    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('View More Button Color', 'cmb2'),
        'id'   => $btn_prefix . 'view_more_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('View More Button Hover Color', 'cmb2'),
        'id'   => $btn_prefix . 'view_more_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['button_settings']['fields'][] = array(
        'name' => esc_html__('View More button font size', 'cmb2'),
        'id'   => $btn_prefix . 'view_more_font',
        'type' => 'text_small',
    );

    /* Add Show More Settings */

    $content_prefix = 'sm_';

    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Enter count of visible rows', 'cmb2'),
        'desc' => esc_html__('Leave it empty to show all rows', 'cmb2'),
        'id'   => $content_prefix . 'rows',
        'type' => 'text_medium',
    );
    
    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Show more text', 'cmb2'),
        'id'   => $content_prefix . 'more_text',
        'type' => 'text_medium',
    );

    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Show less text', 'cmb2'),
        'id'   => $content_prefix . 'less_text',
        'type' => 'text_medium',
    );
    
    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Background Color', 'cmb2'),
        'id'   => $content_prefix . 'bg_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Background hover color', 'cmb2'),
        'id'   => $content_prefix . 'bg_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Button text color', 'cmb2'),
        'id'   => $content_prefix . 'button_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Button text hover color', 'cmb2'),
        'id'   => $content_prefix . 'button_hover_color',
        'type' => 'colorpicker',
    );

    $tabs_setting['tabs']['show_more_settings']['fields'][] = array(
        'name' => esc_html__('Button font size', 'cmb2'),
        'id'   => $content_prefix . 'button_font',
        'type' => 'text_small',
    );

    

    /* Add Other Settings */

    $other_settings_prefix = 'os_';

    $tabs_setting['tabs']['other_settings']['fields'][] = array(
        'name'  => esc_html__('Show Count or Image', 'cmb2'),
        'id'   => $header_prefix . 'counter_or_image',
        'desc' => 'Display image or Number for the rows',
        'type' => 'select',
        'show_option_none' => true,
        //'default'          => 'None',
        'options'          => array(
            'number' => __('Number', 'cmb2'),
            'image'  => __('Image', 'cmb2'),
        ),
    );

    $tabs_setting['tabs']['other_settings']['fields'][] = array(
        'name' => esc_html__('Ribbon Image', 'cmb2'),
        'id'   => $other_settings_prefix . 'ribbon_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add Ribbon'
            // Change upload button text. Default: "Add or Upload File"
        ),
        'query_args' => array(
            //'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
        ),
        'preview_size' => 'thumbnail',
    );

    $tabs_setting['tabs']['other_settings']['fields'][] = array(
        'name' => esc_html__('Border Color', 'cmb2'),
        'id'   => $other_settings_prefix . 'border_color',
        'type' => 'colorpicker',
    );
    
    $tabs_setting['tabs']['other_settings']['fields'][] = array(
        'name' => esc_html__('Border width (px)', 'cmb2'),
        'id'   => $other_settings_prefix . 'border_width',
        'desc' => 'Enter the value without PX',
        'type' => 'text_small',
    );
    $tabs_setting['tabs']['other_settings']['fields'][] = array(
        'name' => esc_html__('Gap between rows (px)', 'cmb2'),
        'id'   => $other_settings_prefix . 'gap_rows',
        'desc' => 'Enter the value without PX',
        'type' => 'text_small',
    );

    // $tabs_setting['tabs']['other_settings']['fields'][] = array(
    //     'name' => esc_html__('Show Table Shadow', 'cmb2'),
    //     'id'   => $content_prefix . 'show_table_shadow',
    //     'type' => 'checkbox',
    // );

    // $tabs_setting['tabs']['other_settings']['fields'][] = array(
    //     'name' => esc_html__('Table Shadow', 'cmb2'),
    //     'id'   => $content_prefix . 'table_shadow_color',
    //     'type' => 'colorpicker',
    // );

    // set tabs
    $cmb->add_field(array(
        'id'   => '__tabs',
        'type' => 'tabs',
        'tabs' => $tabs_setting
    ));
}

add_action('admin_enqueue_scripts', 'jpry_enqueue_scripts');
/**
 * Enqueue our script when needed.
 */
function jpry_enqueue_scripts()
{
    $screen = get_current_screen();
    if (! isset($screen->post_type) || 'spilltablezino' !== $screen->post_type) {
        return;
    }
    $script_name = 'assets/cmb2_spillzino_custom.js';
    $url         = trailingslashit(STZ_DIR_URL);
    wp_enqueue_script('spilltable_custom_jquery', $url . $script_name, array( 'jquery' ), '1.0.0');
}
