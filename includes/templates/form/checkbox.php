<label>
  {{field.name}}
</label>

<ul>
  <li ng-repeat="opt in field.options">
    <label>
      <input type="checkbox" ng-checked="field.value[opt.key]" value="{{opt.label}}" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$parent.$index}}][{{field.slug}}][{{opt.key}}]" />
      {{opt.label}}
    </label>
  </li>
</ul>