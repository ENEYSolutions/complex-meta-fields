<?php

/**
 * Namespace
 */
namespace ENEYSolutions\CMF {
  
  /**
   * AJAX Service
   */
  class MetaBox {
    
    /**
     * Apply Singleton
     */
    use \ENEYSolutions\Singleton;
    
    /**
     * Get fieldsets list
     */
    public function construct() {
      
      $fieldSets = !empty( $_ = get_option( WP_CMF_OPTION ) ) ? $_ : array();
      
      foreach( $fieldSets as $fieldSetKey => $fieldSet ) {
        add_meta_box(
                
          'cmf_metabox_'.$fieldSetKey,

          $fieldSet['name'],

          'myplugin_meta_box_callback',

          $fieldSet['post_type'],

          'advanced',

          'default',

          $fieldSet
		);
      }
      
    }
  }
}