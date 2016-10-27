
<script type="text/javascript">
//###################################################################
// Author: ricocheting.com
// Version: v3.0
// Date: 2014-09-05
// Description: displays the amount of time until the "dateFuture" entered below.

var CDown = function() {
	this.state=0;// if initialized
	this.counts=[];// array holding countdown date objects and id to print to {d:new Date(2013,11,18,18,54,36), id:"countbox1"}
	this.interval=null;// setInterval object
}

CDown.prototype = {
	init: function(){
		this.state=1;
		var self=this;
		this.interval=window.setInterval(function(){self.tick();}, 1000);
	},
	add: function(date,id){
		this.counts.push({d:date,id:id});
		this.tick();
		if(this.state==0) this.init();
	},
	expire: function(idxs){
		for(var x in idxs) { 
			this.display(this.counts[idxs[x]], "Timpul a expirat!");
			this.counts.splice(idxs[x], 1);
		}
	},
	format: function(r){
		var out="";
		if(r.d != 0){out += r.d +""+((r.d==1)?"z":"z")+":";}
		if(r.h != 0){out += r.h+":";}
		out += ((r.m<10)?"0":"")+r.m+":";
		out += ((r.s<10)?"0":"")+r.s;

		return out;
	},
	math: function(work){
		var	y=w=d=h=m=s=ms=0;

		ms=(""+((work%1000)+1000)).substr(1,3);
		work=Math.floor(work/1000);//kill the "milliseconds" so just secs

		y=Math.floor(work/31536000);//years (no leapyear support)
		w=Math.floor(work/604800);//weeks
		d=Math.floor(work/86400);//days
		work=work%86400;

		h=Math.floor(work/3600);//hours
		work=work%3600;

		m=Math.floor(work/60);//minutes
		work=work%60;

		s=Math.floor(work);//seconds

		return {y:y,w:w,d:d,h:h,m:m,s:s,ms:ms};
	},
	tick: function(){
		var now=(new Date()).getTime(),
			expired=[],cnt=0,amount=0;
		
		if(this.counts)
		for(var idx=0,n=this.counts.length; idx<n; ++idx){
			cnt=this.counts[idx];
			amount=cnt.d.getTime()-now;//calc milliseconds between dates

			// if time is already past
			if(amount<0){
				expired.push(idx);
			}
			// date is still good
			else{
				this.display(cnt, this.format(this.math(amount)));
			}
		}

		// deal with any expired
		if(expired.length>0) this.expire(expired);

		// if no active counts, stop updating
		if(this.counts.length==0) window.clearTimeout(this.interval);
		
	},
	display: function(cnt,msg){
		document.getElementById(cnt.id).innerHTML=msg;
	}
};
	var cdown = new CDown();

</script>   

<script>
	(function ($) {
	  jQuery.expr[':'].Contains = function(a,i,m){
		  return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	  };
 
  function filterList(header, list) {
    var form = $("<form>").attr({"class":"filterform","action":"#"}),
        input = $("<input>").attr({"class":"filterinput","type":"text"});
    $(form).append(input).appendTo(header);
 
    $(input)
      .change( function () {
        var filter = $(this).val();
        if(filter) {
 
          $matches = $(list).find('div:Contains(' + filter + ')').parent();
          $('.list', list).not($matches).slideUp();
          $matches.slideDown();
 
        } else {
          $(list).find(".list").slideDown();
        }
        return false;
      })
    .keyup( function () {
        $(this).change();
    });
  }
 
  $(function () {
    filterList($("#search"), $("#ListaAnunturi"));
  });
}(jQuery));

	</script>
   
    <div class="row" id="lista">
    	<h2>LISTA DE MEDICAMENTE LIPSĂ ANUNȚATE</h2>
    </div>
     <div id="search" class="center"><h1>Caută in anunțuri</h1></div> 
     <div class="row"><div class="col-md-6 col-md-offset-3 center"><small>Dacă ați pus un anunț și nu se gasește în lista de mai jos vă rugăm să verificați lista de <a href="/neeligibil">anunțuri neeligibile</a>.</small></div></div>
      <div class="row blue spacetop"></div>
{{-- <div class="row header-live">
    	<div class="col-xs-4">
        <h3>ANUNȚUL</h3>
        </div>
        <div class="col-xs-4">
        <h3>CARE ESTE SITUAȚIA</h3>
        </div>
        <div class="col-xs-4">
        <h3>MĂSURA</h3>
        </div>
    </div> --}}
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
                     
                    <div class="col-md-1">
            	   		<img src="{{ Theme::url('/img/time.svg') }}" class="icon-list">
           			</div>
                    <div class="col-md-5">
						<script>
							$( document ).ready(function() {
								<?php
									$ziua = $patient->created_at->format('j')+7;
									$luna = $patient->created_at->format('m')-1;
									$time = $patient->created_at->format('Y,').$luna.",".$ziua.$patient->created_at->format(',H,i,s');
								?>
								cdown.add(new Date({{$time}}), "m{{ $patient->id }}");
							});
						</script>
						<div>Măsura în maxim:</div>
						<p class="timer" id="m{{ $patient->id }}"></p> 
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
						<div class="deadline">Termen limita:<br>{{ $patient->med->publicReply->deadline->format('j.M.Y') }}</div>
					@endif
					</div>
				</div>
				<div class="row">
                	@if(!$patient->med->publicReply->deadline)
                	<div class="col-md-1">
                    	<img src="{{ Theme::url('/img/rezolvat.svg') }}" class="icon-list"><br>
                    </div>
                	<div class="col-md-11 situatie">
                    @else 
                    <div class="col-md-11 col-md-offset-1 situatie">
                    @endif
                    	<strong>Masura:</strong>
                        {!! $patient->med->publicReply->action !!}
						@if(trim($patient->med->publicReply->cause))
							<a id="bsit{{ $patient->id }}" class="buton-situatia"> Vezi situatia initiala </a><br>
                       @endif
                        <script>
						document.write ('Distribuie aceasta masura <div class="fb-share-button" data-href="'+window.location.href.split('#')[0]+'#{{$patient->id}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>');
						</script>
                       
                        <div class="hidden" id="sit{{ $patient->id }}"><br>
                        	<strong>Situatia initiala:</strong>
                         {!! $patient->med->publicReply->cause !!}
                        </div>
                        <script>
                        	$( document ).ready(function() {
								$("#bsit{{ $patient->id }}").click(function() {
									$("#sit{{ $patient->id }}").toggleClass("hidden");
									$("#bsit{{ $patient->id }}").toggleClass("hidden");
								});
							});
                        </script>
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
                           <script>
				$( document ).ready(function() {
					<?php
						$luna = $patient->created_at->format('m')-1;
						$ziua = $patient->created_at->format('j')+4;
						$time = $patient->created_at->format('Y,').$luna.",".$ziua.$patient->created_at->format(',H,i,s');
						if ($patient->created_at->format('N') > 3 && $patient->created_at->format('N') <6) {
							$ziua = $patient->created_at->format('j')+6;
							$time = $patient->created_at->format('Y,').$luna.",".$ziua.$patient->created_at->format(',j,H,i,s');
						
						}
						if ($patient->created_at->format('N') == 6) {
							$ziua = $patient->created_at->format('j')+6;
							$time = $patient->created_at->format('Y,').$luna.",".$ziua.',0,0,0';
						}
						if ($patient->created_at->format('N') == 7) {
							$ziua = $patient->created_at->format('j')+5;
							$time = $patient->created_at->format('Y,').$luna.",".$ziua.',0,0,0';
						}
						
						//$target = new Date({{$time}});
						//$target = $patient->created_at->addWeekdays(2);
						//$luna = $patient->created_at->format('m');
						$targetshow = $patient->created_at->format('Y,').$luna.$patient->created_at->format(',j,H,i,s');
					//echo "console.log('".$patient->created_at->format('N')."');";
					?>
					cdown.add(new Date({{$time}}), "d{{ $patient->id }}");
				});
            </script>
            	<div>Primul raspuns in maxim:</div>
            	<p class="timer" id="d{{ $patient->id }}"></p> 
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
    <div class="row">
    </div>
</div>