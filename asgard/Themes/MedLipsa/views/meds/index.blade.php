@extends('layouts.master')

@section('content')

<div class='container'>
<div class="row">
	<div class="col-md-8 col-md-offset-2 center">
		<h1>PENTRU PERSONAL MEDICAL, PACIENȚI ȘI ASOCIAȚII/FUNDAȚII</h1>

		<div class="row">
<!--			<div class="col-md-6">
			<p>Pentru a sesiza lipsa unuia sau mai multor medicamente completați acest formular:</p>
				<a href="{{ route('public.cerere') }}" class="report">Anunță lipsa unui medicament</a>
			</div>-->
			<div class="col-md-6">
			<p>Pentru a sesiza lipsa unuia sau mai multor medicamente completați acest formular:</p>
				{!! Form::open(['route' => ['public.med.cauta'], 'method' => 'post', 'class' => 'search_group', 'role' => 'search']) !!}
				<div class="input-group col-md-10 col-md-offset-1{{ $errors->has('med_name') ? ' has-error' : '' }}">
					<!--<input type="text" class="" placeholder="Search" name="srch-term" id="srch-term">-->
					{!! Form::text("med_name", old("med_name", ''), ['class' => '', 'placeholder' => "Anunță un medicament"]) !!}
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-plus"></i></button>
					</div>
				</div>
				{!! $errors->first('med_name', '<span class="help-block">:message</span>') !!}
				{!! Form::close() !!}
			</div>

			<div class="col-md-6">   
				<p>Verifică stocul de medicamente oncologice la nivelul spitalelor cu structuri in specialitatea oncologie:</p>

				<a href="http://ms.ro/?pag=178&%20id=16278" class="report" target="_blank">Verifică stocul</a>

			</div>
		</div>
		<h1>Pentru fiecare medicament lipsă anunțat, Ministerul Sănătății va pune la dispoziție:</h1>
		<div class="row">
			<div class="col-md-4">
				<img src="{{ Theme::url('img/circle1.png') }}">
				<p>evaluarea situației</p>
				<small>(4 zile lucratoare)</small>
			</div>
			<div class="col-md-4 ">
				<img src="{{ Theme::url('img/circle2.png') }}">
				<p>măsurile pe care autoritățile statului le întreprind pentru rezolvarea situației </p>
			</div>
			<div class="col-md-4">
				<img src="{{ Theme::url('img/circle3.png') }}">
				<p>un sumar al măsurilor întreprinse de autoritățile statului pentru rezolvarea situațiilor notificate</p>
			</div>
		 </div>
	</div>
</div>

<div class="row" id="lista">
	<h2>LISTA DE MEDICAMENTE LIPSĂ ANUNȚATE</h2>
</div>
<div class="row">
	<!--<h1>Caută in anunțuri</h1>-->
	{!! Form::open(['route' => ['meds.search'], 'method' => 'get', 'class' => 'search_form search_group', 'role' => 'search']) !!}
		<div class="input-group col-md-6 col-md-offset-3">
			<!--<input type="text" class="" placeholder="Search" name="srch-term" id="srch-term">-->
			{!! Form::text("q", old("q", (isset($queryString) ? $queryString : '')), ['class' => 'filterinput', 'placeholder' => "Caută în anunțuri"]) !!}
			<div class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
	{!! Form::close() !!}
</div>
<div class="row"><div class="col-md-8 col-md-offset-2 center"><small>Dacă ați pus un anunț și nu se găsește în lista de mai jos vă rugăm să verificați lista de <a href="/neeligibil">anunțuri neeligibile</a>.</small></div></div>
  <div class="row blue spacetop"></div>

<div class="col-md-12" id="ListaAnunturi">
	@include('meds.partials.paged_meds')
</div>
  <div class="row">
	<div class="col-md-8 col-md-offset-2 center">
		
		<a href="{{ route('public.cerere') }}" class="report">Anunță lipsa unui medicament</a>
	</div>
  </div>

<div class="row">
	<div class="col-md-8 col-md-offset-2 center">
		Dacă ai idei de îmbunătățire a accesului la medicamente esențiale, scrie-ne la adresa <strong>ministru@ms.ro</strong><br><br>
	</div>
</div>
</div>
@stop
