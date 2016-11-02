@extends('layouts.master')

@section('content')
<div class='container'>

    <div class="row" id="lista">
		<h2>LISTA DE MEDICAMENTE <em>{{$medName}}</em></h2>
    </div>
     <!--<div id="search" class="center"><h1>Caută în anunțuri</h1></div>--> 
<!--     <div class="row"><div class="col-md-6 col-md-offset-3 center"><small>Dacă ați pus un anunț și nu se gasește în lista de mai jos vă rugăm să verificați lista de <a href="/neeligibil">anunțuri neeligibile</a>.</small></div></div>-->
      <div class="row blue spacetop"></div>

	<div class="col-md-12" id="ListaAnunturi">
		@include('meds.partials.search_results')
		<div class="col-md-8 col-md-offset-2 center">
			<a href="{{ route('public.cerere') }}" class="report">Anunță lipsa medicamentului <em>{{$medName}}</em></a>
		</div>
	</div>

</div>
@stop
