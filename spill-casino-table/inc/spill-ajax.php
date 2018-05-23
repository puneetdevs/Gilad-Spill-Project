<?php
add_action('wp_ajax_spill_table_ajax', 'spill_table_ajax');
add_action('wp_ajax_nopriv_spill_table_ajax', 'spill_table_ajax');
function spill_table_ajax() {
    global $wpdb; // this is how you get access to the database    
    $user_id = '';
    $output = array();
    if($_POST['submit_type']=='') {
        $output = array('status'=>'error', 'message' => __('Something went wrong, please try again later.', 'spill_table'), 'error_type'=>'user_type');
        $return = json_encode($output);
    } else {
        
        $submit_type = $_POST['submit_type'];

        if ($submit_type == 'new_user') {
            if ($spill_name!='' && $spill_email!='' && $$spill_password!='' ) {
                $spill_name 		= $_POST['spill_name'];
                $spill_email 		= $_POST['spill_email'];
                $spill_password 	= $_POST['spill_password'];
    
                if (false == email_exists($spill_email) && false == username_exists($spill_email)) {
                    $user_id = wp_create_user($spill_name, $spill_password, $spill_email);
                } else {
                    $output = array('status'=>'error', 'message' => __('Username or email already exists.', 'spill_table'), 'error_type'=>'user_exist');
                    echo json_encode($output);
                    wp_die();
                }
            } else {
                $output = array('status'=>'error', 'message' => __('Please enter the form fields', 'spill_table'), 'error_type'=>'empty_fields');
                echo json_encode($output);
                wp_die();
            }
        } else {
            $user_id = $_POST['user_id'];        
        }
        
        if ($user_id!='') {
            $stz_entry = intval($_POST['stz_entry']);
            $current_rate = intval($_POST['radioValue']);
            
            $review_key = 'review_'. $stz_entry ;
        
            if (!get_user_meta($user_id, $review_key, true)) {
                update_user_meta( $user_id, $review_key, $current_rate);
                $total_rating = get_post_meta($stz_entry, 'total_rating', true); //2
                $total_rating += 1; //3
                update_post_meta($stz_entry, 'total_rating', $total_rating);
                $get_old_ratings = get_post_meta($stz_entry, 'rating_readonly', true);
                $get_old_ratings += $current_rate;
                $save = update_post_meta($stz_entry, 'rating_readonly', $get_old_ratings);
                $output = array('status'=>'success', 'message' => __('Thanks for your review.', 'spill_table'));
                echo json_encode($output);
                wp_die();
            }else{
                $output = array('status'=>'success', 'message' => __('You have already given reviews', 'spill_table'), 'error_type'=>'duplicate');
                echo json_encode($output);
                wp_die();
            }               
        }
    }
        
    $output = array('status'=>'error', 'message' => __('Something went wrong, please try again later.', 'spill_table'), 'error_type'=>'wp_error');
    echo json_encode($output);
    wp_die(); // this is required to terminate immediately and return a proper response
}
