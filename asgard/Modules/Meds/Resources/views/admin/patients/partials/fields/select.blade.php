<?php
	$errField = str_replace(['[', ']'], ['.', ''], $field['name']); 
	$value = isset($field['value']) ? $field['value'] : null;
?>
<div class='form-group{{ $errors->has($errField) ? ' has-error' : '' }}{{ isset($field['class'])? " ".$field['class'] : ''}}'>
   {!! Form::label($field['name'], $field['label']) !!}
   {!! Form::select($field['name'], $field['options'], old($field['name'], $value), ['class' => 'form-control', 'placeholder' => $field['placeholder']]) !!}
   {!! $errors->first($errField, '<span class="help-block">:message</span>') !!}
</div>