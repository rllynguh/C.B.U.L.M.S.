<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
Contract  {{$contract->code}} <br>
Lessor  {{$contract->full_name}} <br>
Start of Contract:  {{$contract->start_of_contract}} <br>
End of Contract:  {{$contract->end_of_contract}} <br>
<table>
	<tr>
		<th >Unit</th>
		<th >Price</th>
	</tr>
	@foreach($units as $unit)
	<tr>
		<td>
			{{$unit->code}}
		</td>
		<td>
			{{$unit->price}}
		</td>
	</tr>
	@endforeach
</table>

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
			{{$billing_detail->price}}
		</td>
	</tr>
	@endforeach
</table>
