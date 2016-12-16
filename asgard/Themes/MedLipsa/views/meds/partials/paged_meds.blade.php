@foreach($patients as $patient)
	@include('meds.partials.med_element', ['med' => $patient->med])
@endforeach
<div class="center">
	<div class="col-md-6 col-md-offset-3"><a href="{{ $patients->nextPageUrl() }}" class="report next_page">Vezi mai multe...</a></div>
</div>

