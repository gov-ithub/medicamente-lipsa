<div class="row grey list" id="{{$med->patient->id}}">
	<div class="row">
	<div class="col-md-4">
		<div class="row">
			<div class="col-md-3">
				   <img src="{{ Theme::url('/img/medicament.svg') }}" class="icon-list"><br>{{$med->created_at->format('H:i j.m')}}
			</div>
			<div class="col-md-9 live-entry">
			@if(isset($med))
				<span>{{ $med->name }}</span>
				<span>{{ $med->active_sub }}</span>
				<span>{{ $med->category }}</span> 
				{{--<span>{{ $medPackage[$med->package] }}</span>--}}
			@endif
			<div>{{ $med->patient->first_name }} {{ $med->patient->last_name[0] }}.</div>
			</div>

		</div>
	</div>
	<div class="col-md-8 reply">
	@if($med->publicReply)
		@if(trim($med->publicReply->cause) || trim($med->publicReply->action))
			@if(!trim($med->publicReply->action))
			<div class="row">
				<div class="col-md-1">
					<img src="{{ Theme::url('/img/reteta.svg') }}" class="icon-list">
				</div>
				<div class="col-md-5">Răspuns la:<br>{!! $med->publicReply->updated_at->format('H:i j.m') !!}</div>

				<div class="col-md-1"><img src="{{ Theme::url('/img/time.svg') }}" class="icon-list"></div>
				<div class="col-md-5">
					<div>Măsura în maxim:</div>
					<p class="timer" id="m{{ $med->id }}" data-ts='{{ $med->present()->actionDeadline }}'></p> 
				</div>
			</div>
			@endif

			@if(trim($med->publicReply->action))
				@if($med->publicReply->deadline)
				<div class="row">
					<div class="col-md-1">
						<img src="{{ Theme::url('/img/clepsidra.svg') }}" class="icon-list"><br>
					</div>
					<div class="col-md-11">
						<div class="deadline">Termen limită:<br>{{ $med->publicReply->deadline->format('j.M.Y') }}</div>
					</div>
				</div>
				@endif
			<div class="row">
				@if(!$med->publicReply->deadline)
				<div class="col-md-1">
					<img src="{{ Theme::url('/img/rezolvat.svg') }}" class="icon-list"><br>
				</div>
				@endif
				<div class="col-md-11 situatie{{ $med->publicReply->deadline ? ' col-md-offset-1':'' }}">
					<strong>Măsura:</strong>
					{!! $med->publicReply->action !!}
					@if(trim($med->publicReply->cause))
						<a class="buton-situatia" data-id='{{ $med->id }}'> Vezi situaţia iniţială</a><br>
					@endif
					Distribuie această măsură <div class="fb-share-button" data-href="{{url().'#'.$med->patient->id}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php">Share</a></div>

					<div class="hidden sit" data-id='{{ $med->id }}'><br>
						<strong>Situaţia iniţială:</strong>
						{!! $med->publicReply->cause !!}
					</div>
				</div>
			</div>
			@else
			<div class="row">
			<div class="col-md-11 col-md-offset-1 situatie">
				<strong>Situaţia:</strong>
				{!! $med->publicReply->cause !!}
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
				<div>Primul răspuns în maxim:</div>
					<p class="timer" id="d{{ $med->id }}" data-ts='{{ $med->present()->actionDeadline }}'></p> 
				</div>
		</div>
	@endif
	</div>
	</div>
	<div class="row blue spacetop"></div>
</div>
