<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://about.me/aakifkadiwala
 * @since             1.0.0
 * @package           Tcm
 *
 * @wordpress-plugin
 * Plugin Name:       Tags Cloud Manager
 * Plugin URI:        http://wordpress.org/plugins/tags-cloud-manager
 * Description:       Creating Clouds of taxonomies/tags as per requirements with your design assumptions.
 * Version:           1.0.0
 * Author:            Aakif Kadiwala
 * Author URI:        https://about.me/aakifkadiwala
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tcm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TCM_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tcm-activator.php
 */
function activate_tcm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tcm-activator.php';
	Tcm_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tcm-deactivator.php
 */
function deactivate_tcm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tcm-deactivator.php';
	Tcm_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tcm' );
register_deactivation_hook( __FILE__, 'deactivate_tcm' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tcm.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tcm() {

	$plugin = new Tcm();
	$plugin->run();

}
run_tcm();

function tcm_clouds(){
	include(  plugin_dir_path( __FILE__ )  . 'admin/partials/tcm-admin-display.php' );
}

function tcm_add_new(){
	include(  plugin_dir_path( __FILE__ )  . 'admin/partials/tcm-add-new.php' );
}

function tcm_help(){
  include(  plugin_dir_path( __FILE__ )  . 'admin/partials/tcm-about.php' );
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'tcm_action_links' );

function tcm_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'admin.php?page=tcm_help' ) . '">Help</a>',
 );
return array_merge( $links, $mylinks );
}

