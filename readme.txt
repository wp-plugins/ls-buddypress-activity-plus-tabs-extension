=== LS Buddypress Activity plus tabs extension ===
Contributors: lenasterg, NTS on cti.gr
Tags: Buddypress, group, activity, tabs, extension
Requires at least: 3.4 and BP 1.6
Tested up to: 4.1.1 and BP 2.1.1
Stable tag: 2.9.1
License:  GNU General Public License 3.0 or newer (GPL)
License URI: http://www.gnu.org/licenses/gpl.html

Adds tabs in groups for Buddypress activity plus uploaded videos, images, links

== Description ==
Adds tabs in groups for Buddypress activity plus uploaded videos, images, links. Requires Buddypress activity plus plugin (http://wordpress.org/plugins/buddypress-activity-plus/) to by installed.


== Installation ==
1. Upload plugin folder `/LS-buddypress-activity-plus-tabs/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
1. How can I hide a tab?
Answer: On ls_bpfb_tabs.php:
- For hiding the Links tab,     comment the line 106  the bp_register_group_extension('BP_activity_plus_links_tab_Extension');
- For hiding the videos tab, comment the line 205  bp_register_group_extension('BP_activity_plus_videos_tab_Extension');
- For hiding the Images tab,    comment the line 304  bp_register_group_extension('BP_activity_plus_images_tab_Extension'


== Screenshots ==

1. New tabs (Links, Videos, Images) in group navigation bar

== Changelog ==
= 2.9.1 (17 April 2015) =
* Fix a typo which prevented the image tab to show up.

= 2.9 (6 April 2015) =
* Add widget for current group

= 2.8 (17.11.2014) =
 * "Add new" buttons added

= 2.7 (22.10.2013) =
 * Fix for not Buddypress ready themes

= 2.6 (22.10.2013) =
 * Fix some notices

= 2.5 (16.10.2013) =
 * Improved  syntax for lighter mysql queries

= 2.4 (9.9.2013) =
*Fix a typo
* Added FAQ how to hide a tab

= 2.3 (5.9.2013) =
* Fix a bug which broke the RSS feeds

= 2.2 (13.8.2013) =
* Fix a bug which occured when checking if buddypress activity plugin active


= 2.1 (9.8.2013) =
* Remove parentheses from items count

= 2.0 (2.8.2013) =
* Change visibility of tabs to private
* Fix a bug which displayed the tabs on the create group steps

= 1.0 (30.7.2013) =
* Initial version 