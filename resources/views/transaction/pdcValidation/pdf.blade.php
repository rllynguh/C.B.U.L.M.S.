<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Reservation Fee Receipt</title>
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
		</big></center><br><br><br>
		{{Carbon\Carbon::now()->toFormattedDateString()}}<br>
		Mr. {{$summary->first_name }} {{$summary->last_name}}</b><br>
		Potential Client<br>
		{{$summary->address}}<br>
		{{$summary->city_province}}<br>
		Dear Mr. {{$summary->last_name}},<br><br>
		Listed below are the units you have reserved.
		<br><br>
		<table width="100%">
			<thead>
				<tr>
					<th>Unit</th>
					<th>Area</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach($units as $unit)
				<tr>
					<td>{{$unit->code}}</td>
					<td>{{$unit->size}}</td>
					<td>{{$unit->price}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<br>
		<br>
		<table width="100%">
			<thead>
				<tr>
					<th>Particular</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Base Rent</td>
					<td>{{$summary->base_rent}}</td>
				</tr>
				<tr>
					<td>+ 12% VAT</td>
					<td>{{$summary->vat}}</td>
				</tr>
				<tr>
					<td>Subtotal</td>
					<td>{{$summary->subtotal}}</td>
				</tr>
				<tr>
					<td>-1 % Expanded Witholding Tax</td>
					<td>{{$summary->ewt}}</td>
				</tr>
				<tr>
					<td>Net Rent</td>
					<td>{{$summary->net_rent}}</td>
				</tr>
			</tbody>
		</table>
		<br>
		Reservation fee(Net Rent *   {{$summary->month}} month(s)): " {{$summary->final}}
		<br>
		<br>
		{{$summary->admin}}<br>
		Leasing Officer<br>
	</body>
	</html>