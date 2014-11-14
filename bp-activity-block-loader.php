<?php
/*
  Plugin Name: BuddyPress Block Activity Stream Types
  Plugin URI: http://wordpress.org/extend/plugins/buddypress-block-activity-stream-types/
  Description: Blocks an activity record (based on types) from being saved to the database
  Author: rich @etivite
  Author URI: http://etivite.com
  License: GNU GENERAL PUBLIC LICENSE 3.0 http://www.gnu.org/licenses/gpl.txt
  Version: 0.5.2
  Text Domain: bp-activity-block
  Network: true
 */

add_action( 'bp_register_admin_settings', 'etivite_bp_activity_block_admin_register_settings', 99 );

function etivite_bp_activity_block_admin_register_settings() {
    // Add the main section
    add_settings_section( 'etivite-bp-activity-block', __( 'BuddyPress Block Activity Stream Types', 'bp-activity-block' ), 'etivite_bp_activity_block_admin_section', 'buddypress' );

    etivite_bp_activity_block_callback_activity_types();
}

function etivite_bp_activity_block_admin_section() {
    ?><span class="description"><?php
    _e( 'Useful for large communities, in order '
	    . 'to reduce the data volume in bp_activity database table. '
	    . 'WARNING: No records of the selected actions will be stored.', 'bp-activity-block' );
    echo '<br/>';
    _e( 'It is advised NOT to block activity_comment and activity_update activities (will cause errors in buddypress)', 'bp-activity-block' );
    ?></span>
        <br/><br/>Disable the recording of following activity types:
	<?php
    }

/**
 * @version 1, stergatu, 13/11/2014
 */
function etivite_bp_activity_block_callback_activity_types() {
    $bp = buddypress();

    /** stergatu, use array ($dont_mess_these_activities) with activity types which the user shouldn't block */
    $dont_mess_these_activities = array( 'last_activity', 'activity_update', 'activity_comment' );
    // Get the actions
    $activity_actions = buddypress()->activity->actions;
    ?>
	<?php foreach ( $activity_actions as $component => $actions ) { ?>
	    <?php
	    foreach ( $actions as $action_key => $action_values ) {
		$field_id = 'bp-disable-' . esc_attr( $action_key );
		// Skip the incorrectly named pre-1.6 action
		if ( 'friends_register_activity_action' !== $action_key ) {
		    if ( ! in_array( esc_attr( $action_key ), $dont_mess_these_activities ) ) {
			add_settings_field( $field_id, __( ucfirst( $component ), 'buddypress' ) . '- ' . esc_html( $action_values['value'] ), 'etivite_bp_activity_block_settings_fields', 'buddypress', 'etivite-bp-activity-block', $field_id );
		    register_setting( 'buddypress', $field_id, 'intval' );
		} else {
			add_settings_field( $field_id, '<del>' . __( ucfirst( $component ), 'buddypress' ) . ' - ' . esc_html( $action_values['value'] ) . '</del>', 'etivite_bp_activity_block_settings_fields_not_available', 'buddypress', 'etivite-bp-activity-block', $field_id );
		    }
		}
	    }
	}
    }

/**
 * Callable for create settings fields
 * @param string $key
 * @param string $value
 * @version 1, stergatu, 13/11/2014
 */
function etivite_bp_activity_block_settings_fields( $key ) {
    ?><input id="<?php echo $key; ?>" name="<?php echo $key; ?>" type="checkbox" value="1"  <?php checked( etivite_bp_activity_block_fields_status( $key, true ) ); ?> />
	<?php
    }

    /**
     *
     * @param type $key
     * @version 1, stergatu, 13/11/2014
     */
    function etivite_bp_activity_block_settings_fields_not_available( $key ) {
	?>
        <input id="<?php echo $key; ?>" name="<?php echo $key; ?>" type="checkbox" value="0" disabled />
            <!--<label class="description"  for="bp-disable-<?php echo $key; ?>"><?php echo esc_html( $action_values['value'] ); ?></label></del><br/>-->
	<?php
    }

    /**
     *
     * @param type $key
     * @param type $default
     * @return type
     * @version 1, stergatu, 13/11/2014
     */
    function etivite_bp_activity_block_fields_status( $key, $default = true ) {
	return ( bool ) apply_filters( $key, ( bool ) bp_get_option( $key, $default ) );
}

function etivite_bp_activity_block_init() {

    if ( file_exists( dirname( __FILE__ ) . '/languages/' . get_locale() . '.mo' ) )
	load_textdomain( 'bp-activity-block', dirname( __FILE__ ) . '/languages/' . get_locale() . '.mo' );
    require( dirname( __FILE__ ) . '/bp-activity-block.php' );

}

add_action( 'bp_include', 'etivite_bp_activity_block_init', 88 );

