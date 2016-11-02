@foreach($patients as $patient)
	@include('meds.partials.med_element', ['med' => $patient->med])
@endforeach
<a href="{{ $patients->nextPageUrl() }}" class="next_page">Vezi mai multe...</a>

