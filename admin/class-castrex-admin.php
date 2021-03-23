<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.openalo.io
 * @since      1.0.0
 *
 * @package    Castrex
 * @subpackage Castrex/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Castrex
 * @subpackage Castrex/admin
 * @author     openalo <mail@openalo.io>
 */
class Castrex_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * 
	 */
	private function plugin_menu( $page_title, $menu_title, $capability, $menu_slug, $icon_url, $position, $function = '' )
	{
		/** */
		add_menu_page( __( $page_title, CA_DOMAIN ), __( $menu_title, CA_DOMAIN ), $capability, $menu_slug, $function, $icon_url, $position );
	}

	/**
	 * 
	 */
	private function plugin_submenu( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position)
	{
		/** */
		add_submenu_page( $parent_slug, __( $page_title, CA_DOMAIN ), __( $menu_title, CA_DOMAIN ), $capability, $menu_slug, $function , $position );
	}

	/**
	 * 
	 * 
	 */
	private function plugin_menu_view( $param )
	{
		/** */
		switch ( $param ) :
			case $param:
				require_once plugin_dir_path( __FILE__ ) . 'partials/castrex-' . strtolower( $param ) . '-view.php';
				break;
			default:
				break;
		endswitch;
	}

	/**
	 * 
	 */
	private function castrex_admin_menu()
	{
		/** */
		$this->plugin_menu( ucfirst( $this->plugin_name ) . ' Admin Dashboard', ucfirst( $this->plugin_name ), 'manage_options', 'ca-' . strtolower( $this->plugin_name ), 'dashicons-format-audio', 3 );

		/** */
		$this->plugin_submenu( 'ca-' . strtolower( $this->plugin_name ), ucfirst( $this->plugin_name ) . ' Admin Dashboard', 'Dashboard', 'manage_options', 'ca-' . strtolower($this->plugin_name), function(){ $this->plugin_menu_view( 'Dashboard' );}, 0 );

		/** */
		$this->plugin_submenu( 'ca-' . strtolower( $this->plugin_name ), ucfirst( $this->plugin_name ) . ' Go live', 'Go live', 'manage_options', 'ca-' . strtolower($this->plugin_name) . '-go-live', function(){ $this->plugin_menu_view( 'Go-live' );}, 1 );

		/** */
		$this->plugin_submenu( 'tools.php', ucfirst( $this->plugin_name ) . ' Tools', ucfirst( $this->plugin_name ), 'manage_options', 'ca-' . strtolower( $this->plugin_name ) . '-tools', function(){ $this->plugin_menu_view( 'Tools' );}, 1 );
		
		/** */
		$this->plugin_submenu( 'options-general.php', ucfirst( $this->plugin_name ) . ' Settings', ucfirst( $this->plugin_name ), 'manage_options', 'ca-' . strtolower( $this->plugin_name ) . '-settings', function(){ $this->plugin_menu_view( 'Settings' );}, 5 );
	}

	/** 
	 * 
	 * 
	*/
	private function castrex_admin_bar_menu( $wp_admin_bar )
	{
		/** */
		$prop = array( 
			'id' => strtolower( $this->plugin_name ), 
			'title' => '<span class="ab-icon"></span><span class="screen-reader-text">' . __( ucfirst( $this->plugin_name ) ) . '</span>', 
			'href' => '', 
			'meta' => array( 
				'title' => ucfirst( $this->plugin_name ) . ' Tools'
			)
		);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function castrex_enqueue_styles( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Castrex_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Castrex_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( strpos( $hook, strtolower( 'ca-' . $this->plugin_name ) ) !== false ) :
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/castrex-admin.css', array(), $this->version, 'all' );
		endif;

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function castrex_enqueue_scripts( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Castrex_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Castrex_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( strpos( $hook, strtolower( 'ca-' . $this->plugin_name ) ) !== false ) :
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/castrex-admin.js', array( 'jquery' ), $this->version, false );
		endif;

	}

	/** */
	public function castrex_register_menu()
	{
		/** */
		$this->castrex_admin_menu();
	}

	/** */
	public function castrex_register_wp_admin_bar_menu( $wp_admin_bar )
	{
		$this->castrex_admin_bar_menu( $wp_admin_bar );
	}

	/** */
	public function castrex_register_styles( $hook )
	{
		/** */
		$this->castrex_enqueue_styles( $hook );
	}
	
	/** */
	public function castrex_register_scripts( $hook )
	{
		/** */
		$this->castrex_enqueue_scripts( $hook );
	}
}