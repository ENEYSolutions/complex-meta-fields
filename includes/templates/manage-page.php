<?php

//** Public Post Types */
$post_types=get_post_types(array(
   'public'   => true
), 'objects');

?>
<div class="wrap">
  
  <h2><?php _e('Fields Constructor', WP_CMF_DOMAIN); ?></h2>
  
  <hr />
  
  <form action="" method="POST">

    <!-- ng app -->
    <section id="cmf-fields-managed" ng-app="cmfApp">

      <!-- UI cols -->
      <table width="100%">
        <tr valign="top">
          
          <!-- Left col -->
          <td width="70%" ng-controller="cmfWorkspace">
            
            <!-- Col Title -->
            <h2><?php _e( 'Workspace', WP_CMF_DOMAIN ); ?></h2>
            
            <!-- Fields Set List -->
            <ul>
              
              <!-- Fields Set -->
              <li ng-repeat="field in fields">
                
                <!-- Fields Set Name -->
                <h3 ng-click="field.show = !field.show">{{field.name}}</h3>
                
                <div ng-show="field.show">
                
                  <!-- Fields Set Settings -->
                  <div>
                    <select ng-value="field.post_type">
                      <?php foreach ($post_types as $post_type): ?>
                      <option value="<?php echo esc_attr($post_type->name); ?>"><?php echo esc_html($post_type->name); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <!-- Fields Set Options -->
                  <ul>
                    <li ng-repeat="option in field.options">
                      <label>
                        <?php _e('Field Name'); ?>
                        <input type="text" ng-value="option.name" />
                      </label>
                      <label>
                        <?php _e('Field Input'); ?>
                        <select ng-value="option.input">
                          <optgroup label="<?php _e('Common', WP_CMF_DOMAIN); ?>">
                            <option value="text"><?php _e('Text', WP_CMF_DOMAIN); ?></option>
                            <option value="checkbox"><?php _e('Check Box', WP_CMF_DOMAIN); ?></option>
                            <option value="radio"><?php _e('Radio', WP_CMF_DOMAIN); ?></option>
                            <option value="select"><?php _e('Dropdown', WP_CMF_DOMAIN); ?></option>
                          </optgroup>
                        </select>
                      </label>
                    </li>
                  </ul>
                </div>
              </li>
              
            </ul>
          </td>
          
          <!-- Right col -->
          <td>
            <h2><?php _e( 'Elements' ); ?></h2>
          </td>
        </tr>
      </table>

    </section>

  </form>
</div>