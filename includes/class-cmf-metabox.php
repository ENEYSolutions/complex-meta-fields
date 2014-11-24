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
     * Construct
     */
    public function construct() {
      
      $fieldSets = !empty( $_ = get_option( WP_CMF_OPTION ) ) ? $_ : array();
      
      foreach( $fieldSets as $fieldSetKey => $fieldSet ) {
        add_meta_box(
                
          'cmf_metabox_'.$fieldSetKey,

          $fieldSet['name'],

          array( $this, 'fieldSetMetaBox' ),

          $fieldSet['post_type'],

          'advanced',

          'default',

          $fieldSet
		);
      }
      
    }
    
    public function fieldSetMetaBox( $the_post, $metabox ) {
      
      echo '<pre>';
      print_r(func_get_args() );
      echo '</pre>';
      
      include WP_CMF_TEMPLATES_PATH . 'metabox.php';
      
    }
  }
}