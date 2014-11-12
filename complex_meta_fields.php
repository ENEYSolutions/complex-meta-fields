<?php
/**
 * Plugin Name: Complex Meta Fields
 * Plugin URI:  http://eney.solutions/complex-meta-fields
 * Description: Manage complex meta data for any post type.
 * Version:     0.1.0
 * Author:      Anton Korotkov
 * Author URI:  http://eney.solutions
 * License:     GPLv2+
 * Text Domain: wp_cmf
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Anton Korotkov (email : anton@eney-solutions.com.ua)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */

// Useful global constants
define( 'WP_CMF_VERSION', '0.1.0' );
define( 'WP_CMF_URL',     plugin_dir_url( __FILE__ ) );
define( 'WP_CMF_PATH',    dirname( __FILE__ ) . '/' );

/**
 * Default initialization for the plugin:
 * - Registers the default textdomain.
 */
function wp_cmf_init() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'wp_cmf' );
	load_textdomain( 'wp_cmf', WP_LANG_DIR . '/wp_cmf/wp_cmf-' . $locale . '.mo' );
	load_plugin_textdomain( 'wp_cmf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Activate the plugin
 */
function wp_cmf_activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	wp_cmf_init();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wp_cmf_activate' );

/**
 * Deactivate the plugin
 * Uninstall routines should be in uninstall.php
 */
function wp_cmf_deactivate() {

}
register_deactivation_hook( __FILE__, 'wp_cmf_deactivate' );

// Wireup actions
add_action( 'init', 'wp_cmf_init' );

// Wireup filters

// Wireup shortcodes
