BuddyPress Stop Record those Activity Types
=========================================

This plugin will "block" an activity record from being saved to the stream/database. Such as new member registration, joining groups, friendships created.

== Description ==

** IMPORTANT **
This plugin will "block" an activity record from being saved to the stream/database. Such as new member registration, joining groups, friendships created.

Please note, this will not allow an activity record to be saved into the database at all. You will need to know the "type" of activity record. It is advised NOT to block activity_comment and activity_update activities (will cause errors in buddypress)

What are activity types? BP Core includes several and plugins may register their own when hooking into the activity_record functions. This plugin will scan the activity table for distinct types already logged but will be ever changing due to new plugins.

This plugin is based on the plugin BuddyPress Block Activity Stream Types (https://wordpress.org/plugins/buddypress-block-activity-stream-types/) which wasn't compatible with 
BuddyPress 2.x



