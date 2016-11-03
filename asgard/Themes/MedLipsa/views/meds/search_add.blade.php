@extends('layouts.master')

@section('content')
<div class='container'>

    <div class="row" id="lista">
		<h2>Anunțuri existente <em><strong>{{$medName}}</strong></em></h2>
    </div>
    <div class="row">
    	<div class="class-md-6 center">
        	Pentru acest medicament am gasit deja anunțurile de mai jos
        </div>
    </div>
     <!--<div id="search" class="center"><h1>Caută în anunțuri</h1></div>--> 
<!--     <div class="row"><div class="col-md-6 col-md-offset-3 center"><small>Dacă ați pus un anunț și nu se gasește în lista de mai jos vă rugăm să verificați lista de <a href="/neeligibil">anunțuri neeligibile</a>.</small></div></div>-->
    <div class="row blue spacetop"></div>
	
        <div class="col-md-12" id="ListaAnunturi">
            @include('meds.partials.search_results')
            
        </div>
   
    
    <div class="row">
    	<div class="col-md-6 col-md-offset-3 center">
        	Dacă niciunul din anunturile de mai sus nu este medicamentul cătuat de tine, apasă pe butonul de mai jos. 
        </div>
    </div>
    <div class="row spacetop">
    </div>
   <div class="row">
            <div class="col-md-6  col-md-offset-3 center search_group">
                <a href="{{ route('public.cerere') }}" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Anunță lipsa medicamentului <strong>{{$medName}}</strong></a>
            </div>
   </div>
    <div class="row spacetop">
    </div>
		
</div>
@stop
