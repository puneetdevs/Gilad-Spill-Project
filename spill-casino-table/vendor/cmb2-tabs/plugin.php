<?php

namespace cmb2_tabs;

if ( is_admin() ) {
	// run autoloader
	include __DIR__ . '/autoloader.php';

	// connection css and js
	new inc\Assets();

	// run global class
	new inc\CMB2_Tabs();
}