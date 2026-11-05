<?php

// CPT TAXONOMY

include( 'configure/cpt-taxonomy.php' );

// Utilities

include( 'configure/utilities.php' );

// CONFIG

include( 'configure/configure.php' );

// EDITOR

include( 'configure/editor.php' );

// JAVASCRIPT & CSS

include( 'configure/js-css.php' );

// SHORTCODES

include( 'configure/shortcodes.php' );

// ACF

include( 'configure/acf.php' );

// PLUGIN SETUP

include( 'configure/plugins.php' );

// HOOKS ADMIN

if(is_admin()) {
	include( 'configure/admin.php' );
}
