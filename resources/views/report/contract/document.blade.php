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
		<h1><center><b>Contract Report</b></center></h1><br>
		@foreach($headers as $header)
		{{$header->tenant}}
		<center><big>
		</big></center>
		<b>Contract header: </b>{{$header->code}}<br>
		<b>Contract Starting Date: </b>{{$header->start_of_contract}}<br>
		<b>End of Contract: </b>{{$header->end_of_contract}}<br>
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
		@endforeach
		<br><br>
		<br>
		<br>
	</body>
	</html>