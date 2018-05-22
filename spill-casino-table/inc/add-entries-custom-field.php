<?php
if ( ! defined( 'CMB2_ATTACHED_POSTS_FIELD_DIR' ) ) {
    /**
     * Defines the directory of the currently loaded version of WDS_CMB2_Attached_Posts_Field.
     */
   
    define( 'CMB2_ATTACHED_POSTS_FIELD_DIR', dirname( __FILE__ ) . '/' );
    
}

// Include and initiate WDS_CMB2_Attached_Posts_Field.
require_once CMB2_ATTACHED_POSTS_FIELD_DIR . 'custom-attached-posts-field.php';