<?php
/*
  Plugin Name: LS Buddypress Activity plus tabs extension
  PLugin URI: http://lenasterg.wordpress.com/
  Description: Adds tabs in groups for Buddypress activity plus uploaded videos, images, links. Requires Buddypress activity plus plugin (http://wordpress.org/plugins/buddypress-activity-plus/) to by installed.
  Version: 2.4
  Revision Date: September 9, 2013
  Requires at least: WP 3.5.1, BuddyPress 1.7
  Tested up to: WP 3.5.2, BuddyPress 1.7.2
  License:  GNU General Public License 3.0 or newer (GPL) http://www.gnu.org/licenses/gpl.html
  Author: Lena Stergatu
  Author URI: http://lenasterg.wordpress.com)


  /* Only load code that needs BuddyPress to run once BP is loaded and initialized. */

define('LS_BPFB_PLUGIN_SELF_DIRNAME', basename(dirname(__FILE__)), true);
define('LS_BPFB_PROTOCOL', (@$_SERVER["HTTPS"] == 'on' ? 'https://' : 'http://'), true);


//Setup proper paths/URLs and load text domains
if (is_multisite() && defined('WPMU_PLUGIN_URL') && defined('WPMU_PLUGIN_DIR') && file_exists(WPMU_PLUGIN_DIR . '/' . basename(__FILE__))) {
    define('LS_BPFB_PLUGIN_LOCATION', 'mu-plugins', true);
    define('LS_BPFB_PLUGIN_BASE_DIR', WPMU_PLUGIN_DIR, true);
    define('LS_BPFB_PLUGIN_URL', str_replace('http://', LS_BPFB_PROTOCOL, WPMU_PLUGIN_URL), true);
    $textdomain_handler = 'load_muplugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . LS_BPFB_PLUGIN_SELF_DIRNAME . '/' . basename(__FILE__))) {
    define('LS_BPFB_PLUGIN_LOCATION', 'subfolder-plugins', true);
    define('LS_BPFB_PLUGIN_BASE_DIR', WP_PLUGIN_DIR . '/' . LS_BPFB_PLUGIN_SELF_DIRNAME, true);
    define('LS_BPFB_PLUGIN_URL', str_replace('http://', LS_BPFB_PROTOCOL, WP_PLUGIN_URL) . '/' . LS_BPFB_PLUGIN_SELF_DIRNAME, true);
    $textdomain_handler = 'load_plugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . basename(__FILE__))) {
    define('LS_BPFB_PLUGIN_LOCATION', 'plugins', true);
    define('LS_BPFB_PLUGIN_BASE_DIR', WP_PLUGIN_DIR, true);
    define('LS_BPFB_PLUGIN_URL', str_replace('http://', LS_BPFB_PROTOCOL, WP_PLUGIN_URL), true);
    $textdomain_handler = 'load_plugin_textdomain';
} else {
    // No textdomain is loaded because we can't determine the plugin location.
    // No point in trying to add textdomain to string and/or localizing it.
    wp_die(__('There was an issue determining where LS BuddyPress Activity Plus  Tabs plugin is installed. Please reinstall.'));
}

/**
 * @author Stergatu Eleni 
 * @global type $wpdb
 * @return type
 * @version 2, 13/8/2013
 */
function ls_bpfp_tabs_init() {
    global $wpdb;
    if (is_multisite() && BP_ROOT_BLOG != $wpdb->blogid)
        return;
    if (!bp_is_active('groups'))
        return;
    if (!is_buddypress_activity_plus_active())
        return;
    require_once(LS_BPFB_PLUGIN_BASE_DIR . '/ls_bpfb_tabs.php');
}

add_action('bp_include', 'ls_bpfp_tabs_init');

/**
 * @version 2, 27/8/2013, fixed for site_wide installed buddypress-activity-plus
 * @return boolean
 */
function is_buddypress_activity_plus_active() {
    if (in_array('buddypress-activity-plus/bpfb.php', (array) get_option('active_plugins', array()))) {
        return true;
    } else {
        if (array_key_exists('buddypress-activity-plus/bpfb.php', (array) get_site_option('active_sitewide_plugins'))) {
            return true;
        }
    }
    return false;
}