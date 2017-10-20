<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Summary of Occupancy</title>
	<style type="text/css">
	.table {
		border-collapse: collapse;
	}
	.table, .th, .td {
		border: 1px solid black;
		padding: 5px;
	}
	.tr:nth-child(even) {background-color: #f2f2f2}
	.th {
		background-color: #FEFECC;
		color: black;
	}
	img {
		height: 20px;
		width: 20px;
	}
	th {
		font-size: 10px;
		text-align: center;
	}
	.col {
		width: 30px;
	}
	.no {
		width: 10px;
	}
	.small-cell {
		width: 30px;
	}
	.sub {
		background-color: #D9D9D9;
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
		<h1><center><b>Summary of Occupancy</b></center></h1><br>
		<table class="table" width="100%">
			<thead>
				<tr>
					<th class="no th"></th>
					<th class="th">ACTIVE</th>
					<th class="th">RENEWAL</th>
					<th class="th">UNDER NEGOTIATION</th>
					<th class="th">VACANT</th>
					<th class="th">OTHERS</th>
					<th class="th">TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cities as $city)
				<tr>
					<td class="td">{{$city->description}}</td>
					<td class="td">{{$city->active}}</td>
					<td class="td"></td>
					<td class="td">{{$city->undernego}}</td>
					<td class="td">{{$city->vacant}}</td>
					<td class="td"></td>
					<td class="td">{{$city->total}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</body>
	</html>