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
    
    public $settings;
    
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
      
      $this->settings = CMF\Settings::instance();
      
      \add_action( 'admin_menu', array( $this, 'admin_menu' ) );
      \add_action( 'admin_init', array( $this, 'admin_init' ) );
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
     * 
     */
    public function admin_init() {
      
      register_setting(
        'cmf-settings', 
        'cmf-settings'
      );

      add_settings_section(
        'cmf-setting-section', 
        'General', 
        array( $this->settings, 'general_section_description' ), 
        'cmf-settings-general'
      );

      add_settings_field(
        'eg_setting_post_types', 
        'Activate for', 
        array( $this->settings, 'general_post_types' ), 
        'cmf-settings-general', 
        'cmf-setting-section'
      );
    }

    /**
     * Welcome page cb
     */
    public function ui_root_page() {
      include WP_CMF_TEMPLATES_PATH . 'root-page.php';
    }
    
    /**
     * Manage page cb
     */
    public function ui_manage_page() {
      include WP_CMF_TEMPLATES_PATH . 'manage-page.php';
    }
    
    /**
     * Settings page cb
     */
    public function ui_settings_page() {
      include WP_CMF_TEMPLATES_PATH . 'settings-page.php';
    }
  }
}