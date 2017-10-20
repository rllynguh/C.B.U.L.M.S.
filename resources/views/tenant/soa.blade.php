@extends('layouts.tenantLayout')
@section('content')
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Bill Header</th>
			<th>Date</th>
			<th>Description</th>
			<th>Assessment</th>
			<th>Payment</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bill_headers as $header)
			<tr>
				<th>{{$header['header']->code}}</th>
				<th>{{$header['header']->date_collected}}</th>
				<th></th>
				<th>{{$header['header']->cost}}</th>
				<th>{{$header['header']->payment}}</th>
			</tr>
			@foreach($header['detail'] as $detail)
			<tr>
				<th></th>
				<th></th>
				<th>{{$detail->description}}</th>
				<th>{{$detail->price}}</th>
				<th></th>
			</tr>
			@endforeach
			<tr>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection