<!-- The list of fields for this metabox -->
<ul ng-controller="cmfMetaBox" ng-init='initialize(<?php echo json_encode( !empty( $_ = $metabox['args'] ) ? $_ : array() ) ?>)'>
  
  <!-- Field Item -->
  <li ng-repeat="field in options" ng-include="templates_url + 'form/' + field.input + '.php'">
    
  </li>
</ul>