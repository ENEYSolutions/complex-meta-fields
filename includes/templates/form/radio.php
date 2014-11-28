<label>
  {{field.name}}
</label>

<ul>
  <li ng-repeat="opt in field.options">
    <label>
      <input type="radio" ng-model="field.value" ng-value="opt.label" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$parent.$index}}][{{field.slug}}]" />
      {{opt.label}}
    </label>
  </li>
</ul>