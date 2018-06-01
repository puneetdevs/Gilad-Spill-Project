<?php
/**
 * Generate the shortcode
 * Shortcode : [spilltable id='X']
 */
function STZ_spilltable_shortcode($atts)
{
    ob_start();
    
    $table_meta = get_post_meta($atts['id']);
    $table_id = $atts['id'];

    /**
     * DECLEARE
     * ALL
     * THE
     * VAIRABLES
     * FOR
     * THE
     * TABLES
     * SETTINGS
     *
    **/

    /** Hide Table Header */
    $header_hide = '';
    
    /** TABLE Visible Rows VARIABLES */
    $header_text_color = '';
    $header_font_family = '';
    $header_font_style = '';
    $header_font_size = '';
    $header_bg_color = '';
    $header_bg_hover_color = '';
    $head_bg_hover_color = '';
    
    /** TABLE ROWS Dropdown Content VARIABLES */
    $content_text_color = '';
    $content_font_family = '';
    $content_font_style = '';
    $content_font_size = '';
    $content_row_color = '';
    $content_row_hover_color = '';
    $content_show_row_shadow = '';
    $content_row_shadow_color = '';
    $content_bg_row_color = '';
    $content_bg_hover_color = '';

    /** LOAD MORE VARIABLES */
    $sm_rows = '';
    $sm_more_text = '';
    $sm_less_text = '';
    $sm_bg_color = '';
    $sm_button_color = '';
    $sm_button_font = '';
    $sm_bg_hover_color = '';
    $sm_button_hover_color = '';

    $header_counter_or_image = '';
    $sm_show_table_shadow = '';
    $sm_table_shadow_color = '';

    /** OTHER SETTINGS */
    $os_count_image = '';
    $os_border_color = '';
    $os_border_width = '';
    $os_gap_rows = '';
    

    /** BUTTON SETTINGS */
    $btn_primary_txt_color ='';
    $btn_primary_hover_txt_color='';
    $btn_primary_color='';
    $btn_primary_hover_color='';
    $btn_primary_font='';
    
    $btn_secondary_txt_color='';
    $btn_secondary_hover_txt_color='';
    $btn_secondary_color='';
    $btn_secondary_hover_color='';
    $btn_secondary_font='';
    
    $btn_view_more_txt_color='';
    $btn_view_more_hover_txt_color='';
    $btn_view_more_color='';
    $btn_view_more_hover_color='';
    $btn_view_more_font='';


    /**
     * Logo and Screenshot type
     */
    $ss_display_type ='square';
    $logo_display_type = 'square';
    /** Get the variable data */

    /**
     * Get Logo and Screenshot design
     */
    if (get_post_meta($table_id, 'display_logo', true)) {
        $logo_display_type = get_post_meta($table_id, 'display_logo', true);                            
    }
    if (get_post_meta($table_id, 'display_screenshot', true)) {
        $ss_display_type = get_post_meta($table_id, 'display_screenshot', true);                            
    }
    
    /**
     * ROW SETTINGS 
     */

    if (get_post_meta($table_id, 'header_text_color', true)) {
        $header_text_color = get_post_meta($table_id, 'header_text_color', true);
        $header_text_color = ' color:'. $header_text_color .';' ;
    }
    if (get_post_meta($table_id, 'header_font_family', true)) {
        $header_font_family = get_post_meta($table_id, 'header_font_family', true);
    }
    if (get_post_meta($table_id, 'header_font_style', true)) {
        $header_font_style = get_post_meta($table_id, 'header_font_style', true);
        $header_font_style = ' font-style:'. $header_font_style .';' ;
    }
    if (get_post_meta($table_id, 'header_font_size', true)) {
        $header_font_size = get_post_meta($table_id, 'header_font_size', true);
        $header_font_size = ' font-size:'. $header_font_size .'px;' ;
    }
    if (get_post_meta($table_id, 'header_bg_color', true)) {
        $header_bg_color = get_post_meta($table_id, 'header_bg_color', true);
        $header_bg_color = ' background-color:'. $header_bg_color .';' ;
    }
    if (get_post_meta($table_id, 'header_bg_hover_color', true)) {
        $header_bg_hover_color = get_post_meta($table_id, 'header_bg_hover_color', true);
        $head_bg_hover_color = ' background-color:'. $header_bg_hover_color .' !important;' ;
    }

    /**
     * DROP-DOWN CONTENT SETTINGS
     */

    if (get_post_meta($table_id, 'content_text_color', true)) {
        $content_text_color = get_post_meta($table_id, 'content_text_color', true);
        $content_text_color = ' color:'. $content_text_color .';' ;
    }
    if (get_post_meta($table_id, 'content_font_family', true)) {
        $content_font_family = get_post_meta($table_id, 'content_font_family', true);
    }
    if (get_post_meta($table_id, 'content_font_style', true)) {
        $content_font_style = get_post_meta($table_id, 'content_font_style', true);
        $content_font_style = ' font-style:'. $content_font_style .';' ;
    }
    if (get_post_meta($table_id, 'content_font_size', true)) {
        $content_font_size = get_post_meta($table_id, 'content_font_size', true);
        $content_font_size = ' font-size:'. $content_font_size .'px;' ;
    }
    if (get_post_meta($table_id, 'content_row_color', true)) {
        $content_row_color = get_post_meta($table_id, 'content_row_color', true);
        $content_bg_row_color = ' background-color:'. $content_row_color .';' ;
        $content_row_color = ' color:'. $content_row_color .';' ;
    }
    if (get_post_meta($table_id, 'content_row_hover_color', true)) {
        $content_row_hover_color = get_post_meta($table_id, 'content_row_hover_color', true);
        $content_bg_hover_color = ' background-color:'. $content_row_hover_color .' !important;' ;
        $content_row_hover_color = ' color:'. $content_row_hover_color .';' ;
    }
    if (get_post_meta($table_id, 'content_show_row_shadow', true)) {
        $content_show_row_shadow = get_post_meta($table_id, 'content_show_row_shadow', true);
    }
    if (get_post_meta($table_id, 'content_row_shadow_color', true)) {
        $content_row_shadow_color = get_post_meta($table_id, 'content_row_shadow_color', true);
    }


    /** HIDE SHOW TABLE HEADER */
    if (get_post_meta($table_id, 'header_hide', true)) {
        $header_hide = get_post_meta($table_id, 'header_hide', true);
    }

    /**
     * DISPLAY ROWS SETTINGS
     */
    if (get_post_meta($table_id, 'sm_rows', true)) {
        $sm_rows = get_post_meta($table_id, 'sm_rows', true);
    }
    if (get_post_meta($table_id, 'sm_more_text', true)) {
        $sm_more_text = get_post_meta($table_id, 'sm_more_text', true);
    }
    if (get_post_meta($table_id, 'sm_less_text', true)) {
        $sm_less_text = get_post_meta($table_id, 'sm_less_text', true);
    }
    if (get_post_meta($table_id, 'sm_bg_color', true)) {
        $sm_bg_color = get_post_meta($table_id, 'sm_bg_color', true);
        $sm_bg_color = ' background-color:'. $sm_bg_color .';' ;
    }
    if (get_post_meta($table_id, 'sm_button_color', true)) {
        $sm_button_color = get_post_meta($table_id, 'sm_button_color', true);
        $sm_button_color = ' color:'. $sm_button_color.';' ;
    }
    if (get_post_meta($table_id, 'sm_button_font', true)) {
        $sm_button_font = get_post_meta($table_id, 'sm_button_font', true);
        $sm_button_font = ' font-size:'. $sm_button_font.'px;' ;
    }
    if (get_post_meta($table_id, 'sm_bg_hover_color', true)) {
        $sm_bg_hover_color = get_post_meta($table_id, 'sm_bg_hover_color', true);
    }
    if (get_post_meta($table_id, 'sm_button_hover_color', true)) {
        $sm_button_hover_color = get_post_meta($table_id, 'sm_button_hover_color', true);
    }
    if (get_post_meta($table_id, 'header_counter_or_image', true)) {
        $header_counter_or_image = get_post_meta($table_id, 'header_counter_or_image', true);
    }
    if (get_post_meta($table_id, 'sm_show_table_shadow', true)) {
        $sm_show_table_shadow = get_post_meta($table_id, 'sm_show_table_shadow', true);
    }
    if (get_post_meta($table_id, 'sm_table_shadow_color', true)) {
        $sm_table_shadow_color = get_post_meta($table_id, 'sm_table_shadow_color', true);
    }

    /**
     * DISPLAY IMAGE INSTEAD OF NUMBERS SETTINGS
     */
    if (get_post_meta($table_id, 'os_count_image', true)) {
        $os_count_image = get_post_meta($table_id, 'os_count_image', true);
    }
    if (get_post_meta($table_id, 'os_border_color', true)) {
        $os_border_color = get_post_meta($table_id, 'os_border_color', true);
    }
    if (get_post_meta($table_id, 'os_border_width', true)) {
        $os_border_width = get_post_meta($table_id, 'os_border_width', true);
    }
    if (get_post_meta($table_id, 'os_gap_rows', true)) {
        $os_gap_rows = get_post_meta($table_id, 'os_gap_rows', true);
    }
    
    
    if ($header_font_family!='') {
        if ('Roboto'==$header_font_family) {
            $header_font_family = " font-family: 'Roboto', sans-serif;";
        } elseif ('Work+Sans'==$header_font_family) {
            $header_font_family = " font-family: 'Work Sans', sans-serif;";
        } elseif ('PT+Sans'==$header_font_family) {
            $header_font_family = " font-family: 'PT Sans', sans-serif;";
        } elseif ('Lato'==$header_font_family) {
            $header_font_family = " font-family: 'Lato', sans-serif;";
        } elseif ('Open+Sans'==$header_font_family) {
            $header_font_family = " font-family: 'Open Sans', sans-serif;";
        } elseif ('Oswald'==$header_font_family) {
            $header_font_family = " font-family: 'Oswald', sans-serif;";
        } elseif ('Montserrat'==$header_font_family) {
            $header_font_family = " font-family: 'Montserrat', sans-serif;";
        } else {
            $header_font_family ='';
        }
    }
    
    if ($content_font_family != '') {
        if ('Roboto'==$content_font_family) {
            $content_font_family = " font-family: 'Roboto', sans-serif;";
        } elseif ('Work+Sans'==$content_font_family) {
            $content_font_family = " font-family: 'Work Sans', sans-serif;";
        } elseif ('PT+Sans'==$content_font_family) {
            $content_font_family = " font-family: 'PT Sans', sans-serif;";
        } elseif ('Lato'==$content_font_family) {
            $content_font_family = " font-family: 'Lato', sans-serif;";
        } elseif ('Open+Sans'==$content_font_family) {
            $content_font_family = " font-family: 'Open Sans', sans-serif;";
        } elseif ('Oswald'==$content_font_family) {
            $content_font_family = " font-family: 'Oswald', sans-serif;";
        } elseif ('Montserrat'==$content_font_family) {
            $content_font_family = " font-family: 'Montserrat', sans-serif;";
        } else {
            $content_font_family ='';
        }
    }


    /**
     * BUTTON SETTINGS AND DESING
     */
    
    if (get_post_meta($table_id, 'btn_primary_txt_color', true)) {
        $btn_primary_txt_color = get_post_meta($table_id, 'btn_primary_txt_color', true);
        $btn_primary_txt_color = ' color:'. $btn_primary_txt_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_primary_hover_txt_color', true)) {
        $btn_primary_hover_txt_color = get_post_meta($table_id, 'btn_primary_hover_txt_color', true);
        $btn_primary_hover_txt_color = ' color:'. $btn_primary_hover_txt_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_primary_color', true)) {
        $btn_primary_color = get_post_meta($table_id, 'btn_primary_color', true);
        $btn_primary_color = ' background-color:'. $btn_primary_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_primary_hover_color', true)) {
        $btn_primary_hover_color = get_post_meta($table_id, 'btn_primary_hover_color', true);
        $btn_primary_hover_color = ' background-color:'. $btn_primary_hover_color .' !important;' ;
    }

    if (get_post_meta($table_id, 'btn_primary_font', true)) {
        $btn_primary_font = get_post_meta($table_id, 'btn_primary_font', true);
        $btn_primary_font = ' font-size:'. $btn_primary_font .'px;' ;
    }
    
    if (get_post_meta($table_id, 'btn_secondary_txt_color', true)) {
        $btn_secondary_txt_color = get_post_meta($table_id, 'btn_secondary_txt_color', true);
        $btn_secondary_txt_color = ' color:'. $btn_secondary_txt_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_secondary_hover_txt_color', true)) {
        $btn_secondary_hover_txt_color = get_post_meta($table_id, 'btn_secondary_hover_txt_color', true);
        $btn_secondary_hover_txt_color = ' color:'. $btn_secondary_hover_txt_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_secondary_color', true)) {
        $btn_secondary_color = get_post_meta($table_id, 'btn_secondary_color', true);
        $btn_secondary_color = ' background-color:'. $btn_secondary_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_secondary_hover_color', true)) {
        $btn_secondary_hover_color = get_post_meta($table_id, 'btn_secondary_hover_color', true);
        $btn_secondary_hover_color = ' background-color:'. $btn_secondary_hover_color .' !important;' ;
    }

    if (get_post_meta($table_id, 'btn_secondary_font', true)) {
        $btn_secondary_font = get_post_meta($table_id, 'btn_secondary_font', true);
        $btn_secondary_font = ' font-size:'. $btn_secondary_font .'px;' ;
    }
        
    if (get_post_meta($table_id, 'btn_view_more_txt_color', true)) {
        $btn_view_more_txt_color = get_post_meta($table_id, 'btn_view_more_txt_color', true);
        $btn_view_more_txt_color = ' color:'. $btn_view_more_txt_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_view_more_hover_txt_color', true)) {
        $btn_view_more_hover_txt_color = get_post_meta($table_id, 'btn_view_more_hover_txt_color', true);
        $btn_view_more_hover_txt_color = ' color:'. $btn_view_more_hover_txt_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_view_more_color', true)) {
        $btn_view_more_color = get_post_meta($table_id, 'btn_view_more_color', true);
        $btn_view_more_color = ' background-color:'. $btn_view_more_color .';' ;
    }

    if (get_post_meta($table_id, 'btn_view_more_hover_color', true)) {
        $btn_view_more_hover_color = get_post_meta($table_id, 'btn_view_more_hover_color', true);
        $btn_view_more_hover_color = ' background-color:'. $btn_view_more_hover_color .' !important;' ;
    }

    if (get_post_meta($table_id, 'btn_view_more_font', true)) {
        $btn_view_more_font = get_post_meta($table_id, 'btn_view_more_font', true);
        $btn_view_more_font = ' font-size:'. $btn_view_more_font .'px;' ;
    }

    if ($content_show_row_shadow=='on') {
        if ($content_row_shadow_color) {
            $content_shadow = ' box-shadow: 1px 4px 8px 6px '. $content_row_shadow_color . ';';
        } else {
            $content_shadow = ' box-shadow: 3px 5px 10px rgba(0,0,0,0.4);';
        }
    }


    /** GET TABLE COLUMNS */
    $table_cols = get_post_meta($table_id, 'rows_group', true);
    
    /** GET TABLE ROWS */
    $attached = get_post_meta($atts['id'], 'table_attached_stz_entries', true);

    if (is_array($table_cols) && !empty($table_cols)) {
        ?>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <style>            
            <?php 
            /* Dynamic Table CSS */
            echo "#spill-table-". $table_id . " .tr-row:hover {" . $head_bg_hover_color ."}";
            echo "#spill-table-". $table_id . " .tr-table:hover {" . $content_bg_hover_color ."}";
            echo "#spill-table-". $table_id . " .primary_btn:hover {" . $btn_primary_hover_txt_color . $btn_primary_hover_color ."}";
            echo "#spill-table-". $table_id . " .secondary_btn:hover {" . $btn_secondary_hover_txt_color . $btn_secondary_hover_color ."}";
            echo "#spill-table-". $table_id . " .more_button:hover {" . $btn_view_more_secondary_hover_txt_color . $btn_view_more_secondary_hover_color ."}";
            $sm_button_hover_color = (trim($sm_button_hover_color!=''))? ' background-color: '.$sm_button_hover_color. ' !important' : ' background-color : #000000 !important';
            $sm_bg_hover_color = (trim($sm_bg_hover_color!=''))? ' background-color: '.$sm_bg_hover_color. ' !important' : ' background-color : #dedede !important';
            echo "#spill-table-" . $table_id . " .toggle_rows:hover { ". $sm_bg_hover_color . $sm_button_hover_color ." } "; 
            ?>
        </style>
        <div class="spill-table" id="spill-table-<?php echo $table_id; ?>">
            <table cellspacing="0" cellpadding="0" style="<?php echo ' border-collapse: separate;border-spacing: 0 '.$os_gap_rows.'px;border: none;'  ?>">
                <?php 
                $sm_more_text = (trim($sm_more_text)!='')?$sm_more_text:'Load More';
                $sm_less_text = (trim($sm_less_text)!='')?$sm_less_text:'Load Less';
                    
                $sm_bg_color = '';
                $sm_button_color = '';
                $sm_button_font = '';
                $sm_bg_hover_color = '';
                $sm_button_hover_color = '';

                $hide_rows = '';
                $display_button='';
                $show_more_button = false;
                $hide_header = false;

                if ($sm_rows) {
                    $hide_rows = 'hide_rows';                    
                }
                
                if ($header_hide==='on') {
                    $hide_header = true;                    
                }
                
                /** TABLE HEAD SETTINGS */
                if (!$hide_header) {  ?>
                    <thead class="table_header" style="">                    
                        <tr class="tr-head" style="<?php echo $header_text_color . $header_font_family . $header_font_size . $header_bg_color. $content_shadow; ?>">
                            <?php  
                            $col_counter = 0;
                            
                            foreach ($table_cols as $table_col) 
                            {
                                $col_style ='';

                                $table_col['title'] = ($table_col['hide']==on)? '':$table_col['title'];

                                if(isset($col_font_family['font_family']))
                                {
                                    if ('Roboto'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'Roboto', sans-serif;";
                                    } elseif ('Work+Sans'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'Work Sans', sans-serif;";
                                    } elseif ('PT+Sans'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'PT Sans', sans-serif;";
                                    } elseif ('Lato'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'Lato', sans-serif;";
                                    } elseif ('Open+Sans'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'Open Sans', sans-serif;";
                                    } elseif ('Oswald'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'Oswald', sans-serif;";
                                    } elseif ('Montserrat'==$col_font_family['font_family']) {
                                        $col_style .= " font-family: 'Montserrat', sans-serif;";
                                    } else {
                                        $col_style .='';
                                    }
                                }

                                echo '<th style="'.$col_style.'">'. $table_col['title'] . '</th>';
                                
                            }   ?>
                        </tr>
                    </thead>
                    <?php
                }

                /** TABLE ROWS - HEADER SETTINGS */

                $count_entries = 1;
                foreach ($attached as $attached_post) 
                {
                    $entry_post = get_post($attached_post);

                    if ($entry_post->post_status=='publish') {
                        $entry_meta = get_post_meta($entry_post->ID);
                        //echo '<pre>' ; print_r($entry_post);die();
                        //echo '<pre>' ; print_r($entry_meta);echo'</pre>';
                        //echo '<pre>' ; print_r(get_post_meta($entry_post->ID, 'icons', true)); echo'</pre>';
                        
                        $bounses = get_post_meta($entry_post->ID, 'bonus', true);
                        $texts   = get_post_meta($entry_post->ID, 'text', true);
                        $lists   = get_post_meta($entry_post->ID, 'list', true);
                        $bools   = get_post_meta($entry_post->ID, 'bool', true);
                                        
                        $primary_button_text = get_post_meta($entry_post->ID, 'primary_button_text', true);

                        if (!$primary_button_text) {
                            $primary_button_text = 'Play Right Now';
                        }
                                        
                        $primary_button_link = get_post_meta($entry_post->ID, 'primary_button_link', true);
                        if (!$primary_button_link) {
                            $primary_button_link = '#';
                        }

                        $primary_button_link_target = get_post_meta($entry_post->ID, 'primary_button_link_target', true);
                        $primary_link_target = '_self';
                        if ($primary_button_link_target[0]=='on') {
                            $primary_link_target = '_blank';
                        }

                        $secondary_button_text = get_post_meta($entry_post->ID, 'secondary_button_text', true);
                        if (!$secondary_button_text) {
                            $secondary_button_text = 'Read Review';
                        }

                        $secondary_button_link = get_post_meta($entry_post->ID, 'secondary_button_link', true);
                        if (!$secondary_button_link) {
                            $secondary_button_link = '#';
                        }

                        $secondary_button_link_target = get_post_meta($entry_post->ID, 'secondary_button_link_target', true);
                        $secondary_link_target = '_self';
                        if ($secondary_button_link_target[0]=='on') {
                            $secondary_link_target = '_blank';
                        }
                                                                
                        $additional_text = get_post_meta($entry_post->ID, 'additional_text', true);
                        if (trim($additional_text)=='') {
                            $additional_text='View More';
                        } 
                        ?>                        
                        <tbody class="dropdown dropdown-processed <?php if ($count_entries>$sm_rows) { echo $hide_rows;  $show_more_button=true;  } ?>" style="">
                            <tr class="tr-row" style="<?php echo $header_text_color . $header_font_family . $header_font_size . $header_bg_color; ?> <?php echo $content_shadow; ?>">
                                <?php  
                                $col_counter = 0;
                                $table_rows = array();
                                
                                foreach ($table_cols as $table_col)
                                {
                                    array_push($table_rows, $table_col['type']);
                                    
                                    if($table_col['type']=='numbers')
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0"> 
                                            <div class="left_col1">
                                                <?php  if ($header_counter_or_image=='number') {
                                                    echo '<div class="counter">'.$count_entries."</div>";
                                                } else {
                                                    if($os_count_image){
                                                        echo $selected_image = wp_get_attachment_image( get_post_meta( $table_id, 'os_count_image_id', 1 ), array('50', '50'), "", array( "class" => 'counter_image' ) ); 
                                                    }else{
                                                        echo '<i class="fa fa-star"></i> ';
                                                    }                                                    
                                                } ?>
                                            </div>
                                        </td> <?php
                                    }
                                    else if($table_col['type']=='logo') 
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            <div class="spill_logo">
                                                <?php if (get_post_meta($entry_post->ID, 'logo', true)) : ?>
                                                <img class="spill-table-logo <?php echo $logo_display_type; ?>" src="<?php echo get_post_meta($entry_post->ID, 'logo', true); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </td> <?php
                                    }
                                    else if($table_col['type']=='bonus') 
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            <div class="left_col1 vote_col3"> 
                                                <?php 
                                                if (!empty($bounses)) {
                                                    foreach ($bounses as $bonus) {
                                                        if ('no_deposit_bonus' === $bonus['type']) {
                                                            echo ' NO Deposit Bonus-' . $bonus['amount'] ;
                                                        } elseif ('first_deposit_bonus' === $bonus['type']) {
                                                            echo ' First Deposit Bonus '. $bonus['amount'];
                                                        } elseif ('free_spins_bonus' === $bonus['type']) {
                                                            echo ' Free Spins Bonus '. $bonus['amount'];
                                                        } elseif ('reload_bonus' === $bonus['type']) {
                                                            echo ' Reload Bonus '. $bonus['amount'];
                                                        } elseif ('high_roller_bonus' === $bonus['type']) {
                                                            echo ' High Roller Bonus '. $bonus['amount'];
                                                        } elseif ('vip_bonus' ===$bonus['type']) {
                                                            echo ' VIP Bonus '. $bonus['amount'];
                                                        } else {
                                                            //echo ' '. $bonus['amount'];
                                                        }
                                                        echo '<br/>';
                                                    }
                                                }else {
                                                    echo 'NO Bonus Available';
                                                } ?>
                                            </div>
                                        </td> <?php 
                                    }
                                    else if($table_col['type']=='devices') 
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            
                                        </td><?php 
                                    }
                                    else if($table_col['type']=='currencies') 
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            
                                        </td><?php
                                    }
                                    else if($table_col['type']=='proscons')
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            
                                        </td><?php 
                                    }
                                    else if($table_col['type']=='rating') 
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            <div class="vote_col vote_col1">                                        
                                                <?php 
                                                $show_rating_in = get_post_meta($entry_post->ID, 'show_rating_in', true);
                                                if ($show_rating_in=='stars') {
                                                    $rating_float = get_post_meta($entry_post->ID, 'rating_float', true);
                                                    if ($rating_float) {
                                                        echo '<ul class="review_rating" style="padding: 0;margin: 0;">';
                                                        for ($i=$rating_float;$i>0;$i--) {
                                                            echo '<li><i class="fa fa-star"></i></li>';
                                                        }
                                                        echo "</ul>";
                                                    }
                                                } else if ($show_rating_in=='integer') {
                                                    $rating_integer = get_post_meta($entry_post->ID, 'rating_integer', true);
                                                    if ($rating_integer) {
                                                        echo '<span class="rating_intger">' . $rating_integer . '</span>';
                                                    } else {
                                                        echo '<span style="width:0%;background-color: #5bac5d;"></span>';
                                                    }
                                                } else {
                                                    $total_ratings = 0;
                                                    $total_ratings = $total_ratings + get_post_meta($entry_post->ID, 'total_rating', true);
                                                    $get_old_ratings = get_post_meta($entry_post->ID, 'rating_readonly', true);
                                                    if ($get_old_ratings) {
                                                        $rating=0;
                                                        if ($total_ratings>0) {
                                                            $rating = $rating + round(($get_old_ratings/$total_ratings), 2);
                                                        }
                                                        echo '<span>'.$rating.'<small>/ '.$total_ratings.' votes</small></span>';
                                                    }

                                                    $rating_percents = get_post_meta($entry_post->ID, 'rating_percents', true);
                                                    echo '<div class="vote_box">';
                                                        if ($rating_percents) {
                                                            echo '<span style="width: '.$rating_percents.'%;background-color: #5bac5d;"></span>';
                                                        } else {
                                                            echo '<span style="width:0%;background-color: #5bac5d;"></span>';
                                                        } 
                                                    echo '</div>';
                                                } ?>
                                            </div>
                                        </td><?php 
                                    }
                                    else if($table_col['type']=='text') 
                                    { 	?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            <?php
                                            if (!empty($texts)) {
                                                echo '<div class="text_group">';
                                                foreach ($texts as $text) {
                                                    echo '<div class="text_row">
                                                        <div class="text_title" style="display:none">'.$text['title'].' </div> 
                                                        <div class="text_details" style="display:none">'.$text['text_content'].' </div>
                                                        <div class="text_highlight">'.$text['text_highlight'].'</div>
                                                    </div>';
                                                }
                                                echo '</div>';
                                            } ?>
                                        </td> <?php 
                                    }
                                    else if($table_col['type']=='button') 
                                    { 	
                                        ?>
                                        <td width="" style="border-left:1px solid #f2f0f0">
                                            <a href="<?php echo $primary_button_link; ?>" class="claim_button primary_btn" target="<?php echo $primary_link_target; ?>" style="<?php echo $btn_primary_txt_color . $btn_primary_color .$btn_primary_font; ?>"> <?php echo $primary_button_text; ?> </a>
                                            <a href="#" class="more_button dropdown-link" style="<?php echo $btn_view_more_txt_color . $btn_view_more_color .$btn_view_more_font; ?>" ><?php echo $additional_text; ?> <i class="fa fa-plus"></i></a>
                                        </td> <?php
                                    }					
                                } 	?>
                            </tr>
                            <?php /** TABLE ROWS - CONTENT SETTINGS */

                            if(in_array("button", $table_rows) ) 
                            {   ?>
                                <tr class="dropdown-container" style="<?php echo $content_text_color . $content_font_family . $content_font_style. $content_font_size ; ?> display: none; ">
                                    <td colspan="<?php echo count($table_rows) ?>">
                                        <table class="row-table" cellpadding="0" cellspacing="0" >
                                            <tr>
                                                <td width="50%">
                                                    <div class="sub_table">
                                                        <div class="sub_table_top" style="<?php echo $content_bg_row_color; ?>">
                                                            <div class="tooltip pull-right">
                                                                <i class="fa fa-exclamation-circle"></i> 
                                                                <span class="tooltiptext">More Information</span>
                                                            </div>
                                                            <?php 
                                                            if (!empty($bounses)) {
                                                                echo '<div class="bonuses_group">';
                                                                foreach ($bounses as $bonus) {
                                                                    if ('no_deposit_bonus' === $bonus['type']) {
                                                                        echo '<div class="bonus_row"> <strong>'. $bonus['amount'] .'</strong> NO Deposit Bonus  </div>';
                                                                    } elseif ('first_deposit_bonus' === $bonus['type']) {
                                                                        echo ' <div class="bonus_row"><strong>'. $bonus['amount'] .'</strong> First Deposit Bonus </div>';
                                                                    } elseif ('free_spins_bonus' === $bonus['type']) {
                                                                        echo ' <div class="bonus_row"><strong>'. $bonus['amount'] .'</strong> Free Spins Bonus </div>';
                                                                    } elseif ('reload_bonus' === $bonus['type']) {
                                                                        echo ' <div class="bonus_row"><strong>'. $bonus['amount'] .'</strong> Reload Bonus </div>';
                                                                    } elseif ('high_roller_bonus' === $bonus['type']) {
                                                                        echo ' <div class="bonus_row"> <strong>'. $bonus['amount'] .'</strong> High Roller Bonus </div>';
                                                                    } elseif ('vip_bonus' ===$bonus['type']) {
                                                                        echo ' <div class="bonus_row"><strong>'. $bonus['amount'] .'</strong> VIP Bonus</div>';
                                                                    } else {
                                                                        //echo ' '. '<h1><em>$</em>'.$bonus['amount'].'</h1>';;
                                                                    }
                                                                }
                                                                echo '</div>';
                                                            } ?>                                                        
                                                        </div>
                                                        <div class="entry-details">Details</div>
                                                        <?php 
                                                        if (!empty($texts)) {
                                                            echo '<div class="text_group">';
                                                            foreach ($texts as $text) {
                                                                echo '<div class="text_row">
                                                                    <div class="text_title">'.$text['title'].' </div> 
                                                                    <div class="text_details">'.$text['text_content'].' </div>
                                                                    <div class="text_highlight">'.$text['text_highlight'].'</div>
                                                                </div>';
                                                            }
                                                            echo '</div>';
                                                        }

                                                        if (!empty($bools)) {
                                                            echo '<div class="true_false">';
                                                            foreach ($bools as $bool) {
                                                                if ($bool['bool_value']=='true') {
                                                                    $fa = ' <i class="fa fa-check"></i>';
                                                                } else {
                                                                    $fa = ' <i class="fa fa-times"></i>';
                                                                }
                                                                echo '<div class="true_false_row">'.  $fa . $bool['title']. '</div>';
                                                            }
                                                            echo '</div>';
                                                        }

                                                        if (!empty($lists)) {
                                                            echo '<div class="lists_group">';
                                                            foreach ($lists as $list) {
                                                                if (!empty($list['items'])) {
                                                                    echo '<div class="list-child"> <div class="list-title"> '.$list['title']. ' </div> <div class="list_items">';
                                                                    foreach ($list['items'] as $list_item) {
                                                                        echo '<div class="list_item">'.$list_item.'</div>';
                                                                    }
                                                                    echo '</div> </div>';
                                                                }
                                                            }
                                                            echo '</div>';
                                                        }
                                                        if (get_post_meta($entry_post->ID, 'description', true)) {
                                                            echo '<div class="detail-entry-desc">'. get_post_meta($entry_post->ID, 'description', true).'</div>';
                                                        }
                                                        /*
                                                            $rating_float = get_post_meta($entry_post->ID, 'rating_float', true);
                                                            if($rating_float){
                                                                //echo '<p>Rating Float: <strong>'.$rating_float.'</strong></p>';
                                                                echo "<ul class='review_rating'>";
                                                                for($i=$rating_float;$i>0;$i--){
                                                                    echo '<li><i class="fa fa-star"></li>';
                                                                }
                                                                echo "</ul>";
                                                            }
                                                        */ ?>
                                                        <?php if (get_post_meta($entry_post->ID, 'image', true)) : ?>
                                                            <div class="spill_screenshot">
                                                                <?php $class = 'spill-table-screenshot '.$ss_display_type;  ?>
                                                                <?php echo $image = wp_get_attachment_image( get_post_meta( $entry_post->ID, 'image_id', 1 ), 'medium', "", array( "class" => $class ) ); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td width="50%">
                                                    <div class="sub_table_right">
                                                        <div class="sub_table_right_col" >
                                                            <?php 
                                                                $post_stz_payment_methods = get_the_terms($entry_post->ID, 'stz_payment_methods');
                                                                if (is_array($post_stz_payment_methods)) {
                                                                    echo '<div class="wagering_size"> <p>Payments</p>';
                                                                    foreach ($post_stz_payment_methods as $payment_method) {
                                                                        $logo = get_term_meta($payment_method->term_id, 'STZ_logo', true);
                                                                        echo '<img src="'.$logo.'">';
                                                                    }
                                                                    echo ' </div>';
                                                                } ?>
                                                                                                        <?php 
                                                                                                            $post_stz_softwares = get_the_terms($entry_post->ID, 'stz_software');
                                                                if (is_array($post_stz_softwares)) {
                                                                    echo '<div class="wagering_size"> <p>Softwares</p>';
                                                                    foreach ($post_stz_softwares as $payment_method) {
                                                                        $logo = get_term_meta($payment_method->term_id, 'STZ_logo', true);
                                                                        echo '<img src="'.$logo.'">';
                                                                    }
                                                                    echo ' </div>';
                                                                } ?>
                                                                                                        <?php 
                                                                                                            $post_stz_devices = get_the_terms($entry_post->ID, 'stz_devices');
                                                                if (is_array($post_stz_devices)) {
                                                                    echo '<div class="wagering_size">  <p>Devices</p> ';
                                                                    foreach ($post_stz_devices as $payment_method) {
                                                                        $logo = get_term_meta($payment_method->term_id, 'STZ_logo', true);
                                                                        echo '<img src="'.$logo.'">';
                                                                    }
                                                                    echo ' </div>';
                                                                } ?>
                                                            <?php 
                                                                // $post_stz_icons = get_the_terms( $entry_post->ID, 'stz_icons' );
                                                                // if(is_array($post_stz_icons)){
                                                                //     echo '<div class="wagering_size"> <p>Icons</p>';
                                                                //     foreach ( $post_stz_icons as $payment_method ) {
                                                                //         $logo = get_term_meta($payment_method->term_id, 'STZ_logo', true);
                                                                //         echo '<img src="'.$logo.'">';
                                                                //     }
                                                                //     echo ' </div>';
                                                                // }
                                                            ?>
                                                            <?php 
                                                            $icons = get_post_meta($entry_post->ID, 'icons', true);
                                                            if (is_array($icons)) {
                                                                $empty_icons = false;
                                                                $html_icons = '';
                                                                foreach ($icons as $icon) {
                                                                    if (!empty($icon)) {
                                                                        $empty_icons = true;
                                                                        $logo = get_term_meta($icon['icon_id'], 'STZ_logo', true);
                                                                                                                    
                                                                        $html_icons .=  '<div class="icon_content icons">';
                                                                        $html_icons .= ($logo!='')?'<img src="'.$logo.'">':'';
                                                                        $html_icons .=  ($icon['value']!='')? '<div class="icon-label">'. $icon['value'] . '</div>' : '';
                                                                        $html_icons .= ($icon['label']!='')? '<div class="icon-desc">' . $icon['label'] . '</div>' : '';
                                                                        $html_icons .=  '</div>';
                                                                    }
                                                                }
                                                                if ($empty_icons) {
                                                                    echo '<div class="wagering_size">'. $html_icons . ' </div>';
                                                                }
                                                            } ?>
                                                        </div>
                                                        <center>
                                                        <a href="<?php echo $secondary_button_link; ?>" class="claim_button secondary_btn"   target="<?php echo $secondary_link_target; ?>" style="<?php echo $btn_secondary_txt_color . $btn_secondary_color .$btn_secondary_font; ?>"><?php echo $secondary_button_text; ?> <i class="fa fa-gift"></i></a>
                                                            <div class="w100p pull-left clearfix"></div>
                                                            <?php if (get_post_meta($entry_post->ID, 'bool_rating', true)==='on') { ?>
                                                                <div class="stars">
                                                                    <div id="rating_<?php echo $entry_post->ID ?>" >
                                                                        <input class="star star-5" id="star-5-<?php echo $entry_post->ID ?>" type="radio" name="star" value="5" />
                                                                        <label class="star star-5" for="star-5-<?php echo $entry_post->ID ?>"></label>
                                                                        <input class="star star-4" id="star-4-<?php echo $entry_post->ID ?>" type="radio" name="star" value="4" />
                                                                        <label class="star star-4" for="star-4-<?php echo $entry_post->ID ?>"></label>
                                                                        <input class="star star-3" id="star-3-<?php echo $entry_post->ID ?>" type="radio" name="star" value="3" />
                                                                        <label class="star star-3" for="star-3-<?php echo $entry_post->ID ?>"></label>
                                                                        <input class="star star-2" id="star-2-<?php echo $entry_post->ID ?>" type="radio" name="star" value="2" />
                                                                        <label class="star star-2" for="star-2-<?php echo $entry_post->ID ?>"></label>
                                                                        <input class="star star-1" id="star-1-<?php echo $entry_post->ID ?>" type="radio" name="star" value="1"/>
                                                                        <label class="star star-1" for="star-1-<?php echo $entry_post->ID ?>"></label>                                                                    
                                                                        <?php if (!is_user_logged_in()): ?>                                                               
                                                                            <div class="user_rating_form_fields">
                                                                                <fieldset>
                                                                                    <legend>Become a member in just 20 seconds</legend>
                                                                                    <input class="form-control" id="spill_name" type="text" name="spill_name" placeholder="Enter Your Name" />
                                                                                    <input class="form-control" id="spill_email" type="email" name="spill_email" placeholder="Enter Your Email" />
                                                                                    <input class="form-control" id="spill_password" type="password" name="spill_password" placeholder="Enter Password" />
                                                                                    <label style="float: left;width: 64%;"><input style="width:10%" class="form-control" id="spill_secreat_deals" type="checkbox" name="spill_secreat_deals" /> Send me secret deals</label>
                                                                                </fieldset>
                                                                            </div>                                                                        
                                                                        <?php else: ?>
                                                                            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">                                                                        
                                                                        <?php endif; ?>                                                                    
                                                                        <span id="rating_msg_<?php echo $entry_post->ID ?>" style="white-space: nowrap;"></span><br>
                                                                        <button id="button_<?php echo $entry_post->ID ?>" class="submit_btn" style="margin: 10px;">Submit</button>
                                                                        <script type="text/javascript">
                                                                            jQuery(document).ready(function() {
                                                                                jQuery("#button_<?php echo $entry_post->ID ?>").on( "click", function(e) {
                                                                                    e.preventDefault();
                                                                                    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                                                                                    var radioValue = jQuery("#rating_<?php echo $entry_post->ID ?> input[name='star']:checked").val();

                                                                                    if(radioValue) {
                                                                                        <?php if (!is_user_logged_in()): ?>
                                                                                            var spill_name = jQuery("#rating_<?php echo $entry_post->ID ?>  #spill_name").val();
                                                                                            var spill_email = jQuery("#rating_<?php echo $entry_post->ID ?>  #spill_email").val();
                                                                                            var spill_password = jQuery("#rating_<?php echo $entry_post->ID ?>  #spill_password").val();
                                                                                                
                                                                                            var post_data = {
                                                                                                action: 'spill_table_ajax',
                                                                                                radioValue: radioValue,
                                                                                                submit_type: 'new_user',
                                                                                                stz_entry: <?php echo $entry_post->ID ?>,
                                                                                                spill_name: spill_name,
                                                                                                spill_email: spill_email,
                                                                                                spill_password: spill_password
                                                                                            };
                                                                                                
                                                                                        <?php else: ?>
                                                                                            var post_data = {
                                                                                                action: 'spill_table_ajax',
                                                                                                submit_type: 'user',
                                                                                                radioValue: radioValue,
                                                                                                stz_entry: '<?php echo $entry_post->ID; ?>',
                                                                                                user_id: '<?php echo get_current_user_id(); ?>'
                                                                                            };
                                                                                        <?php endif ;?>
                                                                                        jQuery.post({
                                                                                            url: ajaxurl,
                                                                                            type: 'POST',                                                                                        
                                                                                            data: post_data,
                                                                                            dataType: "json",
                                                                                            success: function(response) {
                                                                                                if (response.status=='success') {
                                                                                                    jQuery("#button_<?php echo $entry_post->ID ?>").hide();
                                                                                                    jQuery("#rating_msg_<?php echo $entry_post->ID ?>").text(response.message);
                                                                                                } else {                                                                                                    
                                                                                                    jQuery("#rating_msg_<?php echo $entry_post->ID ?>").text(response.message);
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                                                                                                        
                                                                                    } else {
                                                                                        alert('Select start rating first');
                                                                                    }
                                                                                });
                                                                            });
                                                                        </script>                                                                    
                                                                    </div>
                                                                </div>
                                                            <?php
                                                        } ?>
                                                        </center>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>                            
                        <?php

                        $count_entries++;
                    }
                }
                if ($sm_rows) {                    
                    $display_button = '<tbody class="hide_show_rows" style="' . $sm_button_color . $sm_bg_color .  $sm_button_font . '"> <tr> <td colspan="'. count($table_rows) .'"> <button class="toggle_rows">'. $sm_more_text . '</button> </td> </tr> </tbody>';
                }
                echo ($show_more_button)?$display_button:''; 
                ?>                                               
            </table>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#spill-table-<?php echo $table_id; ?> tbody.dropdown').each(function() {
                    var $dropdown = jQuery(this);
                    jQuery("a.dropdown-link", $dropdown).click(function(e) {
                        
                        e.preventDefault();
                        $current = jQuery("tr a.dropdown-link", $dropdown);
                        $div = jQuery("tr.dropdown-container", $dropdown);

                        $div.toggle();
                        if ($div.is(":visible")) {
                            $current.addClass('show_container');
                        } else {
                            $current.removeClass('show_container');
                        }
                        jQuery("a.dropdown-link").not($current).removeClass('show_container');
                        jQuery("tr.dropdown-container").not($div).hide();
                        return false;
                    });
                });

                jQuery('.toggle_rows').click(function(e) {

                    e.preventDefault();  
                   
                    jQuery('.hide_rows').toggle('default', function() {
                        if(jQuery(this).is(':hidden')) {
                            jQuery('.toggle_rows').text('<?php echo $sm_more_text; ?>');
                        } else {
                            jQuery('.toggle_rows').text('<?php echo $sm_less_text; ?>');
                        }
                    });
                });

            });
        </script>
        <?php
    }
    else{
        echo '<div class="no-table">No Table Data Found</div>';
    }
    return ob_get_clean();
}
add_shortcode('spilltable', 'STZ_spilltable_shortcode');
