<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Summary of Accounts Receivable</title>
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
		<h1><center><b>Summary of Accounts</b></center></h1><br>
		<table class="table" width="100%">
			<thead>
				<tr>
					<th class="no th"></th>
					<th class="th">NAME OF TENANT</th>
					<th class="th">LOCATION</th>
					<th class="th">UNIT</th>
					<th class="th">AREA (SQ.M)</th>
					<th class="th">MONTHLY RENTAL AND CUSA</th>
					<th class="th">OUTSTANDING BALANCE</th>
					<th class="th">NO. OF MOS.</th>
					<th class="th">CURRENT</th>
					<th class="th"><table><tr><th>AMOUNTS STILL OUTSTANDING as Nov. 15, 2016</th></tr></table><table><tr><th class="small-cell">PAST DUE OVER 30 DAYS</th><th class="small-cell">PAST DUE OVER 60 DAYS</th><th class="small-cell">PAST DUE OVER 120 DAYS</th><th class="small-cell">TOTAL DUE</th></tr></table></th>
				</tr>
			</thead>
			<tbody>
				@foreach($contracts as $contract)
				<tr>
					<td class="td">1</td>
					<td class="td">{{$contract->tenant}}</td>
					<td class="td">{{$contract->location}}</td>
					<td class="td">{{$contract->unit_code}}</td>
					<td class="td">{{$contract->unit_size}}</td>
					<td class="td">{{$contract->cost}}</td>
					<td class="td">{{$contract->outstanding_balance}}</td>
					<td class="td"></td>
					<td class="td">{{$contract->current_balance}}</td>
					<td class="td"><table width="100%"><tbody><tr><td class="small-cell">{{$contract->overthirty_balance}}</td><td class="small-cell">{{$contract->overSixty_balance}}</td><td class="small-cell">{{$contract->overonetwenty_balance}}</td><td class="small-cell"></td></tr></tbody></table></td>
				</tr>
				@endforeach
				<tr class="sub">
					<td class="td"></td>
					<td class="td">Sub-total</td>
					<td class="td">N/A</td>
					<td class="td">N/A</td>
					<td class="td">N/A</td>
					<td class="td">{{$summary->cost}}</td>
					<td class="td">{{$summary->outstanding_balance}}</td>
					<td class="td"></td>
					<td class="td">{{$summary->current}}</td>
					<td class="td"><table width="100%"><tbody><tr><td class="small-cell">{{$summary->overthirty}}</td><td class="small-cell">{{$summary->oversixty}}</td><td class="small-cell">{{$summary->overonetwenty}}</td><td class="small-cell">N/A</td></tr></tbody></table></td>
				</tr>
			</tbody>
		</table>
	</body>
	</html>