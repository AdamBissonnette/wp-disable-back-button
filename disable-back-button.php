<?php
/*
Plugin Name: Disable Back Button
Description: Allows you to disable the back button on your WordPress website
Version: 1.0.0
Author: Adam Bissonnette
Author URI: https://www.mediamanifesto.com/
*/
define( 'DBB__OPTIONS', 'dbb' );
define( 'DBB__DOMAIN', 'dbb_plugin' );
define( 'DBB__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DBB__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

class DisableBackButton {
	protected static $class_config 				= array();
	protected $plugin_path						= DBB__PLUGIN_DIR;
	protected $plugin_url						= DBB__PLUGIN_URL;
	protected $plugin_textdomain				= DBB__DOMAIN;
	protected $plugin_options					= DBB__OPTIONS;

	function __construct( $config = array() ) {
		//Cache plugin congif options
		self::$class_config = $config;

		//Set textdomain
		add_action( 'after_setup_theme', array($this, 'plugin_textdomain') );
		
		//Init plugin
		add_action( 'init', array($this, 'init_plugin') );
		add_action( 'admin_init', array($this, 'admin_init_plugin') );

		add_shortcode( "dbb" , array($this, 'dbb_shortcode') );
	}

	public static function plugin_activation() {}
	public function plugin_textdomain() {
		load_plugin_textdomain( $this->plugin_textdomain, FALSE, $this->plugin_path . '/languages/' );		
	}

	public function init_plugin() {
		$options 		= self::$class_config;

		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
	}

	public function admin_init_plugin() {
		
		//Init vars
		$options 		= self::$class_config;
	}

	public function enqueue_scripts() {
		$js_inc_path 	= $this->plugin_url . 'js/';
		
		wp_register_script( 'dbb',
			$js_inc_path . 'dbb.js',
			array(),
			'1.0',
			TRUE
		);

		if (self::$class_config["disable_sitewide"] == 1) {
			self::_disable_back_button();
		}
	}

	public function _disable_back_button()
	{
		if(is_user_logged_in() && self::$class_config["never_disable_for_user"] == 1)
		{
			return "";
		} 

		wp_enqueue_script( 'dbb' );
	}

	function dbb_shortcode($atts, $content=null)
	{
		self::_disable_back_button();
		return "";
	}
}

register_activation_hook( __FILE__, array( 'DisableBackButton', 'plugin_activation' ) );
include('admin/admin-init.php');

dbb_init();
function dbb_init() {

	//Init vars
	global $dbb_options;
	
	//Set plugin config
	$config_options = array(
		'disable_sitewide' => false,
		'never_disable_for_user' => false,
	);
	
	//Cache plugin options array
	$dbb_options = get_option( DBB__OPTIONS );

	if( isset($dbb_options['disable_sitewide']) ) {
		$config_options['disable_sitewide'] =  $dbb_options['disable_sitewide'];
	}

	if( isset($dbb_options['never_disable_for_user']) ) {
		$config_options['never_disable_for_user'] =  $dbb_options['never_disable_for_user'];
	}

	new DisableBackButton( $config_options );
}