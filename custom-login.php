<?php

/**
 *
 * @link              http://squibble-fish.com
 * @since             0.0.1
 * @package           A Custom Login
 *
 * @wordpress-plugin
 * Plugin Name:       A Custom Login
 * Plugin URI:        http://squibble-fish.com
 * Description:       A custom login. Horray!
 * Version:           0.0.1
 * Author:            Stephen Fisher
 * Author URI:        http://squibble-fish.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       a-custom-login
 * Domain Path:       /languages
 */


namespace wp\login;

/**
 * some quick Sec
 */
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

/**
 * 
 */
function activate() {
    require_once plugin_dir_path( __FILE__ ) . 'inc/class-activate.php';
    Activator::activate();
}


/**
 * 
 */
function deactivate() {
    require_once plugin_dir_path( __FILE__ ) . 'inc/class-deactivate.php';
    Deactivator::deactivate();
}

/**
 * heavy lifter
 */
require_once plugin_dir_path( __FILE__ ) . "inc/class-custom-login.php";


register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );

/**
 * This plugin name exists in WordPress repo.
 * Collisions suck
 *
 * @param $r
 * @param $url
 * @return mixed
 */
function dm_prevent_update_check( $r, $url ) {
    if ( 0 === strpos( $url, 'http://api.wordpress.org/plugins/update-check/' ) ) {
        $my_plugin = plugin_basename( __FILE__ );
        $plugins = unserialize( $r['body']['plugins'] );
        unset( $plugins->plugins[$my_plugin] );
        unset( $plugins->active[array_search( $my_plugin, $plugins->active )] );
        $r['body']['plugins'] = serialize( $plugins );
    }
    return $r;
}
add_filter( 'http_request_args', 'dm_prevent_update_check', 10, 2 );

/**
 *
 */
function run_my_plugin() {
    $plugin = new CustomLogin();
    $plugin->init();
}

run_my_plugin();