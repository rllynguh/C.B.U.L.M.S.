<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Billing Report</title>
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

		<b>Date Generated :</b>{{ Carbon\Carbon::today()->toFormattedDateString()  }}
		<br><br>
		<hr>
		<hr><br>
		<h1><center><b>Billing per Tenant</b></center></h1><br>
		@foreach($tenants as $tenant)
		<center><big>
			{{$tenant->description}}<br><br>
		</big></center>
		@foreach($headers as $header)
		@if($tenant->tenant_id==$header->tenant_id)
		<b>Billing Header: </b>{{$header->code}}
		<b>Date: </b>{{$header->date_issued}}<br>
		<b>Amount Paid: </b>{{$header->payment}}<br>
		<table width="100%">
			<thead>
				<tr>
					<th class="col">PARTICULAR</th>
					<th class='col'>COST</th>

				</tr>
			</thead>
			<tbody>
				@foreach($details as $detail)
				@if($header->header_id==$detail->header_id)
				<tr>
					<td>{{$detail->description}}</td>
					<td>{{$detail->price}}</td>
				</tr>
				@endif
				@endforeach
			</tbody>
			<tr>
				<td>Total Amount Due</td>
				<td>{{$header->cost}}</td>
			</tr>
		</table>
		<br>
		@endif
		@endforeach
		<br>
		<b>Total Amount due: </b>{{$tenant->cost}} <b>Total Payment: </b> {{$tenant->payment}}<br><br>
		@endforeach
		<br><br><br><br>
		<center>
			<big><b>Total Amount Due: </b>{{$summary->cost}}</big>
			<big><b>Total Payment: </b>{{$summary->payment}}</big>

		</center>
	</body>
	</html>