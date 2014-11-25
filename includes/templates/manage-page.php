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
          <td width="70%" ng-controller="cmfWorkspace" ng-init="getFieldSets()">
            
            <!-- Col Title -->
            <h2><?php _e( 'Workspace', WP_CMF_DOMAIN ); ?></h2>
            
            <!-- Fields Set List -->
            <ul class="field-set-list">
      
              <li class="nothing-yet" ng-show="!fieldsets.length && !is_loading">
                <?php _e( 'There are no FieldSets found yet.', WP_CMF_DOMAIN ); ?>
                <a href="javascript:void(0);" ng-click="addFieldSet(fieldsets)"><?php _e( 'Add one!', WP_CMF_DOMAIN ); ?></a>
              </li>
              
              <li class="loading" ng-show="is_loading">
                <img src="<?php echo includes_url( 'images/wpspin.gif' ) ?>" /> <?php _e( 'Loading...', WP_CMF_DOMAIN ) ?>
              </li>
              
              <!-- Fields Set -->
              <li class="field-set-item" ng-repeat="fieldset in fieldsets">
                
                <!-- Fields Set Name -->
                <h3 ng-click="fieldset.show = !fieldset.show">{{fieldset.name}} <small>[{{fieldset.post_type}}]</small></h3>
                
                <!-- Remove Field Set -->
                <input type="button" class="button-secondary remove-field-set" value="<?php _e( 'Delete', WP_CMF_DOMAIN ); ?>" ng-click="removeFieldSet(fieldsets, $index)" />
                
                <div class="clear"></div>
                
                <div class="expandable" ng-show="fieldset.show">
                  
                  <hr />
                  
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                      
                      <!-- Fields Set Settings -->
                      <td width="25%" class="left">

                        <p>
                          <label>
                            <?php _e( 'FieldSet Name', WP_CMF_DOMAIN ); ?><br />
                            <input name="fieldsets[{{$index}}][name]" required type="text" ng-model="fieldset.name" />
                          </label>
                        </p>
                        
                        <p>
                          <label>
                            <?php _e( 'Slug', WP_CMF_DOMAIN ); ?><br />
                            <slug from="fieldset.name" to="fieldset.slug">
                              <input name="fieldsets[{{$index}}][slug]" readonly="" type="text" ng-model="fieldset.slug" />
                            </slug>
                          </label>
                        </p>
                        
                        <p>
                          <label>
                            <?php _e( 'Use for', WP_CMF_DOMAIN ); ?><br />
                            <select name="fieldsets[{{$index}}][post_type]" ng-model="fieldset.post_type">
                              <?php foreach ($post_types as $post_type): ?>
                              <option value="<?php echo esc_attr($post_type->name); ?>"><?php echo esc_html($post_type->label); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </label>
                        </p>
                        
                        <p>
                          <!-- Add Field Button -->
                          <input type="button" class="button-secondary" value="<?php _e( 'Add Field', WP_CMF_DOMAIN ); ?>" ng-click="addField(fieldset.options)" />
                        </p>
                 
                      </td>
                      <td class="right">

                        <!-- Fields Set Options -->
                        <ul>
                          <li class="field-item" ng-repeat="option in fieldset.options">
                            
                            <table width="100%" cellpadding="0" cellspacing="0">
                              <tr valign="top">
                                
                                <td width="45%">
                                  <label>
                                    <?php _e('Field Name'); ?><br />
                                    <input name="fieldsets[{{$parent.$index}}][options][{{$index}}][name]" required type="text" ng-model="option.name" />
                                  </label>
                                  <slug from="option.name" to="option.slug"></slug>
                                  <input name="fieldsets[{{$parent.$index}}][options][{{$index}}][slug]" readonly type="text" ng-model="option.slug" />
                                </td>
                                
                                <td width="45%">
                                  <label>
                                    <?php _e('Field Input'); ?><br />
                                    <select required name="fieldsets[{{$parent.$index}}][options][{{$index}}][input]" ng-model="option.input">
                                      <optgroup label="<?php _e('Common', WP_CMF_DOMAIN); ?>">
                                        <option value="text"><?php _e('Text Line', WP_CMF_DOMAIN); ?></option>
                                        <option value="textarea"><?php _e('Text Area', WP_CMF_DOMAIN); ?></option>
                                        <option value="checkbox"><?php _e('Check Box', WP_CMF_DOMAIN); ?></option>
                                        <option value="radio"><?php _e('Radio', WP_CMF_DOMAIN); ?></option>
                                        <option value="select"><?php _e('Dropdown', WP_CMF_DOMAIN); ?></option>
                                      </optgroup>
                                    </select>
                                  </label>
                                </td>
                                
                                <td valign="top">
                                  <!-- Remove Field Button -->
                                  <input type="button" value="-" ng-show="fieldset.options.length > 1" class="button-secondary remove-field" ng-click="removeField(fieldset.options, $index);" />
                                </td>
                                
                              </tr>
                              
                              <tr valign="top">
                                <td colspan="2">
                                  
                                  <label ng-show="fieldHasValues(option)">
                                    <?php _e('Values', WP_CMF_DOMAIN); ?><br />
                                    <textarea name="fieldsets[{{$parent.$index}}][options][{{$index}}][options]" ng-model="option.options"></textarea>
                                  </label>
                                  
                                </td>
                                <td></td>
                              </tr>
                            </table>

                          </li>
                        </ul>
                        
                      </td>
                    </tr>
                  </table>
                </div>
                
              </li>
              
            </ul>
            
            <!-- Add Fields Set -->
            <input type="button" class="button-secondary" value="<?php _e( 'New FieldSet', WP_CMF_DOMAIN ); ?>" ng-click="addFieldSet(fieldsets)" />
            
            <input name="cmf-save-fieldsets" type="submit" class="button-primary" value="<?php _e( 'Save All', WP_CMF_DOMAIN ) ?>" />
          </td>
          
          <!-- Right col -->
          <td>
            <h2><?php _e( 'Help', WP_CMF_DOMAIN ); ?></h2>
            
            <p><?php _e( 'Hi there! This section allows you to manage your FieldSets and Fields for different Post Types.', WP_CMF_DOMAIN ) ?></p>
            
            <ul>
              <li><a href="javascript:void(0);"><?php _e( 'Why this plugin?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a href="javascript:void(0);"><?php _e( 'What is FieldSet?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a href="javascript:void(0);"><?php _e( 'What is Field?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a href="javascript:void(0);"><?php _e( 'What is Post Type?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a href="javascript:void(0);"><?php _e( 'Front-end API', WP_CMF_DOMAIN ); ?></a></li>
            </ul>
            
            <section>
              <h4><?php _e( 'Why this plugin?', WP_CMF_DOMAIN ); ?></h4>
              <p>You may notice there are a lot of plugins that do almost the same things as this one. But there always is a small difference.</p>
              <p>In current case plugin allows to add REPEATABLE field sets for any Post Type. Meaning you can add any amount of the same field sets to a post or page while editing it.</p>
              <p>Then you can output them in a post loop using built-in API.</p>
            </section>
            
            <section>
              <h4><?php _e( 'What is FieldSet?', WP_CMF_DOMAIN ); ?></h4>
              <p>Because!</p>
            </section>
            
            <section>
              <h4><?php _e( 'What is Field?', WP_CMF_DOMAIN ); ?></h4>
              <p>Because!</p>
            </section>
            
            <section>
              <h4><?php _e( 'What is Post Type?', WP_CMF_DOMAIN ); ?></h4>
              <p>Because!</p>
            </section>
            
            <section>
              <h4><?php _e( 'Front-end API', WP_CMF_DOMAIN ); ?></h4>
              <p>Because!</p>
            </section>
            
          </td>
        </tr>
      </table>

    </section>
  </form>
</div>