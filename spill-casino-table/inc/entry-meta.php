<?php
add_action( 'cmb2_init', 'prefix_register_meta_boxes' );
/**
 * Add a metabox 
 */
function prefix_register_meta_boxes() {
    $box_options = array(
        'id'           => 'content_tabs_metaboxes',
        'title'        => __( 'Entry Content' ),
        'object_types' => array( 'stz_entries' ),
        'show_names'   => true,
    );

    // Setup meta box
    $cmb = new_cmb2_box( $box_options );

    // setting tabs
    $tabs_setting           = array(
        'config' => $box_options,
        'tabs'   => array()
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab1',
        'title'  => __( 'Images' ),
        'fields' => array(
            array(
                'name'    => __( 'Logo image' ),
                'description' => 'Upload logo with more than 100px width',
                'id'      => 'logo',
                'type'    => 'file',
	            'column'  => true
            ),           
	        array(
		        'name'    => __( 'Screenshot' ),
		        'id'      => 'image',
		        'type'    => 'file'
            )           
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab2',
        'title'  => __( 'List' ),
        'fields' => array(
            array(
                'id'      => 'list',
                'type'    => 'group',
                'options' => array(
                    'group_title'   => __( 'List group {#}' ),
                    'add_button'    => __( 'Add group' ),
                    'remove_button' => __( 'Remove group' ),
                    'sortable'      => false
                ),
                'fields'  => array(
                    array(
                        'name' => __( 'Group title' ),
                        'id'   => 'title',
                        'type' => 'text'
                    ),
                    array(
                        'name'       => __( 'Items' ),
                        'id'         => 'items',
                        'type'       => 'text',
                        'repeatable' => true
                    ),
                )
            )
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab3',
        'title'  => __( 'Rating' ),
        'fields' => array(
            array(
                'name'    => __( 'Display Type' ),
                'id'      => 'show_rating_in',
                'type'    => 'radio',
                'default' => 'percents',
                'desc'   => 'Format to show the ratings',
                'options' => array(
                    'integer' => 'Number',
                    'stars' => 'Stars',
                    'percents' => 'Percantage',
                ),
            ),
            array(
                'name'    => __( 'Rating integer' ),
                'id'      => 'rating_integer',
                'type'    => 'radio',
                'desc'  => 'Number will be show, If display type is Number',
                'options' => array(
                    '0' => 'none',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                )
            ),
            array(
                'name'        => __( 'Rating float' ),
                'id'          => 'rating_float',
                'type'        => 'own_slider',
                'min'         => '0',
                'max'         => '5',
                'step'        => '0.1',
                'default'     => '0', // start value
                'value_label' => 'Stars:',
                'desc'  => 'Stars will show if the, display type is Stars',
            ),
            array(
                'name'        => __( 'Rating Percantage' ),
                'id'          => 'rating_percents',
                'type'        => 'own_slider',
                'min'         => '0',
                'max'         => '100',
                'step'        => '1',
                'default'     => '0', // start value.
                'desc'  => 'Progress bar will be show, If display type is Percantage',
                'value_label' => 'Percents:',
            ),
            array(
                'id'      => 'bool_rating',
                'name' => __( 'Enable User Rating' ),
                'type'    => 'checkbox',
            ),
            array(
                'id'      => 'rating_readonly',
                'name'        => 'Ratings By User',
                'type'        => 'text',
                // 'save_field'  => false,
                // 'attributes'  => array(
                //     'readonly' => 'readonly',
                //     'disabled' => 'disabled',
                // )
            ),
            array(
                'id'      => 'total_rating',
                'name'        => 'No. of votes',
                'type'        => 'text',
                // 'save_field'  => false,
                // 'attributes'  => array(
                //     'readonly' => 'readonly',
                //     'disabled' => 'disabled',
                // )
            ),
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab4',
        'title'  => __( 'Text' ),
        'fields' => array(
            array(
                'id'      => 'text',
                'type'    => 'group',
                'options' => array(
                    'group_title'   => __( 'Text group {#}' ),
                    'add_button'    => __( 'Add group' ),
                    'remove_button' => __( 'Remove group' ),
                    'sortable'      => false
                ),
                'fields'  => array(
                    array(
                        'name' => __( 'Group title' ),
                        'id'   => 'title',
                        'type' => 'text'
                    ),
                    array(
                        'name' => __( 'Text content' ),
                        'id'   => 'text_content',
                        'type' => 'text'
                    ),
                    array(
                        'name' => __( 'Text highlight' ),
                        'id'   => 'text_highlight',
                        'type' => 'text'
                    ),
                )
            )
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab9',
        'title'  => __( 'Bonuses' ),
        'fields' => array(
            array(
                'id'      => 'bonus',
                'type'    => 'group',
                'options' => array(
                    'group_title'   => __( 'Bonus group {#}' ),
                    'add_button'    => __( 'Add group' ),
                    'remove_button' => __( 'Remove group' ),
                    'sortable'      => false
                ),
                'fields'  => array(
                    array(
                        'name' => __( 'Bonus type' ),
                        'id'   => 'type',
                        'type' => 'select',
                        'default' => 'none',
                        'options' => array_merge(array('none' => 'None'), stz_get_bonus_list())
                    ),
                    array(
                        'name' => __( 'Bonus amount' ),
                        'id'   => 'amount',
                        'type' => 'text'
                    ),
                )
            )
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab5',
        'title'  => __( 'Yes / No' ),
        'fields' => array(            
            array(
                'id'      => 'bool',
                'type'    => 'group',
                'options' => array(
                    'group_title'   => __( 'Bool group {#}' ),
                    'add_button'    => __( 'Add group' ),
                    'remove_button' => __( 'Remove group' ),
                    'sortable'      => false
                ),
                'fields'  => array(
                    array(
                        'name' => __( 'Yes / no title' ),
                        'id'   => 'title',
                        'type' => 'text'
                    ),
                    array(
                        'name'    => __( 'Value' ),
                        'id'      => 'bool_value',
                        'type'    => 'radio',
                        'options' => array(
                            'true'  => 'true',
                            'false' => 'false',
                        )
                    )
                )
            )
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab6',
        'title'  => __( 'Buttons' ),
        'fields' => array(
            array(
                'name'    => __( 'Primary button text' ),
                'id'      => 'primary_button_text',
                'type'    => 'text'
            ),
            array(
                'name'    => __( 'Primary button link' ),
                'id'      => 'primary_button_link',
                'type'    => 'text'
           ),
            array(
                'name'    => __( 'Open primary button link in new tab' ),
                'id'      => 'primary_button_link_target',
                'type'    => 'checkbox'
            ),
            array(
                'name'    => __( 'Secondary button text' ),
                'id'      => 'secondary_button_text',
                'type'    => 'text'
            ),
            array(
                'name'    => __( 'Secondary button link' ),
                'id'      => 'secondary_button_link',
                'type'    => 'text'
            ),
            array(
                'name'    => __( 'Open secondary button link in new tab' ),
                'id'      => 'secondary_button_link_target',
                'type'    => 'checkbox'
            ),
            array(
                'name'    => __( 'Additional text' ),
                'id'      => 'additional_text',
                'type'    => 'text'
            ),
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab8',
        'title'  => __( 'Description' ),
        'fields' => array(
            array(
                'name'    => __( 'Description' ),
                'id'      => 'description',
                'type'    => 'wysiwyg'
            ),
        )
    );

    $tabs_setting['tabs'][] = array(
        'id'     => 'tab10',
        'title'  => __( 'Icons value' ),
        'fields' => array(
            array(
                'id'      => 'icons',
                'type'    => 'group',
                'options' => array(
                    'group_title'   => __( 'Icon item {#}' ),
                    'add_button'    => __( 'Add item' ),
                    'remove_button' => __( 'Remove item' ),
                    'sortable'      => false
                ),
                'fields'  => array(
                    array(
                        'name' => __( 'Choose icon' ),
                        'id'   => 'icon_id',
                        'type' => 'select',
                        'options' => stz_icons_list()
                    ),
                    array(
                        'name' => __( 'Icon label value' ),
                        'id'   => 'value',
                        'type' => 'text'
                    ),
                    array(
                        'name' => __( 'Icon label description' ),
                        'id'   => 'label',
                        'type' => 'text'
                    ),
                )
            )
        )
    );

    // set tabs
    $cmb->add_field( array(
        'id'   => '__tabs',
        'type' => 'tabs',
        'tabs' => $tabs_setting
    ) );;
}
