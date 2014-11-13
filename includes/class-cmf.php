<?php

/**
 * My global namespace
 */
namespace ENEYSolutions {
  
  /**
   * Main class
   */
  class CMF {
    
    /**
     * Singleton holder
     * @var CMF
     */
    static $instance = null;
    
    /**
     * Singleton
     * @return CMF
     */
    static public function instance() {
      return self::$instance ? self::$instance : self::$instance = new CMF();
    }
    
    /**
     * Construct
     */
    public function __construct() {
      \add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }
    
    /**
     * Admin menu cb function
     */
    public function admin_menu() {
      \add_menu_page( __( 'Complex Meta Fields Welcome', WP_CMF_DOMAIN ), __( 'CMF', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf', array( $this, 'ui_root_page' ), null, 100 );
      \add_submenu_page( 'wp_cmf' , __( 'Complex Meta Fields', WP_CMF_DOMAIN ), __( 'Manage', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf_manage', array( $this, 'ui_manage_page' ));
      \add_submenu_page( 'wp_cmf' , __( 'Complex Meta Fields Settings', WP_CMF_DOMAIN ), __( 'Settings', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf_settings', array( $this, 'ui_settings_page' ));
    }
    
    /**
     * Welcome page cb
     */
    public function ui_root_page() {
      echo 'Welcome';
    }
    
    /**
     * Manage page cb
     */
    public function ui_manage_page() {
      echo 'manage';
    }
    
    /**
     * Settings page cb
     */
    public function ui_settings_page() {
      echo 'Settings';
    }
  }
}