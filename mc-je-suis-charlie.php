<?php
/*
Plugin Name: "Je suis Charlie" Ribbon MC
Plugin URI: http://apps.mistralconsulting.com/index.php?fr/je-suis-charlie
Description: When activated, this plugin will put a <em>"Je Suis Charlie"</em> ribbon on a corner of your website. Configure the display with the Settings panel. Show support to <strong>Charlie Hebdo</strong> on your web site !
Author: ComputingFroggy
Author URI: http://mistralconsulting.com
Version: 1.01
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /lang
Text Domain: mc_jesuischarlie  */

 
defined('ABSPATH') or die("No script kiddies please!");

// Plugin definitions
define('MC_JSC_SLUG', 'mc-je-suis-charlie-id');
define('MC_JSC_OPT_NAME', 'mc_jesuischarlieAdminOptions');
define('MC_JSC_ACTION_ACTIVATE', 'activate_mc-je-suis-charlie/mc-je-suis-charlie.php');
define('MC_JSC_LANG_TAG', 'mc_jesuischarlie');
define('MC_JSC_MENU_SLUG', 'mc_jesuischarlie_menu_id');
define('MC_JSC_UPD_SETTINGS', 'update_mc_jesuischarlieSettings');

// Options from the Settings pannel
define('MC_JSC_OPT_LEFT', 'mc_jsc_left');
define('MC_JSC_OPT_URL_CHOICE', 'mc_jsc_url_choice');
define('MC_JSC_OPT_URL', 'mc_jsc_url');

// This plugin declarations
define('MC_JSC_IMG_LEFT', 'mc-je-suis-charlie-left.png');
define('MC_JSC_IMG_RIGHT', 'mc-je-suis-charlie-right.png');
define('MC_JSC_URL_W', 'http://www.charliehebdo.fr');
define('MC_JSC_URL_T', 'http://twitter.com/#jesuischarlie');
define('MC_JSC_URL_A', 'http://jaidecharlie.fr/');

function my_plugin_load_plugin_textdomain() {
    load_plugin_textdomain( MC_JSC_LANG_TAG, FALSE, basename( dirname( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'my_plugin_load_plugin_textdomain' );

if (!class_exists("mc_jesuischarlie")) {

    class mc_jesuischarlie
    {
		var $adminOptionsName = MC_JSC_OPT_NAME;

        /**
         * Constructor
         */
        function mc_jesuischarlie()
        {
            
        }
		function show_ribbon() {
			global $wpdb;
			$theOptions = get_option($this->adminOptionsName);
			if ($theOptions[MC_JSC_OPT_LEFT]=='true') {
				$ribbon = plugins_url(MC_JSC_IMG_LEFT, __FILE__ );
				$posCSS="left:";
			} else {
				$ribbon = plugins_url(MC_JSC_IMG_RIGHT, __FILE__ );
				$posCSS="right:";
			}
			?>
			<style >
				a#MCJeSuisCharlie {
		  background-image: url(<?php echo $ribbon; ?>);
		  width: 130px;
		  height: 130px;
		  position: fixed; top: 0; <?php echo $posCSS; ?> 0; z-index: 100000;
		  }
				a#MCJeSuisCharlie:hover {
		  background-position:-130px 0;
		  }
			</style>
			<a id="MCJeSuisCharlie" alt="Je Suis Charlie" target="_blank"
			<?php
				switch($theOptions[MC_JSC_OPT_URL_CHOICE]) {
					case 'W': echo 'href="'.MC_JSC_URL_W.'"';
					break;
					case 'T': echo 'href="'.MC_JSC_URL_T.'"';
					break;
					case 'A': echo 'href="'.MC_JSC_URL_A.'"';
					break;
					case 'U': echo 'href="'.$theOptions[MC_JSC_OPT_URL].'"';
					break;
				}
			?>
			> </a>
			<?php
		}
		function getAdminOptions() 
		{
			$theOptions = array(
					MC_JSC_OPT_LEFT => 'true',
					MC_JSC_OPT_URL_CHOICE => 'W', // W: Web, T: Twitter, U: Url Type in
					MC_JSC_OPT_URL => 'http://www...'
				);
			$theOptions = get_option($this->adminOptionsName);
			if (!empty($theOptions))
			{
				foreach ($theOptions as $key => $option)
					$theOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $theOptions);
			return $theOptions;
		}
		function init() 
		{
			$this->getAdminOptions();
		}
		function printAdminPage() {
			$options = $this->getAdminOptions();
			if (isset($_POST[MC_JSC_UPD_SETTINGS])) {
				if (isset($_POST[MC_JSC_OPT_LEFT])) {
					$options[MC_JSC_OPT_LEFT] = $_POST[MC_JSC_OPT_LEFT];
				}
				if (isset($_POST[MC_JSC_OPT_URL_CHOICE])) {
					$options[MC_JSC_OPT_URL_CHOICE] = $_POST[MC_JSC_OPT_URL_CHOICE];
				}
				if (isset($_POST[MC_JSC_OPT_URL])) {
					$options[MC_JSC_OPT_URL] = $_POST[MC_JSC_OPT_URL];
				}
				update_option($this->adminOptionsName, $options);
				print '<div class="updated"><p><strong>';
				_e("Settings updated", MC_JSC_LANG_TAG);
				print '</strong></p></div>';
			   
			}
			include('admin_settings.php'); // HTML form include
		}
	}
}
if (class_exists("mc_jesuischarlie"))
{
    $inst_mc_jesuischarlie = new mc_jesuischarlie();
}
if (isset($inst_mc_jesuischarlie))
{
    add_action('wp_footer', array(&$inst_mc_jesuischarlie, 'show_ribbon'), 1);
    add_action(MC_JSC_ACTION_ACTIVATE,  array(&$inst_mc_jesuischarlie, 'init'));
}

// Add command in menu Admin Settings
if (!function_exists("mc_jesuischarlie_menu")) 
{
    function mc_jesuischarlie_menu() {
        global $inst_mc_jesuischarlie;
        if (!isset($inst_mc_jesuischarlie)) {
            return;
        }
        if (function_exists('add_options_page')) 
        {
            add_options_page(__('"Je Suis Charlie" Ribbon MC Options', MC_JSC_LANG_TAG), __('"Je Suis CHARLIE" Ribbon MC', MC_JSC_LANG_TAG), 'manage_options', MC_JSC_MENU_SLUG, array(&$inst_mc_jesuischarlie, 'printAdminPage'));
        }
    }
	add_action('admin_menu', 'mc_jesuischarlie_menu');
}

// Add Settings command to plugin
if (!function_exists('mc_jesuischarlie_action_links')) {
	add_filter( 'plugin_action_links_'.plugin_basename( __FILE__  ), 'mc_jesuischarlie_action_links',  10, 2);
	function mc_jesuischarlie_action_links( $links, $file ) {
		$links[] = '<a href="'.admin_url('options-general.php?page='.MC_JSC_MENU_SLUG).'">' . __('Settings') .'</a>';
		return $links;
	}
}
