<div ng-controller="cmfMetaBox">
  <ul ng-init='initialize(<?php echo json_encode( !empty( $_ = $metabox['args'] ) ? $_ : array() ) ?>, <?php echo json_encode( !empty( $__ = $data ) ? $__ : array() ) ?>)'>

    <li ng-repeat="fieldset in fieldsets">

      <!-- The list of fields for this metabox -->
      <ul>

        <!-- Field Item. Loads input templates -->
        <li ng-repeat="field in fieldset.options" ng-include="templates_url + 'form/text.php'">

        </li>

      </ul>

    </li>

  </ul>

  <div ng-click="addFieldSet(fieldsets)"> NEW </div>
  
</div>

