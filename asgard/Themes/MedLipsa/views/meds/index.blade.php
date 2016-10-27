@extends('layouts.master')

@section('content')

<div class='container'>
<div class="row">
    	<div class="col-md-8 col-md-offset-2 center">
        	<h1>PENTRU PERSONAL MEDICAL, PACIENȚI ȘI ASOCIAȚII/FUNDAȚII</h1>
            
            <div class="row">
            	<div class="col-md-6">
                <p>Pentru a sesiza lipsa unuia sau mai multor medicamente completați acest formular:</p>
            		<a href="{{ route('public.cerere') }}" class="report">Anunță lipsa unui medicament</a>
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
@include('meds.partials.lista')    

@stop
