<?php
/**
 * Image field
 */
?>

<label>
  
  <b>{{field.name}}</b><br />
  <span ng-hide="!field.value">Attachment ID: <input ng-init="initImage()" ng-model="field.value" type="text" readonly name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}][{{field.slug}}]" /></span>
  
  <div class="button-secondary" ng-click="selectImage()">Select</div>
  <div class="button-secondary" ng-hide="!field.thumb" ng-click="removeImage()">Remove</div>
  <br />
  <br />
  
  <p ng-hide="field.thumb">Image Preview</p>
  <img ng-src="{{field.thumb}}" ng-hide="!field.thumb" />
  
</label>