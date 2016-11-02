<?php
	$errField = str_replace(['[', ']'], ['.', ''], $field['name']);
	$defaultValue = isset($field['value']) ? $field['value'] : '';
?>
<div class='form-group{{ $errors->has($errField) ? ' has-error' : '' }}{{ isset($field['class'])? " ".$field['class'] : ''}}'>
  <div class="col-md-4"> {!! Form::label($field['name'], $field['label']) !!} </div>
   <div class="col-md-8">  {!! Form::text($field['name'], old($field['name'], $defaultValue), ['class' => 'form-control', 'placeholder' => $field['placeholder']]) !!} 
   {!! $errors->first($errField, '<span class="help-block">:message</span>') !!} </div>
</div>