@foreach($patients as $patient)
	@include('meds.partials.med_element', ['med' => $patient->med])
@endforeach
<div class="center">
	<!--<div class="cssload-jumping"><i></i><i></i><i></i><i></i><i></i></div>-->
	<a href="{{ $patients->nextPageUrl() }}" class="next_page">Vezi mai multe...</a>
</div>

