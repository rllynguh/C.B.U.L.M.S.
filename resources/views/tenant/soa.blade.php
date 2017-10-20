@extends('layouts.tenantLayout')
@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Date</th>
			<th>Assessment</th>
			<th>Payment</th>
			<th>Balance</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bill_headers as $header)
			<tr>
				<th>{{$header->date_collected}}</th>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection