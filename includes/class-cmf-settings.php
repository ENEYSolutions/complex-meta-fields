<?php

namespace ENEYSolutions\CMF {
  
  /**
   * Main class
   */
  class Settings {
    
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
      return self::$instance ? self::$instance : self::$instance = new Settings();
    }
    
    /**
     * 
     */
    public function general_section_description() {
      _e( 'General setting of the plugin', WP_CMF_DOMAIN );
    }
    
    /**
     * 
     */
    public function general_post_types() {
      $setting = get_option( 'cmf-settings' );
      echo '<pre>';
      print_r( $setting );
      echo '</pre>';
      
      if ( empty( $setting ) ) {
        $setting['post_types'] = '';
      }
      
      ?>
        <input type="text" name="cmf-settings[post_types]" value="<?php echo $setting['post_types']; ?>" />
      <?php
    }
  
  }
  
}