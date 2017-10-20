@extends('layouts.tenantLayout')
@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Code</th>
			<th>Date</th>
			<th>Assessment</th>
			<th>Payment</th>
			<th>Balance</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bill_headers as $header)
			<tr>
				<th>{{$header['header']->code}}</th>
				<th>{{$header['header']->date_collected}}</th>
				<th></th>
				<th>{{$header['header']->payment}}</th>
				<th></th>
			</tr>
			@foreach($header['detail'] as $detail)
			@endforeach
		@endforeach
	</tbody>
</table>
@endsection