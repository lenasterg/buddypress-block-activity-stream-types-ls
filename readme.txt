=== BuddyPress Stop Record those Activity Types ===
Contributors: nuprn1, etivite,lenasterg
Donate link: http://etivite.com/wordpress-plugins/donate/
Tags: buddypress, activity stream, activity, block activity
Requires at least: PHP 5.3, WordPress 3.5.2, BuddyPress 2.0.1
Tested up to: PHP 5.3.x, WordPress 4.0.1, BuddyPress 2.1
Stable tag: 1.0

This plugin will "block" an activity record from being saved to the stream/database. Such as new member registration, joining groups, friendships created.

== Description ==

** IMPORTANT **
This plugin will "block" an activity record from being saved to the stream/database. Such as new member registration, joining groups, friendships created.

Please note, this will not allow an activity record to be saved into the database at all. You will need to know the "type" of activity record. It is advised NOT to block activity_comment and activity_update activities (will cause errors in buddypress)

What are activity types? BP Core includes several and plugins may register their own when hooking into the activity_record functions. This plugin will scan the activity table for distinct types already logged but will be ever changing due to new plugins.

This plugin is based on the plugin BuddyPress Block Activity Stream Types (https://wordpress.org/plugins/buddypress-block-activity-stream-types/) which wasn't compatible with 
BuddyPress 2.x

= Related Links: =

== Installation ==

1. Upload the full directory into your wp-content/plugins directory
2. Activate the plugin at the plugin administration page
3. Adjust settings via the Buddypress Settings admin page, section BuddyPress Block Activity Stream Types

== Frequently Asked Questions ==

= How do I exclude a certain activity types? =

All correct registered activity types are available in BuddyPress Block Activity Stream Types section in Buddypress settings.

= How does it work? =

When bp-core or a plugin attempts to record a new activity - this plugin will block the database insert (by nulling out the type prior to saving - bp_activity_type_before_save )

= I blocked a type but the filter still appears in my theme in the dropdown select box =

Certain types, which are created by plugins, use the actions 'bp_activity_filter_options', 'bp_group_activity_filter_options', 'bp_member_activity_filter_options' in order to plug themself  into the theme files - there is no way to filter these out automatically and may require editing the plugin's core files - remove the action hook.

= I blocked a type but still see the old activity records =

This plugin does not remove previous logged activity items - you'll need to manually delete these, through the Activity administration page.

= I want to unblock a type and see all the old activity records =

Sorry, since you blocked certain types from the database - nothing was ever saved to begin with.


== Changelog ==

= 1.0 =
Initial version for BuddyPress 2.x

== Screenshots ==
1. Buddypress Admin settings page, section BuddyPress Block Activity Stream Types
