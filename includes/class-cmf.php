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
     * Apply singleton
     */
    use Singleton;
    
    /**
     *
     * @var type 
     */
    private $admin_pages = array();
    
    /**
     * Ajax Service
     * @var type 
     */
    private $ajax;
    
    /**
     * Construct
     */
    public function __construct() {
      
      $this->ajax =    \ENEYSolutions\CMF\AJAX::getInstance();
      $this->metabox = \ENEYSolutions\CMF\MetaBox::getInstance();
      
      //** General actions */
      \add_action( 'admin_menu', array( $this, 'admin_menu' ) );
      \add_action( 'admin_init', array( $this, 'admin_init' ) );
      \add_action( 'admin_enqueue_scripts', array( $this , 'load_assets') );
      \add_action( 'add_meta_boxes', array( $this->metabox, 'construct' ) );
      
      //** AJAX */
      \add_action( 'wp_ajax_cmf_get_fieldsets', array( $this->ajax, 'ajax_get_fieldsets' ) );
    }


    /**
     * Load assets
     */
    function load_assets() {
      global $current_screen;
      
      //** Register Angular JS */
      wp_register_script( 'angular-core', '//ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.js', false, '1.3.3' );
      
      //** Resgister Plugn Script */
      wp_register_script( 'cmf-core', WP_CMF_URL . 'assets/js/complex_meta_fields.js', false, WP_CMF_VERSION );
      
      //** Register Plugin Styles */
      wp_register_style( 'cmf-core', WP_CMF_URL . 'assets/css/complex_meta_fields.css', false, WP_CMF_VERSION );
      
      switch ( $current_screen->id ) {
        
        //** IF manage page */
        case $this->admin_pages['manage']:
          
          wp_enqueue_script( 'angular-core' );
          
          break;
        
        //** For other cases */
        default: break;
      }
      
      wp_enqueue_script( 'cmf-core' );
      wp_enqueue_style( 'cmf-core' );
    }
    
    /**
     * Admin menu cb function
     */
    public function admin_menu() {
      $this->admin_pages['toplevel'] = \add_menu_page( __( 'Complex Meta Fields Welcome', WP_CMF_DOMAIN ), __( 'CMF', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf', array( $this, 'ui_root_page' ), null, 100 );
      $this->admin_pages['manage'] = \add_submenu_page( 'wp_cmf' , __( 'Complex Meta Fields', WP_CMF_DOMAIN ), __( 'Manage', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf_manage', array( $this, 'ui_manage_page' ));
    }
    
    /**
     * Admin Actions
     */
    public function admin_init() {

      if ( !empty( $_POST['cmf-save-fieldsets'] ) ) {
        update_option( WP_CMF_OPTION, !empty( $_POST['fieldsets'] ) ? $_POST['fieldsets'] : array() );
      }
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
  }
}