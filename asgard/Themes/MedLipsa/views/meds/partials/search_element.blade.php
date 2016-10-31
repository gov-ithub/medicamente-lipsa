<div class="row grey list" id="{{$med->patient->id}}">
	<div class="row">
		<div class="col-md-4">
		<div class="row">
			<div class="col-md-3">
				   <img src="{{ Theme::url('/img/medicament.svg') }}" class="icon-list"><br>{{$med->patient->created_at->format('H:i j.m')}}
			</div>
			<div class="col-md-9 live-entry">

			@if(isset($med))

				<span>{{ $med->name }}</span>
				<span>{{ $med->active_sub }}</span>
				<span>{{ $med->category }}</span> 
				<!--<span>{{ $medPackage[$med->package] }}</span>-->
			@endif
			<div>{{ $med->patient->first_name }} {{ $med->patient->last_name[0] }}.</div>
			</div>

		</div>
		</div>
	<div class="col-md-8">
	@if($med->publicReply)
		@if(trim($med->publicReply->cause) || trim($med->publicReply->action))
			@if(!trim($med->publicReply->action))
			<div class="row">
				<div class="col-md-1">
					<img src="{{ Theme::url('/img/reteta.svg') }}" class="icon-list">
				</div>
				<div class="col-md-5">Răspuns la:<br>{!! $med->publicReply->updated_at->format('H:i j.m') !!}</div>

				<div class="col-md-1">
					<img src="{{ Theme::url('/img/time.svg') }}" class="icon-list">
				</div>
				<div class="col-md-5">
					<script>
						$( document ).ready(function() {
							<?php
								$ziua = $med->patient->created_at->format('j')+7;
								$luna = $med->patient->created_at->format('m')-1;
								$time = $med->patient->created_at->format('Y,').$luna.",".$ziua.$med->patient->created_at->format(',H,i,s');
							?>
							cdown.add(new Date({{$time}}), "m{{ $med->patient->id }}");
						});
					</script>
					<div>Măsura în maxim:</div>
					<p class="timer" id="m{{ $med->patient->id }}"></p> 
				</div>
			</div>
			@endif

			@if(trim($med->publicReply->action))

			<div class="row">
				<div class="col-md-1">
				@if($med->publicReply->deadline)
					<img src="{{ Theme::url('/img/clepsidra.svg') }}" class="icon-list"><br>
				@endif
				</div>
				<div class="col-md-11">
				@if($med->publicReply->deadline)
					<div class="deadline">Termen limita:<br>{{ $med->publicReply->deadline->format('j.M.Y') }}</div>
				@endif
				</div>
			</div>
			<div class="row">
				@if(!$med->publicReply->deadline)
				<div class="col-md-1">
					<img src="{{ Theme::url('/img/rezolvat.svg') }}" class="icon-list"><br>
				</div>
				@endif
				<div class="col-md-11  situatie{{ $med->publicReply->deadline ? ' col-md-offset-1':'' }}">
					<strong>Masura:</strong>
					{!! $med->publicReply->action !!}
					@if(trim($med->publicReply->cause))
						<a id="bsit{{ $med->patient->id }}" class="buton-situatia"> Vezi situatia initiala </a><br>
				   @endif
					<script>
					document.write ('Distribuie aceasta masura <div class="fb-share-button" data-href="'+window.location.href.split('#')[0]+'#{{$med->patient->id}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>');
					</script>

					<div class="hidden" id="sit{{ $med->patient->id }}"><br>
						<strong>Situatia initiala:</strong>
					 {!! $med->publicReply->cause !!}
					</div>
					<script>
						$( document ).ready(function() {
							$("#bsit{{ $med->patient->id }}").click(function() {
								$("#sit{{ $med->patient->id }}").toggleClass("hidden");
								$("#bsit{{ $med->patient->id }}").toggleClass("hidden");
							});
						});
					</script>
				</div>
			</div>
			@else
			<div class="row">
			<div class="col-md-11 col-md-offset-1 situatie">
				<strong>Situatia:</strong>
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
					   <script>
			$( document ).ready(function() {
				<?php
					$luna = $med->patient->created_at->format('m')-1;
					$ziua = $med->patient->created_at->format('j')+4;
					$time = $med->patient->created_at->format('Y,').$luna.",".$ziua.$med->patient->created_at->format(',H,i,s');
					if ($med->patient->created_at->format('N') > 3 && $med->patient->created_at->format('N') <6) {
						$ziua = $med->patient->created_at->format('j')+6;
						$time = $med->patient->created_at->format('Y,').$luna.",".$ziua.$med->patient->created_at->format(',j,H,i,s');

					}
					if ($med->patient->created_at->format('N') == 6) {
						$ziua = $med->patient->created_at->format('j')+6;
						$time = $med->patient->created_at->format('Y,').$luna.",".$ziua.',0,0,0';
					}
					if ($med->patient->created_at->format('N') == 7) {
						$ziua = $med->patient->created_at->format('j')+5;
						$time = $med->patient->created_at->format('Y,').$luna.",".$ziua.',0,0,0';
					}

					//$target = new Date({{$time}});
					//$target = $med->patient->created_at->addWeekdays(2);
					//$luna = $med->patient->created_at->format('m');
					$targetshow = $med->patient->created_at->format('Y,').$luna.$med->patient->created_at->format(',j,H,i,s');
				//echo "console.log('".$med->patient->created_at->format('N')."');";
				?>
				cdown.add(new Date({{$time}}), "d{{ $med->patient->id }}");
			});
		</script>
			<div>Primul raspuns in maxim:</div>
			<p class="timer" id="d{{ $med->patient->id }}"></p> 
				</div>
		</div>
	@endif
	</div>
	</div>
		<div class="row blue spacetop"></div>
</div>