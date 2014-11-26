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
    
//      echo $the_post->ID. ' - ' .$metabox['args']['slug'];
//      echo '<pre>';
//      var_dump( $data = get_post_meta( $the_post->ID, $metabox['args']['slug'], 1 ) );
//      echo '</pre>';
      
      $data = array(
          
        array(
          'tip-informatsii' => 'Простая информация',
          'tekst' => 'Просто текст',
          'mnozhestvennii-vibor' => array(
            array( '1' => 'Один' ),
            array( '2' => 'Два' )
          ),
          'isklyuchayuschii-vibor' => array( '2' => 'Два' ),
          'vipadashka' => array( '3' => 'Три' )
        ),
          
        array(
          'tip-informatsii' => 'Простая информация 2',
          'tekst' => 'Просто текст 2',
          'mnozhestvennii-vibor' => array(
            array( '2' => 'Два' )
          ),
          'isklyuchayuschii-vibor' => array( '1' => 'Один' ),
          'vipadashka' => array( '2' => 'Два' )
        )
          
      );
      
      //** Flush return array */
      $return = array();
      
      //** If there is anything to merge */
      if ( !empty( $data ) ) {
        
        //** Loop data fieldsets */
        foreach( $data as $fieldset_key => $fieldset_data ) {
          
          //** Create initial template */
          $tmp_object = $metabox['args'];
          
          if ( !empty( $tmp_object['options'] ) && is_array( $tmp_object['options'] ) ) {
            foreach( $tmp_object['options'] as $field_key => &$field ) {
              $field['value'] = $fieldset_data[$field['slug']];
            }
          }
          
          $return[] = $tmp_object;
        }
        
      } else {
        $return[] = $metabox['args'];
      }
      
      include WP_CMF_TEMPLATES_PATH . 'metabox.php';
      
    }
  }
}