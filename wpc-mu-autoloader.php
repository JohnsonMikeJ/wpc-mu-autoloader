<?php
/*
 * WP Complete Must-Use Plugin Autoloader
 *
 * @package     wpc-mu-autoloader
 * @author      Johnson, Mike J.
 * @copyright   2017 Mike J Johnson.
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: WPComplete Must-Use Plugin Autoloader
 * Plugin URI:  https://github.com/JohnsonMikeJ/wpc-mu-autoloader/
 * Description: Automatically loads all WPComplete Must-Use plugins that are installed.
 * Version:     0.1.0
 * Author:      JohnsonMikej
 * Author URI:  https://profiles.wordpress.org/johnsonmikej
 * Text Domain: wpc-mu-autoloader
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Cache will be cleared after visiting the plugin's page as well if a previously detected mu-plugin was removed.
 *
*/

// fly fly away little script kiddies
defined( 'ABSPATH' ) || die( '-1' );

#echo plugin_basename( __FILE__ ); exit;

$wpc_mu_plugin_dir = WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'wpc-mu-autoloader';
$wpc_mu_plugin_file = $wpc_mu_plugin_dir . DIRECTORY_SEPARATOR . 'autoloader.php';

if( is_readable( $wpc_mu_plugin_file ) ) {
    require_once $wpc_mu_plugin_file;
}
else
{
    add_action('admin_notices', function() use ($wpc_mu_plugin_file) {
        ?>
        <div class="error">
            <p>
                <strong>WPComplete Plugin Loader has missing dependencies.</strong>
                <code><?php echo substr($wpc_mu_plugin_file, strlen(ABSPATH)) ?></code> is missing.<br />
                Try running <code>composer install</code> or reinstall package manually.
            </p>
        </div>
        <?php
    });
}

unset( $wpc_mu_plugin_dir, $wpc_mu_plugin_file );

