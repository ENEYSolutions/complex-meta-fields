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
    use \ENEYSolutions\Singleton;
    
    /**
     * Get fieldsets list
     */
    public function ajax_get_fieldsets() {
      die( json_encode( get_option( WP_CMF_OPTION ) ) );
    }
  }
}