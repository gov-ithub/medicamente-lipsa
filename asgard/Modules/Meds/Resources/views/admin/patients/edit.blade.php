@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('meds::patients.title.edit patient') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.meds.patient.index') }}">{{ trans('meds::patients.title.patients') }}</a></li>
        <li class="active">{{ trans('meds::patients.title.edit patient') }}</li>
    </ol>
@stop

@section('styles')
<style>
	.panel-group .panel-heading { cursor: pointer; }
	.panel-heading[aria-expanded=true] span.glyphicon:before {
		content:"\e114";
	}

</style>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.meds.patient.update', $patient->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-7">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">DATELE DE CONTACT ALE PACIENTULUI</h3>
			</div>
			<div class="panel-body row">
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'first_name', 'class' => 'col-sm-6',
				'label' => 'Prenume', 'value' => $patient->first_name,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'last_name', 'class' => 'col-sm-6',
				'label' => 'Nume', 'value' => $patient->last_name,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'address', 'class' => 'col-sm-12',
				'label' => 'Adresa completa', 'value' => $patient->address,
				'placeholder' => 'Judetul, Localitatea (codul postal), Str, Nr, Bl, Sc, Et, Ap',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'phone', 'class' => 'col-sm-6',
				'label' => 'Telefon',
				'value' => $patient->phone,
				'placeholder' => '',
			]
		])
		
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'email', 'class' => 'col-sm-6',
				'label' => 'Email',
				'value' => $patient->email,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.select',
			['field' => [
				'name' => 'role', 'class' => 'col-sm-12',
				'label' => 'In ce calitate completati prezentul formular?',
				'placeholder' => '',
				'value' => $patient->role,
				'options' => $patientRoles
			]
		])
				</div>
			</div>				
        </div>
		
		<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">DATELE PERSOANEI DE CONTACT<br><small>pt. cazuri in care pacientul nu poate fi gasit</small></h3>
			</div>
			<div class="panel-body row">
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'contact[first_name]', 'class' => 'col-sm-6',
				'label' => 'Prenume',
				'value' => $patient->contact->first_name,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'contact[last_name]', 'class' => 'col-sm-6',
				'label' => 'Nume',
				'value' => $patient->contact->last_name,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'contact[phone]', 'class' => 'col-sm-12',
				'label' => 'Telefon (de preferinta mobil)',
				'value' => $patient->contact->phone,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'contact[email]', 'class' => 'col-sm-12',
				'label' => 'Email',
				'value' => $patient->contact->email,
				'placeholder' => '',
			]
		])
				</div>
			</div>			
		</div>
		
		<div class="col-md-7">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">MEDICAMENTUL</h3>
			</div>
			<div class="panel-body row">
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[name]', 'class' => 'col-sm-8',
				'label' => 'Denumirea comerciala a medicamentului',
				'value' => $patient->med->name,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[category]', 'class' => 'col-sm-4',
				'label' => 'Categoria medicamentului',
				'value' => $patient->med->category,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[active_sub]', 'class' => 'col-sm-8',
				'label' => 'Substanta activa',
				'value' => $patient->med->active_sub,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[dosage]', 'class' => 'col-sm-4',
				'label' => 'Dozaj substanta activa',
				'value' => $patient->med->dosage,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.select',
			['field' => [
				'name' => 'med[package]', 'class' => 'col-sm-4',
				'label' => 'Forma',
				'value' => $patient->med->package,
				'placeholder' => '',
				'options' => $medPackage
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[qty]', 'class' => 'col-sm-4',
				'label' => 'Necesar',
				'value' => $patient->med->qty,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.select',
			['field' => [
				'name' => 'med[urgent]', 'class' => 'col-sm-4',
				'label' => 'Urgenta',
				'placeholder' => '',
				'value' => $patient->med->urgent,
				'options' => [1 => "Foarte urgent", 2 => "Urgent", 3 => "Nu foarte urgent"]
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[manufacturer]',  'class' => 'col-sm-6',
				'label' => 'Producator',
				'value' => $patient->med->manufacturer,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[country]',  'class' => 'col-sm-6',
				'label' => 'Tara de origine a medicamentului',
				'value' => $patient->med->country,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'med[unavail_at]',  'class' => 'col-sm-12',
				'label' => 'Unde ați încercat deja (fără succes) să dobândiți/procurați medicamentul?',
				'value' => $patient->med->unavail_at,
				'placeholder' => '',
			]
		])
				</div>
			</div>
		</div>
		
		<div class="col-md-5">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">RETETA<br><small>numai in cazul in care este necesara reteta</small></h3>
			</div>
			<div class="panel-body">
		@include('meds::admin.patients.partials.fields.select',
			['field' => [
				'name' => 'recipe[required]',
				'label' => 'Este necesara o reteta pentru eliberarea medicamentului?',
				'placeholder' => '',
				'value' => $patient->recipe->required,
				'options' => [1 => "Da", 2 => "Nu", 3 => "Nu stiu"]
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'recipe[issued_by]',
				'label' => 'Spital / Policlinica / Cabinet medical',
				'value' => $patient->recipe->issued_by,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'recipe[doctor]', 
				'label' => 'Medic',
				'value' => $patient->recipe->doctor,
				'placeholder' => '',
			]
		])
		@include('meds::admin.patients.partials.fields.text',
			['field' => [
				'name' => 'recipe[phone]', 
				'label' => 'Telefon (de preferinta mobil) al medicului curant',
				'value' => $patient->recipe->phone,
				'placeholder' => '',
			]
		])
				</div>
			</div>			
		</div>

		<div class="col-md-7">
		@include('meds::admin.patients.partials.fields.select',
			['field' => [
				'name' => 'status',
				'label' => 'Status anunt',
				'placeholder' => '',
				'value' => $patient->status,
				'options' => $statuses
			]
		])	
		</div>
	
		<!--raspunsuri-->
		<div class="panel-group col-md-12">
		@foreach($patient->med->replies as $reply)
			<?php if($patient->med->myReply) {
				if($reply->id == $patient->med->myReply->id)
					continue; //skip my reply
			} ?>
			<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-target="#collapse{{$reply->id}}">
					<h4 class="panel-title">
						<span class="glyphicon glyphicon-share-alt"></span>
						&nbsp;
						<span class="label bg-blue">
							<!--<i class="fa fa-phone" aria-hidden="true"></i>-->
							{{$reply->user->roles->first()->name}}
						</span>
						&nbsp;
						{{$reply->user->present()->fullname}}
					</h4>
				</div>
				<div id="collapse{{$reply->id}}" class="panel-collapse collapse">
					<div class="panel-body">
						<label>Situaţia</label>
						<p>{!! $reply->cause !!}</p>
						@if(trim($reply->action))
							<hr>
							<label>Măsura</label>
							<p>{!! $reply->action !!}</p>
						@endif
						@if($reply->deadline)
							
							<p><label>Termen:</label> {{ $reply->deadline->toFormattedDateString() }}</p>
						@endif
					</div>
				</div>
			</div>		
		@endforeach
		</div>
		
		<div class="col-md-12">
			<div class="panel panel-warning">
				<div class="panel-heading">Răspuns</div>
				<div class="panel-body">
	<div class='form-group'>
		{!! Form::label("reply[cause]", 'Situaţia') !!}
		<?php $oldCause = isset($patient->med->myReply) ? $patient->med->myReply->cause : ''; ?>	
		<textarea class="ckeditor" name="reply[cause]" rows="8" cols="80">
		{!! old("reply.cause", $oldCause) !!}
		</textarea>
	</div>
			
	<div class='form-group'>
		{!! Form::label("reply[action]", 'Măsura') !!}
		<?php $oldAction = isset($patient->med->myReply) ? $patient->med->myReply->action : ''; ?>	
		<textarea class="ckeditor" name="reply[action]" rows="8" cols="80">
		{!! old("reply.action", $oldAction) !!}
		</textarea>
	</div>
	<div class="form-group">
		<label>Deadline:</label>
		<div class="input-group date">
		  <div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		  </div>
		<?php $oldDeadline = isset($patient->med->myReply) ? ($patient->med->myReply->deadline ? $patient->med->myReply->deadline->format('Y-m-d') : '') : ''; ?>
			{!! Form::text('reply[deadline]', old('reply[deadline]', $oldDeadline), ['class' => 'form-control pull-right', 'data-provide' => "datepicker", 'data-date-format' => "yyyy-mm-dd"]) !!}
		
<!--		  <input name='reply[deadline]' type="text" class="form-control pull-right" data-provide="datepicker" data-date-format="yyyy/mm/dd">-->
		</div>
	  </div>
					@if($currentUser->hasRoleName('Admin'))
					<div class="checkbox form-group">
                        <input type="hidden" name="reply[is_public]" value="0">
                        <label for="reply[is_public]">
                            <input id="reply[is_public]"
                                   name="reply[is_public]"
                                   type="checkbox"
                                   class="flat-blue"
		{{ isset($patient->med->myReply) ? ($patient->med->myReply->is_public ? 'checked' : '') : '' }}
                                   value="1" />
                            Publicat
                        </label>
                    </div>
					@endif
				</div>
			</div>			
		</div>	
    </div>
	
		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
<!--			<button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>-->
			<a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.meds.patient.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
		</div>
	
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.meds.patient.index') ?>" }
                ]
            });
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@stop
