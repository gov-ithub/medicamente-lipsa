@foreach($meds as $med)
	@include('meds.partials.search_element') 
@endforeach

<div class="col-md-8 col-md-offset-2 center">
	<a href="{{ route('public.cerere') }}" class="report">Anunță lipsa unui medicament</a>
</div>
