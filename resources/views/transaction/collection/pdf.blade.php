<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<center>
	Collection  {{$payment->code}} <br>
	Collected By  {{$full_name}} <br>
	Date Collected:  {{$payment->date_collected}} <br>

	<table>
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
	Total : PHP {{number_format($summary->cost,2)}} <br>
	Balance : PHP {{number_format($summary->balance,2)}} <br>     
	Amount collected : PHP {{number_format($payment->payment,2)}} <br>
	@if($payment->payment > $summary->balance)
	Change PHP {{number_format($payment->payment - $summary->balance,2)}}
	@endif

	<br>
</center>

