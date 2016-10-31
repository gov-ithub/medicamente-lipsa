<div class="row" id="lista">
	<h2>LISTA DE MEDICAMENTE LIPSĂ ANUNȚATE</h2>
</div>
<div class="center">
	<!--<h1>Caută in anunțuri</h1>-->
	{!! Form::open(['route' => ['meds.search'], 'method' => 'get', 'class' => 'search_form', 'role' => 'search']) !!}
		<div class="input-group">
            <!--<input type="text" class="" placeholder="Search" name="srch-term" id="srch-term">-->
			{!! Form::text("q", old("q", (isset($queryString) ? $queryString : '')), ['class' => 'filterinput form-control', 'placeholder' => "Caută în anunțuri"]) !!}
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
	{!! Form::close() !!}
</div>
<div class="row"><div class="col-md-6 col-md-offset-3 center"><small>Dacă ați pus un anunț și nu se gasește în lista de mai jos vă rugăm să verificați lista de <a href="/neeligibil">anunțuri neeligibile</a>.</small></div></div>
  <div class="row blue spacetop"></div>

<div class="col-md-12" id="ListaAnunturi">
@foreach($patients as $patient)

<div class="row grey list" id="{{$patient->id}}">
	<div class="row">
	<div class="col-md-4">
	<div class="row">
		<div class="col-md-3">
			   <img src="{{ Theme::url('/img/medicament.svg') }}" class="icon-list"><br>{{$patient->created_at->format('H:i j.m')}}
		</div>
		<div class="col-md-9 live-entry">

		@if(isset($patient->med))

			<span>{{ $patient->med->name }}</span>
			<span>{{ $patient->med->active_sub }}</span>
			<span>{{ $patient->med->category }}</span> 
			<!--<span>{{ $medPackage[$patient->med->package] }}</span>-->
		@endif
		<div>{{ $patient->first_name }} {{ $patient->last_name[0] }}.</div>
		</div>

	</div>
	</div>
	<div class="col-md-8">
	@if($patient->med->publicReply)
		@if(trim($patient->med->publicReply->cause) || trim($patient->med->publicReply->action))
			@if(!trim($patient->med->publicReply->action))
			<div class="row">
				<div class="col-md-1">
					<img src="{{ Theme::url('/img/reteta.svg') }}" class="icon-list">
				</div>
				<div class="col-md-5">Răspuns la:<br>{!! $patient->med->publicReply->updated_at->format('H:i j.m') !!}</div>

				<div class="col-md-1"><img src="{{ Theme::url('/img/time.svg') }}" class="icon-list"></div>
				<div class="col-md-5">
					<div>Măsura în maxim:</div>
					<p class="timer" id="m{{ $patient->id }}" data-ts='{{ $patient->med->present()->actionDeadline }}'></p> 
				</div>
			</div>
			@endif

			@if(trim($patient->med->publicReply->action))
			<div class="row">
				<div class="col-md-1">
				@if($patient->med->publicReply->deadline)
					<img src="{{ Theme::url('/img/clepsidra.svg') }}" class="icon-list"><br>
				@endif
				</div>
				<div class="col-md-11">
				@if($patient->med->publicReply->deadline)
					<div class="deadline">Termen limită:<br>{{ $patient->med->publicReply->deadline->format('j.M.Y') }}</div>
				@endif
				</div>
			</div>
			<div class="row">
				@if(!$patient->med->publicReply->deadline)
				<div class="col-md-1">
					<img src="{{ Theme::url('/img/rezolvat.svg') }}" class="icon-list"><br>
				</div>
				@endif
				<div class="col-md-11  situatie{{ $patient->med->publicReply->deadline ? ' col-md-offset-1':'' }}">
					<strong>Măsura:</strong>
					{!! $patient->med->publicReply->action !!}
					@if(trim($patient->med->publicReply->cause))
						<a class="buton-situatia" data-id='{{ $patient->id }}'> Vezi situaţia iniţială</a><br>
				   @endif
					<script>
					document.write ('Distribuie această măsură <div class="fb-share-button" data-href="'+window.location.href.split('#')[0]+'#{{$patient->id}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>');
					</script>

					<div class="hidden sit" data-id='{{ $patient->id }}'><br>
						<strong>Situatia initiala:</strong>
						{!! $patient->med->publicReply->cause !!}
					</div>
				</div>
			</div>
			@else
			<div class="row">
			<div class="col-md-11 col-md-offset-1 situatie">
				<strong>Situatia:</strong>
				{!! $patient->med->publicReply->cause !!}
			</div>
			</div>
			@endif
		@endif
	@else
		<div class="row">
			<div class="col-md-1">
				<img src="{{ Theme::url('/img/time.svg') }}" class="icon-list">
			</div>
			<div class="col-md-5">
				<div>Primul raspuns in maxim:</div>
					<p class="timer" id="d{{ $patient->id }}" data-ts='{{ $patient->med->present()->actionDeadline }}'></p> 
				</div>
		</div>
	@endif
	</div>
	</div>
	<div class="row blue spacetop"></div>
</div>

@endforeach

	<div class="col-md-8 col-md-offset-2 center">
		<a href="{{ route('public.cerere') }}" class="report">Anunță lipsa unui medicament</a>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2 center">
		Dacă ai idei de îmbunătățire a accesului la medicamente esențiale, scrie-ne la adresa <strong>ministru@ms.ro</strong><br><br>
	</div>
</div>
<div class="row"></div>
