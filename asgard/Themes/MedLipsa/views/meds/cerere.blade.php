@extends('layouts.master')

@section('content')
<script>
	$( document ).ready(function() {
    	$( "#pasul1" ).click(function() {
 		 	$("#pagina-2").removeClass("hidden");
			$("#pasul1").addClass("hidden");
			$("html, body").animate({ scrollTop: $("#pagina-2").offset().top }, 600);
		});
		$( "#persoana-contact" ).click(function() {
 		 	$("#pagina-persoana").removeClass("hidden");
			$("#persoana-contact").addClass("hidden");
			//$(document).scrollTop( $("#pagina-persoana").offset().top );
			 $("html, body").animate({ scrollTop: $("#pagina-persoana").offset().top }, 600);
		});
		$( "#pasul2" ).click(function() {
 		 	$("#pagina-3").removeClass("hidden");
			$("#pasul2").addClass("hidden");
			$("html, body").animate({ scrollTop: $("#pagina-3").offset().top }, 600);
		});
	});
</script>
	
<div class="container">
	<div class="row">
    <div class="col-md-12">
    	<h1>Anunța un medicament indisponibil in România</h1>
        <hr>
        </div>
    </div>
	{!! Form::open(['route' => ['public.cerere.post'], 'method' => 'post']) !!}
	<div class="row">
		<div class="col-md-4">
				
            <div class="row">
                <div class="col-xs-2">
                    <img src="{{ Theme::url('/img/medicament.svg') }}" class="icon-form">
                </div>
                <div class="col-xs-10">
                     <h3>MEDICAMENTUL LIPSĂ</h3>
                </div>
            </div>
			<div class="panel-body">
		@include('partials.fields.text',
			['field' => [
				'name' => 'med[category]', 'class'=>'row',
				'label' => 'Categorie*',
				'placeholder' => 'ex: oncologie, cardiologie, etc.',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'med[name]', 'class'=>'row',
				'label' => 'Denumire comercială*',
				'placeholder' => '',
				'value' => Session::pull('med_name', ''),
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'med[active_sub]', 'class'=>'row',
				'label' => 'Substanța activă*',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'med[dosage]', 'class'=>'row',
				'label' => 'Dozaj*',
				'placeholder' => 'substanta activa (50 mg, 50 ml, 50 g, 50 U.I.)',
			]
		])
		@include('partials.fields.select',
			['field' => [
				'name' => 'med[package]', 'class'=>'row',
				'label' => 'Forma*',
				'placeholder' => '',
				'options' => $medPackage
			]
		])
		@include('partials.fields.text', 
			['field' => [
				'name' => 'med[qty]','class'=>'row',
				'label' => 'Necesar*',
				'placeholder' => 'ex: 2 folii, 20 comprimate, 10 fiole',
			]
		])
		
		@include('partials.fields.text', 
			['field' => [
				'name' => 'med[manufacturer]', 'class'=>'row',
				'label' => 'Producător*',
				'placeholder' => '',
			]
		])
		
		
				</div>
                 <a id="pasul1" class="buton-pas {{ count($errors->all()) ? "hidden" : "" }}">PASUL URMĂTOR</a>
                 
			</div>
        <div id="pagina-2"  class="col-md-4 {{ count($errors->all()) ? "" : "hidden" }}">
        <div class="row">
                <div class="col-xs-2">
                    <img src="{{ Theme::url('/img/reteta.svg') }}" class="icon-form">
                </div>
                <div class="col-xs-10">
                     <h3>CONTEXT</h3>
                </div>
            </div>
				
			<div class="panel-body">
		@include('partials.fields.select',
			['field' => [
				'name' => 'recipe[required]', 'class'=>'row',
				'label' => 'Aveți rețetă?*',
				'placeholder' => '',
				'options' => [1 => "Da", 2 => "Nu" /*, 3 => "Nu stiu"*/]
			]
		])
		@include('partials.fields.text', 
			['field' => [
				'name' => 'recipe[issued_by]', 'class'=>'row',
				'label' => 'Nume unitate',
				'placeholder' => 'ex: Nume spital, policlinica, cabinet medical',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'recipe[doctor]', 'class'=>'row',
				'label' => 'Medic',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'recipe[phone]',  'class'=>'row',
				'label' => 'Telefonul medicului curant',
				'placeholder' => '(de preferinta mobil)',
			]
		])
        @include('partials.fields.text', 
			['field' => [
				'name' => 'med[unavail_at]', 'class'=>'row',
				'label' => 'Unde ați cautat',
				'placeholder' => 'ex: Nume spital, farmacie',
			]
		])
		
				</div>
		
		<a id="pasul2" class="buton-pas  {{ count($errors->all()) ? "hidden" : "" }}">Pasul urmator</a>
			</div>  
        <div id="pagina-3" class="col-md-4 {{ count($errors->all()) ? "" : "hidden" }}">
			<div class="row">
                <div class="col-xs-2">
                    <img src="{{ Theme::url('/img/date-contact.svg') }}" class="icon-form">
                </div>
                <div class="col-xs-10">
                     <h3>DATELE DE CONTACT ALE PACIENTULUI</h3>
                </div>
            </div>
			
		<div class="panel-body">
		@include('partials.fields.text',
			['field' => [
				'name' => 'first_name', 'class' => 'row',
				'label' => 'Prenume*',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'last_name', 'class' => 'row',
				'label' => 'Nume*',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'address', 'class' => 'row',
				'label' => 'Judetul*',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'phone', 'class' => 'row',
				'label' => 'Telefon*',
				'placeholder' => '',
			]
		])
		
		@include('partials.fields.text',
			['field' => [
				'name' => 'email', 'class' => 'row',
				'label' => 'Email*',
				'placeholder' => '',
			]
		])
		@include('partials.fields.select',
			['field' => [
				'name' => 'role','class' => 'row',
				'label' => 'Ce calitate aveți*',
				'placeholder' => '',
				'options' => $patientRoles
			]
		])
				</div>
                <a id="persoana-contact" class="buton-adauga">+ ADAUGĂ O PERSOANĂ DE CONTACT</a><br>
                <div id="pagina-persoana" class="panel panel-default hidden">
			<div class="panel-heading">
				<h3 class="panel-title">DATELE DE CONTACT ALE UNEI PERSOANE DE CONTACT<br><small>pt. cazuri in care dumneavoastra nu puteti fi gasit</small></h3>
			</div>
			<div class="panel-body">
		@include('partials.fields.text',
			['field' => [
				'name' => 'contact[first_name]','class'=>'row',
				'label' => 'Prenume',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'contact[last_name]','class'=>'row',
				'label' => 'Nume',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'contact[phone]','class'=>'row',
				'label' => 'Telefon (de preferinta mobil)',
				'placeholder' => '',
			]
		])
		@include('partials.fields.text',
			['field' => [
				'name' => 'contact[email]','class'=>'row',
				'label' => 'Email',
				'placeholder' => '',
			]
		])
				</div>
			</div>
            <div class='check form-group{{ $errors->has('allow_contact') ? ' has-error' : '' }}'>
        	{!! Form::checkbox('allow_contact', '1', old('allow_contact', false)) !!}
			{!! Form::label('allow_contact', 'Sunt de acord sa fiu contactat cand s-a gasit o solutie.') !!}
		
			{!! $errors->first('allow_contact', '<span class="help-block">:message</span>') !!}
		</div>
		<div class='check form-group{{ $errors->has('allow_publish') ? ' has-error' : '' }}'>
			{!! Form::checkbox('allow_publish', '1', old('allow_publish', false)) !!}
            {!! Form::label('allow_publish', 'Sunt de acord ca anuntul meu sa fie facut public (nu vor fi facute publice datele de contact)') !!}
			
			{!! $errors->first('allow_publish', '<span class="help-block">:message</span>') !!}
		</div>
			<div class='form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}'>
                {!! Recaptcha::render() !!}
			{!! $errors->first('g-recaptcha-response', '<span class="help-block">:message</span>') !!}
			</div>
               <button type="submit" class="buton-pas">TRIMITEȚI</button>
			</div>
		
		
		
		

		
		
		
	</div>
	{!! Form::close() !!}
<div class="row"><div class="col-md-12"><hr> Câmpurile marcate cu * sunt obligatorii </div></div>	
</div>

@stop
