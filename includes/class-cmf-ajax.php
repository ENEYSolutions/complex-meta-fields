<?php

/**
 * Namespace
 */
namespace ENEYSolutions\CMF {
  
  /**
   * AJAX Service
   */
  class AJAX {
    
    /**
     * Apply Singleton
     */
        /**
     * Instance holder
     * @var type 
     */
    protected static $instance;

    /**
     * Singleton innit
     * @return type
     */
    final public static function getInstance() {
      return isset(static::$instance) ? static::$instance : static::$instance = new static;
    }
    
    /**
     * Get fieldsets list
     */
    public function ajax_get_fieldsets() {
      die( json_encode( !empty( $_ = get_option( WP_CMF_OPTION ) ) ? $_ : array() ) );
    }
  }
}