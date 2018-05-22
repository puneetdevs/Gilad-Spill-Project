<?php
function stz_currencies_list() {
    return array(
        'usd' => __( 'US Dollar' ),
        'eur' => __( 'Euro' ),
        'gbp' => __( 'British Pound' ),
        'cad' => __( 'Canadian Dollar' ),
        'sek' => __( 'Schwedische Krone' ),
        'DKK' => __( 'Danish Krone' ),
        'btc' => __( 'Bitcoins' ),
    );
}

function stz_devices_list() {
    return array(
        'Mobile'  => __( 'Mobile' ),
        'Tablet'  => __( 'Tablet' ),
        'PC'      => __( 'PC' ),
        'Android' => __( 'Android' ),
        'iPhone'  => __( 'iPhone' ),
    );
}

function stz_get_bonus_list( $bonus_name = '' ) {
    $bonus_types = array(
        'no_deposit_bonus' => __('No deposit bonus', 'c_content'),
        'first_deposit_bonus' => __('First deposit bonus', 'c_content'),
        'free_spins_bonus' => __('Free spins', 'c_content'),
        'reload_bonus' => __('Reload', 'c_content'),
        'high_roller_bonus' => __('High Roller', 'c_content'),
        'vip_bonus' => __('Vip bonus', 'c_content'),
    );

    if (!$bonus_name) {
        return $bonus_types;
    } else {
        if( array_key_exists( $bonus_name, $bonus_types ) ){
            return $bonus_types[$bonus_name];
        } else {
            return ( $bonus_name != 'none' ) ? $bonus_name : ''; // support for legacy settings without correct translation
        }
    }
}

function stz_icons_list() {
    $terms = get_terms( 'stz_icons', array(
        'hide_empty' => false,
    ) );
    $res   = array( '0' => 'none' );

    foreach ( $terms as $term ) {
        $res[ $term->term_id ] = $term->name;
    }

    return $res;
}

function stz_columns_list() {
    return array(
        'numbers'    => __( 'Numbers' ),
        'logo'       => __( 'Logo' ),
        'bonus'      => __( 'Bonuses' ),
        'devices'    => __( 'Compatible devices' ),
        'currencies' => __( 'Accepted currencies' ),
        'proscons'   => __( 'Pros & Cons' ),
        'rating'     => __( 'Rating' ),
        'text'       => __( 'Text' ),
        'button'     => __( 'Button' ),
    );
}
