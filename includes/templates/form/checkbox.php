<label>
  {{field.name}}<br />
  <input type="text" ng-model="field.input" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}]" />
</label>