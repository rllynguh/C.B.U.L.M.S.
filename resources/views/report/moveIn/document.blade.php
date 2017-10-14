<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Move In Report</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
	}
	table, th, td {
		border: 1px solid black;
		padding: 5px;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
	th {
		background-color: #FCEC78;
		color: black;
	}
	img {
		height: 20px;
		width: 20px;
	}
	.col {
		width: 30px;
	}
</style>
</head>
<body>
	<center><b>MAJENT<br>
		<small>TAGUIG CITY<br>
			Lessor<br>
		</small>
		<big>
			<i>{{Auth::user()->first_name }} {{Auth::user()->last_name }}</i><br>
		</big></center>
		<b>Date Generated :</b>{{ $pdf_details['today']->format('F d, Y') }}
		<br><br>
		<hr>
		<hr><br>
		<h1><center><b>List of Move In's per Tenant</b></center></h1><br>
		@foreach($tenants as $tenant)
		<center><big>
			{{$tenant->description}}
		</big></center>
		@foreach($headers as $header)
		@if($tenant->tenant_id==$header->tenant_id)
		<b>Move in header: </b>{{$header->code}}<br>
		<b>Date Moved in: </b>{{$header->date_moved_in}}<br>
		<b>Remarks: </b>{{$header->remarks}}<br>
		<table width="100%">
			<thead>
				<tr>
					<th class="col">BUILDING</th>
					<th class='col'>UNIT</th>
					<th class="col">UNIT TYPE</th>
					<th class="col">FLOOR</th>
					<th class="col">SIZE</th>

				</tr>
			</thead>
			<tbody>
				@foreach($details as $detail)
				@if($header->header_id==$detail->header_id)
				<tr>
					<td>{{$detail->building}}</td>
					<td>{{$detail->code}}</td>
					<td>{{$detail->type}}</td>
					<td>{{$detail->number}}</td>
					<td>{{$detail->size}}</td>
				</tr>
				@endif
				@endforeach
				<br>
			</tbody>
		</table>
		@endif
		@endforeach
		<br><br>
		@endforeach
		<br>
		<br>
	</body>
	</html>