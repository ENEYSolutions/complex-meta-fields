<label>
  {{field.name}}<br />
  <textarea ng-model="field.value" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}]"></textarea>
</label>