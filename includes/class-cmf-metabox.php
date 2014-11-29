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
    
    /**
     * 
     * @param type $post_id
     * @return type
     */
    public function save_post($post_id) {

      //** Check if our nonce is set. */
      if (!isset($_POST['cmf-metabox-nonce'])) {
        return $post_id;
      }

      $nonce = $_POST['cmf-metabox-nonce'];

      //** Verify that the nonce is valid. */
      if (!wp_verify_nonce($nonce, 'cmf-metabox')) {
        return $post_id;
      }

      //** If this is an autosave, our form has not been submitted, so we don't want to do anything. */
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
      }

      if (!current_user_can('manage_options')) {
        return $post_id;
      }
      
      if ( $cmf_settings = get_option( WP_CMF_OPTION ) ) {
        if ( !empty( $cmf_settings ) && is_array( $cmf_settings ) ) {
          foreach( $cmf_settings as $fieldset ) {
            delete_post_meta( $post_id, $fieldset['slug'] );
          }
        }
      }

      if ( !empty( $_POST['cmf'] ) ) {
        foreach( $_POST['cmf'] as $meta_key => $meta_value ) {
          update_post_meta($post_id, $meta_key, $meta_value);
        }
      }
    }

    /**
     * 
     * @param type $the_post
     * @param type $metabox
     */
    public function fieldSetMetaBox( $the_post, $metabox ) {
      
      wp_nonce_field( 'cmf-metabox', 'cmf-metabox-nonce' );
    
      $data = get_post_meta( $the_post->ID, $metabox['args']['slug'], 1 );
      
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
              $field['value'] = !empty( $fieldset_data[$field['slug']] ) ? $fieldset_data[$field['slug']] : '';
            }
          }
          
          $return[] = $tmp_object;
        }
        
      }
      
      include WP_CMF_TEMPLATES_PATH . 'metabox.php';
      
    }
  }
}