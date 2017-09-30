<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<html>


KNOW ALL MEN BY THESE PRESENTS:

This Contract of Lease, executed and entered into this  day of {{$contract->date_issued}} , in the <br>City of  Taguig , Philippines, by and between: <br> <br>


______________________________, a corporation duly organized and established under the Philippine <br>laws and with principal address at Taguig, Philippines, represented herein by its Authorized <br>Representatitve/ {{$full_name}}, hereinafter referred to as the “LESSOR”; <br>

and <br>

___________, a sole-proprietorship/ corporation with principal address at Taguig, Philippines, <br> represented herein by its _______________, ___________________, hereinafter referred to as the <br>“LESSEE.” <br>


W I T N E S S E T H : <br>

WHEREAS, the LESSOR is the owner of the Carolina Mall- Silang, a three-storey commercial building <br>located at the Sta. Rosa – Tagaytay Road, Brgy. Puting Kahoy, Silang Cavite, hereinafter referred to <br>as the leased premises; <br>

WHEREAS, the LESSEE desires to lease units with an area of ___________ square meters of the <br>above-described property and the LESSOR agreed to lease the same to the LESSEE subject to the <br>following terms and conditions: <br>

NOW, THEREFORE, the LESSOR and the LESSEE agree as follows: <br>

1.	USE OF THE LEASED PREMISES.<br>

1.1.	The leased premises shall be used exclusively by the LESSEE for  <br>business purposes only and the LESSEE is hereby prohibited to use said premises for any <br>other purpose/s without the prior written consent of the LESSOR. <br>


2.	PERIOD OF LEASE.<br>

2.1.	The term of the lease shall be for a period of {{$request->txtDuration}} years commencing on {{$contract->start_of_contract}}  to {{$contract->end_of_contract}} , renewable and subject to negotiation as<br> to <br>the terms and conditions of the lease.  <br>

2.2.	To exercise this option to renew, the LESSEE must give the LESSOR a written notice of <br>intention to do so at least six (6) months before the term of the lease expires.<br>

2.3.	In case of an approved renewal, the LESSEE shall issue such number of post-dated checks (PDC) <br>as may be required by the LESSOR as rental payment for the approved renewed period of lease, on a <br>date specified on the Notice of Approval of Renewal of lease.<br>


3.	RESERVATION FEE.<br>
The LESSEE upon receipt of the Notice of Award from the LESSOR confirming its rights to lease the <br>premises and its acceptance thereto over the leased premises shall pay the RESERVATION FEE in the <br>amount of PESOS: {{number_format($res_fee,2)}}, which shall be valid for thirty <br>(30) days and shall be non-refundable. In the event that the lease proceeds, the Reservation Fee <br>shall be applied to/deducted from the Security Deposit due. <br>
<br>

4.	NET MONTHLY RENT.<br>
<br><br>
4.1.	The NET Rent per month for Year 1 of the Lease Term {{$contract->start_of_contract}} <br>to {{$contract->end_of_contract}}) is PESOS: {{number_format($request->net_rent,2)}} <br> inclusive of 12% Value Added Tax and less Withholding Tax, computed as follows:<br>

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
			{{number_format($billing_detail->price,2)}}
		</td>
	</tr>
	@endforeach
</table>
Total : {{number_format($cost,2)}}



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
YEAR 1	12 PDCs		Due upon execution of Contract of Lease. The checks should be dated on the 16th<br> of each month beginning _______ 2017 through _________ 2018.<br>
YEAR 2	12 PDCs		Due by ___________, 2017. The checks should be dated on the 16th of each month <br>beginning _________ 2018 through _______ 2019.<br>
YEAR 3	12 PDCs		Due by _____________, 2018. The checks should be dated on the 16th of each month<br> beginning __________ 2019 through ________ 2020.<br>
YEAR 4	12 PDCs		Due by _____________, 2019. The checks should be dated on the 16th of each month<br> beginning _________ 2020 through ________ 2021.<br>
YEAR 5	9 PDCs		Due by ___________, 2020. The checks should be dated on the 16th of each month<br> beginning ________ 2021 through _________ 2021.<br>
4.3.	This rental payment shall be payable at the principal office of the LESSOR, without the<br> necessity of demand, reminder or the services of a collector.  A one (1%) percent surcharge per day, <br>computed from the date payment becomes due until full payment has been made, shall be charged in case<br> of delay in the payment of rentals. Should any portion of the rentals be unpaid for over 60 days, the<br> LESSOR has the right to terminate this contract. <br><br>


5.	ADVANCE RENT.<br><br>

5.1	The LESSEE agrees to pay the LESSOR upon signing of this contract a dated check in the sum <br>equivalent to PESOS: PHP {{number_format($request->advance_rent,2)}} and 00/100 (Php 000,000.00), representing three <br>(3) months’ rent as ADVANCE RENT, which shall be applied to the last three (3) months of the lease <br>term. <br><br>

5.2	In case of pre-termination, the Advance Rent referred to in the preceding paragraph shall be <br>forfeited in favor of the LESSOR and shall be treated as liquidated damages.<br><br>


6.	SECURITY DEPOSIT.

6.1.	 The LESSEE agrees to issue the LESSOR upon signing of this contract a dated check in the sum<br> equivalent to PESOS: PHP {{number_format($request->security_deposit,2)}}, representing three (3) months’ base rent of <br>the first year of lease as SECURITY DEPOSIT for the performance of LESSEE’s obligations under this <br>lease contract. <br><br>

6.2.	The SECURITY DEPOSIT shall serve as security deposit for damage to the leased premises, <br>unpaid bills for public utilities, unpaid rents and other fees due that might be due the LESSOR or <br>any public utility. It shall be returned to the LESSEE without interest, and less whatever expenses<br> chargeable against it within sixty (60) days from expiration or termination of the lease. In case the <br>amount of security deposit is insufficient, the LESSEE shall remain liable for such unpaid amount <br>plus interest.<br><br>

6.3.	The SECURITY DEPOSIT previously paid shall remain intact and shall be increased appropriately<br> and correspondingly to the annual increase.<br><br><br>


7.	COMMON AREA CHARGES (CUSA).<br><br>

The LESSEE shall pay the LESSOR a monthly charge of PESOS:  (Php60.00/70.00/80.00) per square meter <br>multiplied by the total floor area leasable, plus VAT, less 2% EWT or a total of PESOS:  PHP {{number_format($request->cusa,2)}} and 00/100 (Php00,000.00) per month upon the effectivity of this contract for the<br> common area expenses on security, maintenance, insurance of the common area, janitorial, light, <br>water, garbage collection fee, garden and parking maintenance, and other expenses for the common <br>areas. The LESSEE shall issue checks every fifth (5th) day of the month for the duration of the <br>lease. The CUSA may be subject to periodic review and may increase from time to time, provided that <br>the LESSOR shall notify the LESSEE of such increase, not less than thirty (30) days prior to its <br>effectivity. <br>

8.	ESCALATION CLAUSE.<br>

8.1.	The Monthly Rent shall be increased annually by {{$utilities->escalation_rate}} (0%) to start<br> on the second (2nd) year of the lease contract as computed in the table of rent. <br>
<br>
8.2.	The SECURITY DEPOSIT previously paid shall likewise be increased appropriately and <br>correspondingly.<br>
Here are the terms<br>
@foreach($contents as $content)
{{$content->description}}
</html>
@endforeach

