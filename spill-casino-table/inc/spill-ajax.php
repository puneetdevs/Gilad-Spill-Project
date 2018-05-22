<?php 
add_action( 'wp_ajax_spill_table_ajax', 'spill_table_ajax' );
add_action( 'wp_ajax_nopriv_example_ajax_request', 'spill_table_ajax' );
function spill_table_ajax() {
	
	global $wpdb; // this is how you get access to the database

	$stz_entry = intval( $_POST['stz_entry'] );
	$current_rate = intval( $_POST['radioValue'] );
	$total_rating = get_post_meta( $stz_entry, 'total_rating', true ); //2
	$total_rating += 1; //3
	update_post_meta( $stz_entry, 'total_rating', $total_rating );
	$get_old_ratings = get_post_meta( $stz_entry, 'rating_readonly', true );
	$get_old_ratings += $current_rate;
	$save = update_post_meta( $stz_entry, 'rating_readonly', $get_old_ratings);
	echo '1';
	wp_die(); // this is required to terminate immediately and return a proper response
}
