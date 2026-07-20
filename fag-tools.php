<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.logicallytech.com
 * @since             1.0.0
 * @package           Fag_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       FAG Tools
 * Plugin URI:        https://www.logicallytech.com
 * Description:       Find a Grave Tools for Genealogists
 * Version:           1.0.0
 * Author:            Amy McGarity
 * Author URI:        https://www.logicallytech.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fag-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FAG_TOOLS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fag-tools-activator.php
 */
function activate_fag_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fag-tools-activator.php';
	Fag_Tools_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fag-tools-deactivator.php
 */
function deactivate_fag_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fag-tools-deactivator.php';
	Fag_Tools_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fag_tools' );
register_deactivation_hook( __FILE__, 'deactivate_fag_tools' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fag-tools.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fag_tools() {

	$plugin = new Fag_Tools();
	$plugin->run();

}
run_fag_tools();
