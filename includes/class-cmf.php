<?php

namespace ENEYSolutions {
  
  class CMF {
    
    public function __construct() {
      \add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }
    
    public function admin_menu() {
      \add_menu_page( __( 'Complex Meta Fields', WP_CMF_DOMAIN ), __( 'CMF', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf', array( $this, 'ui_root_page' ), plugin_dir_url(''), 100 );
      \add_submenu_page( 'wp_cmf' , __( 'Complex Meta Fields Settings', WP_CMF_DOMAIN ), __( 'Settings', WP_CMF_DOMAIN ), 'manage_options', 'wp_cmf_settings', array( $this, 'ui_settings_page' ));
    }
    
    public function ui_root_page() {
      echo 'Hello';
    }
    
    public function ui_settings_page() {
      echo 'Settings';
    }
  }
}