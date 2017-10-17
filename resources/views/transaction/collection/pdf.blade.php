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

	<center><b>MAJENT MANAGEMENT DEVELOPMENT CORPORATION<br>
		<small>TAGUIG CITY<br>
			Lessor<br>
		</small>
		<big>
			<i>{{$full_name}}</i><br>
		</big></center>
		<b>Date Generated :</b>{{ $summary->date_issued }}
		<br><br>
		<hr>
		<hr><br>
		<center><b>Collection for {{$summary->tenant}}</b></center><br>
		<center><big>
			{{$summary->tenant}}
		</big></center><br><br>
		<b>Mode of Payment: </b>{{$summary->mode}}<br>
		@if(!is_null($summary->mode_code))
		<b>Code: </b>{{$summary->mode_code}}<br>
		@endif
		@if(!is_null($summary->bank))
		<b>Bank: </b>{{$summary->bank}}<br>
		@endif
		<br><br>
		<table width="100%">
			<tr>
				<th >Description</th>
				<th >Price</th>
			</tr>
			@foreach($billing_details as $billing_detail)
			<tr>
				<td>
					{{$billing_detail->description}}
				</td>
				<td>
					PHP {{number_format($billing_detail->price,2)}}
				</td>
			</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		Total : PHP {{number_format($summary->cost,2)}} <br>
		Balance : PHP {{number_format($summary->balance,2)}} <br>     
		Amount collected : PHP {{number_format($payment->payment,2)}} <br>
		@if($payment->payment > $summary->balance)
		Change PHP {{number_format($payment->payment - $summary->balance,2)}}
		@endif
		<br>
		<br>
		{{$full_name}}<br>
		Leasing Officer<br>
	</body>
	</html>