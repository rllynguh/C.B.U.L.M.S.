{{-- <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Collection Report</title>
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
		<h1><center><b>List of Collection per Tenant</b></center></h1><br>
		@foreach($tenants as $tenant)
		<center><big>
			{{$tenant->description}}
		</big></center><br><br>
		@foreach($headers as $header)
		@if($tenant->tenant_id==$header->tenant_id)
		<b>Billing header: </b>{{$header->bill_code}} 
		<b>Collection header: </b>{{$header->payment_code}}<br>
		<b>Mode of Payment: </b>{{$header->mode}}
		@if($header->mode=='PDC')
		@foreach($pdcs as $pdc)
		@if($header->payment_id==$pdc->payment_id)
		<b>PDC: </b>{{$pdc->code}}<BR>
		<b>Bank: </b>{{$pdc->description}}<BR>
		@endif
		@endforeach
		@elseif($header->mode=='Fund Transfer')
		@foreach($fund_banks as $fund_bank)
		@if($header->payment_id==$fund_bank->payment_id)
		<b>BANK: </b>{{$fund_bank->description}} <br>
		@endif
		@endforeach
		@endif
		<b>Date Collected: </b>{{$header->date_collected}}
		<b>Collected By: </b>{{$header->name}}<br>
		<b>Amount Due: </b> {{$header->cost}}
		<b>Amount paid : </b>{{$header->total}}<br><br>
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
				<br>
			</tbody>
		</table>
		<br>
		@endif
		@endforeach
		<br>
		Total : {{$tenant->total}}
		<br><br>
		@endforeach
		<center>Total : {{$grandTotal}}</center>
		<br>
		<br>
	</body>
	</html> --}}

	{{$monthSamting}}