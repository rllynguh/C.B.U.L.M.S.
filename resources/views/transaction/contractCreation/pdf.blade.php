<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<html>

<center><b>CONTRACT OF LEASE</b></center>
<b>KNOW ALL MEN BY THESE PRESENTS:</b><br><br>

This Contract of Lease, executed and entered into this<br>
{{$contract->day}}day of {{$contract->month}} , in the <br>City of  Taguig , Philippines, by and between: <br> <br><br>


MAJENT, a corporation duly organized and established under the Philippine laws <br> and with principal address at<br> Taguig, Philippines, represented herein by its Authorized Representative<br>/ {{$contract->lessor}}, hereinafter referred to as the <b>“LESSOR”</b>; <br><br>

<center>and<center> <br><center>

	{{$contract->tenant}}, a sole-proprietorship/ corporation with principal address at {{$contract->address}}, <br> represented herein by its {{$contract->position}},{{$contract->lessee}}, hereinafter referred to as the <br><b>“LESSEE.”</b> <br><br><br>


	<b>W I T N E S S E T H :</b> <br><br>
	<b>WHEREAS</b>, the LESSOR is the owner of the
	<?php
	$building_array=array();
	?>
	@foreach($units as $key=> $unit)
	@if(!in_array($unit->building_id,$building_array))
	<?php
	array_push($building_array, $unit->building_id);
	?>
	@if($key>0)
	,<br><br>
	@endif
	{{$unit->building}}, a commercial building <br>
	located at the {{$unit->address}}
	@endif
	@endforeach
	, hereinafter referred to <br>as the leased premises; <br><br><br>

	<b>WHEREAS</b>, the LESSEE desires to lease <b>Unit</b>

	@foreach($units as $key=> $unit)
	@if($key>0)
	,
	@endif
	{{$unit->code}}
	@endforeach
	with an area of <br>
	{{$contract->size}} <b>square meters</b> of the above-described property and the LESSOR <br>
	agreed to lease the same to the LESSEE subject to the <br>following terms and conditions: <br><br><br>

	<b>NOW, THEREFORE</b>, the LESSOR and the LESSEE agree as follows: <br><br>

	1.	<b>USE OF THE LEASED PREMISES.</b><br><br>

	1.1.	The leased premises shall be used exclusively by the LESSEE for  as <br>
	a {{$contract->business}} business purposes only and the LESSEE is hereby prohibited<br> 
	to use said premises for any other purpose/s without the prior written <br>
	consent of the LESSOR. <br><br>


	2.	<b>PERIOD OF LEASE</b>.<br>

	2.1.	The term of the lease shall be for a period of {{$request->txtDuration}} years commencing on {{$contract->start_of_contract}}  <b>to</b> {{$contract->end_of_contract}} , renewable and <br>
	subject to negotiation as tothe terms and conditions of the lease.  <br><br>

	2.2.	To exercise this option to renew, the LESSEE must give the LESSOR <br>a written notice of intention to do so at least six (6) months before the <br>
	term of the lease expires.<br><br>

	2.3.	In case of an approved renewal, the LESSEE shall issue such <br>
	number of post-dated checks (PDC) as may be required by the LESSOR <br>
	as rental payment for the approved renewed period of lease, on a date <br>
	specified on the Notice of Approval of Renewal of lease.<br><br>


	3.	<b>RESERVATION FEE</b>.<br>
	The LESSEE upon receipt of the Notice of Award from the LESSOR confirming<br>
	its rights to lease the premises and its acceptance thereto over the leased<br>
	premises shall pay the RESERVATION FEE in the <br>amount of PESOS<br>:
	{{$contract->res_fee}}, which shall be valid for<br>
	thirty <b>(30) days</b> and shall be non-refundable. In the event that the lease proceeds, the Reservation Fee <br>shall be applied to/deducted from the Security Deposit due. <br>
	<br>

	4.	NET MONTHLY RENT.<br>
	<br><br>
	4.1.	The NET Rent per month for Year 1 of the Lease Term {{$contract->start_of_contract}} <br>to {{$contract->end_of_contract}}) is PESOS: {{number_format($request->net_rent,2)}} <br> inclusive of 12% Value Added Tax and less Withholding Tax, computed as follows:<br>

	<table>
		<tr>
			<th >Year 1</th>
			<th >Monthly Rent</th>
		</tr>
		<tr>
			<td>
				Base Rent
			</td>
			<td>
				{{$contract->total}}
			</td>
		</tr>
		<tr>
			<td>
				Add: 12% VAT
			</td>
			<td>
				{{$contract->vat}}
			</td>
		</tr>
		<tr>
			<td>
				Sub-Total
			</td>
			<td>
				{{$contract->subtotal}}
			</td>
		</tr>
		<tr>
			<td>
				<td>Less: % EWT</td>
			</td>
			<td>
				{{$contract->ewt}}
			</td>
		</tr>
		<tr>
			<td><b>Net Rent</b></td>
			<td>
				{{$contract->final}}
			</td>
		</tr>
	</table>



	The LESSEE shall issue TWELVE (12) post-dated checks (PDC) in the amount of the NET Rent indicated <br>above to cover the monthly rental payments for Year 1 (February 1, 2017 to January 31, 2018) of the <br>Lease Term.  The PDCs for Year 1 are due upon execution of the Contract of Lease.<br><br>

	4.2.	The NET Rent per month for the succeeding years of the Lease Term are indicated in the Table of Rent:<br><br><br><br>





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
				{{number_format($unit->price,2)}}
			</td>
		</tr>
		@endforeach
	</table>
	4.3	The Schedule of Issuance of Post-Dated Checks are as follows:<br>
	YEAR 1	12 PDCs		Due upon execution of Contract of Lease. The checks should be dated on the 16th<br> of each month <br> <br>
	4.3.	This rental payment shall be payable at the principal office of the LESSOR, without the<br> necessity of demand, reminder or the services of a collector.  A one (1%) percent surcharge per day, <br>computed from the date payment becomes due until full payment has been made, shall be charged in case<br> of delay in the payment of rentals. Should any portion of the rentals be unpaid for over 60 days, the<br> LESSOR has the right to terminate this contract. <br><br>


	5.	ADVANCE RENT.<br><br>

	5.1	The LESSEE agrees to pay the LESSOR upon signing of this contract a dated check in the sum <br>equivalent to PESOS: PHP {{number_format($request->advance_rent,2)}} , representing three <br>(3) months’ rent as ADVANCE RENT, which shall be applied to the last three (3) months of the lease <br>term. <br><br>

	5.2	In case of pre-termination, the Advance Rent referred to in the preceding paragraph shall be <br>forfeited in favor of the LESSOR and shall be treated as liquidated damages.<br><br>


	6.	SECURITY DEPOSIT.

	6.1.	 The LESSEE agrees to issue the LESSOR upon signing of this contract a dated check in the sum<br> equivalent to PESOS: PHP {{number_format($request->security_deposit,2)}}, representing three (3) months’ base rent of <br>the first year of lease as SECURITY DEPOSIT for the performance of LESSEE’s obligations under this <br>lease contract. <br><br>

	6.2.	The SECURITY DEPOSIT shall serve as security deposit for damage to the leased premises, <br>unpaid bills for public utilities, unpaid rents and other fees due that might be due the LESSOR or <br>any public utility. It shall be returned to the LESSEE without interest, and less whatever expenses<br> chargeable against it within sixty (60) days from expiration or termination of the lease. In case the <br>amount of security deposit is insufficient, the LESSEE shall remain liable for such unpaid amount <br>plus interest.<br><br>

	6.3.	The SECURITY DEPOSIT previously paid shall remain intact and shall be increased appropriately<br> and correspondingly to the annual increase.<br><br><br>


	7.	COMMON AREA CHARGES (CUSA).<br><br>

	The LESSEE shall pay the LESSOR a monthly charge of PESOS:  {{$utilities->cusa_rate}} per square meter <br>multiplied by the total floor area leasable, plus VAT, less {{$utilities->ewt_rate}}% EWT or a total of PESOS:  PHP {{number_format($request->cusa,2)}} per month upon the effectivity of this contract for the<br> common area expenses on security, maintenance, insurance of the common area, janitorial, light, <br>water, garbage collection fee, garden and parking maintenance, and other expenses for the common <br>areas. The LESSEE shall issue checks every fifth (5th) day of the month for the duration of the <br>lease. The CUSA may be subject to periodic review and may increase from time to time, provided that <br>the LESSOR shall notify the LESSEE of such increase, not less than thirty (30) days prior to its <br>effectivity. <br>

	8.	ESCALATION CLAUSE.<br>

	8.1.	The Monthly Rent shall be increased annually by ({{$utilities->escalation_rate}})  to start<br> on the second (2nd) year of the lease contract as computed in the table of rent. <br>
	<br>
	8.2.	The SECURITY DEPOSIT previously paid shall likewise be increased appropriately and <br>correspondingly.<br>
	Here are the other terms of the contract<br>
	@foreach($contents as $content)
	{{$content->description}}
	</html>
	@endforeach

