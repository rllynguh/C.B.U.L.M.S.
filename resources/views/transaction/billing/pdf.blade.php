<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>BILLING NOTICE</title>
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
</style>
</head>
<body>
	<center><b>MAJENT MANAGEMENT DEVELOPMENT CORPORATION</b><br>
		<small>TAGUIG CITY<br>
			Leasing Officer<br>
		</small>
		<big>
			{{$billing_header->billing}}
		</big>
		<br>
		<big>
			<i>{{$billing_header->tenant}}</i><br>
			<i>{{$billing_header->representative}}</i><br>
			<i>{{$billing_header->position}}</i><br>
		</big></center><br><br><br>
		<b>{{$billing_header->date_issued}}<br><br><br>
			{{$billing_header->tenant}}</b><br>

			Dear  {{$billing_header->representative}},<br><br>
			Listed below are the details of your billing.
			<br><br>
			<table width="100%">
				<thead>
					<tr>
						<th>Particular</th>
						<th>Cost</th>
					</tr>
				</thead>
				<tbody>
					@foreach($details as $detail)
					<tr>
						<td>{{$detail->description}}</td>
						<td>{{$detail->price}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<br>
			<br>
			<br>
			Total Cost: PHP {{$billing_header->cost}}
			<br>
			<br>
			{{$lessor}}<br>
			Leasing Officer<br>
		</body>
		</html>