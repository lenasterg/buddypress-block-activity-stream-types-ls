<?php

/*
  Plugin Name: BuddyPress Block Activity Stream Types
  Plugin URI: http://wordpress.org/extend/plugins/buddypress-block-activity-stream-types/
  Description: Blocks an activity record (based on types) from being saved to the database
  Author: rich @etivite
  Author URI: http://etivite.com
  License: GNU GENERAL PUBLIC LICENSE 3.0 http://www.gnu.org/licenses/gpl.txt
  Version: 0.6
  Text Domain: bp-activity-block
  Network: true
 */

/* Only load code that needs BuddyPress to run once BP is loaded and initialized. */

/**
 * load textdomain
 */
function etivite_bp_activity_block_init() {
    require( dirname( __FILE__ ) . '/bp-activity-block.php' );
    if ( file_exists( dirname( __FILE__ ) . '/languages/' . get_locale() . '.mo' ) )
	load_textdomain( 'bp-activity-block', dirname( __FILE__ ) . '/languages/' . get_locale() . '.mo' );
}

add_action( 'bp_include', 'etivite_bp_activity_block_init', 88 );
