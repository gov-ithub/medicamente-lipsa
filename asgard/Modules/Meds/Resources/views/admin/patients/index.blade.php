@extends('layouts.master')

@section('styles')
<style>
	td span.label {
		display: inline-block;
		min-width: 28px;
		text-align: center;
		padding: 0.3em 0.6em 0.2em;
	}
	
	td ul {
		padding: 0;
	}
	
	td .btn-group {
		display: flex;
	}
</style>
@stop

@section('content-header')
    <h1>
        {{ trans('meds::patients.title.patients') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('meds::patients.title.patients') }}</li>
    </ol>
@stop

@section('content')
<?php
	$statusClass = [
		-1 => 'bg-red',
		0 => 'bg-orange',
		1 => 'bg-green',
		2 => 'bg-orange',
	];
?>
<div class="row">
	<div class="col-xs-12">
<!--		<div class="row">
			<div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
				<a href="{{ route('admin.meds.patient.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
					<i class="fa fa-pencil"></i> {{ trans('meds::patients.button.create patient') }}
				</a>
			</div>
		</div>-->
		<div class="box box-primary">
			<div class="box-header">
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table class="data-table table table-bordered table-hover">
					<thead>
					<tr>
						<th>Id</th>
						<th>Status</th>
						<th style="width: 28%;">Pacient</th>
						<!--<th>Categ.</th>-->
						<th>Medicament</th>
						<th>Adăugat la</th>
						<th style="width: 10%;">Răspunsuri</th>
						<th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
					</tr>
					</thead>
					<tbody>
					<?php if (isset($patients)): ?>
					<?php foreach ($patients as $patient): ?>
					<tr>
						<td>{{ $patient->id }}</td>
						<td>
							<span class="label {{ $statusClass[$patient->status] }}">
								{{ $statuses[$patient->status] }}
							</span>
						</td>
						<td>
							<span class="label bg-blue">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span> &ensp;{{ $patient->first_name }} {{ $patient->last_name }}
							<br>
							<span class="label bg-blue">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span> &ensp;<a href="mailto:{{$patient->email}}">{{$patient->email}}</a>
							@if(trim($patient->phone))
							<br>
							<span class="label bg-blue">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</span> &ensp;<a href="tel:{{$patient->phone}}">{{$patient->phone}}</a>
							@endif
						</td>
						<td>
							{{  isset($patient->med) ? $patient->med->name : "" }}
						</td>
						<td>
							<a href="{{ route('admin.meds.patient.edit', [$patient->id]) }}">{{ $patient->created_at }}</a>
						</td>
						<td>
							<ul>
							@foreach($patient->med->replies as $reply)
								<li class='label label-primary'>{{$reply->user->present()->fullname}}</li>
							@endforeach
							</ul>
						</td>
						<td>
							<div class="btn-group">
								<a href="{{ route('admin.meds.patient.edit', [$patient->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
<!--								<a href="{{ route('admin.meds.patient.edit', [$patient->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-share"></i></a>-->
								<button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.meds.patient.destroy', [$patient->id]) }}" disabled><i class="fa fa-trash"></i></button>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
					<tfoot>
					<tr>
						<th>Id</th>
						<th>Status</th>
						<th>Pacient</th>
						<!--<th>Categ.</th>-->
						<th>Medicament</th>
						<th>Adăugat la</th>
						<th>Răspunsuri</th>
						<th>{{ trans('core::core.table.actions') }}</th>
					</tr>
					</tfoot>
				</table>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('meds::patients.title.create patient') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.meds.patient.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 4, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@stop
