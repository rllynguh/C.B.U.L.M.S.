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
				PHP {{$billing_detail->price}}
			</td>
		</tr>
		@endforeach
	</table>
	Total : PHP {{$summary->cost}} <br>
	Balance : PHP {{$summary->balance}} <br>     
	Amount collected : PHP {{$payment->payment}} <br>
	@if($payment->payment > $summary->balance)
	Change PHP {{$payment->payment - $summary->balance}}
	@endif

	<br>
</center>

