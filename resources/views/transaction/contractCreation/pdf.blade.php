<table border="1" cellpadding="0" cellspacing="0" style="width:100.0%">
	<tbody>
		<tr>
			<td style="height:19px; width:518px">
				<p><em>Lease Contract:&nbsp; ____________________</em></p>
			</td>
			<td>&nbsp;</td>
			<td style="height:19px; width:74px">
				<p><strong>01 February 2015 to 31 March 2017</strong></p>
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

<h1>&nbsp;</h1>

<h1>&nbsp;</h1>


<p><strong>CONTRACT OF LEASE</strong></p>

<p>&nbsp;</p>

<p><strong>KNOW ALL MEN BY THESE PRESENTS:</strong></p>

<p>&nbsp;</p>

<p>This Contract of Lease, executed and entered into this {{$contract->day}}day of {{$contract->month}}, in the City of Taguig, Philippines, by and between:</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>MAJENT CORPORATION, </strong>a corporation duly organized and established under the Philippine laws and with principal address at Taguig, Philippines, represented herein by its Authorized Representative, <strong>{{$contract->lessor}},</strong> hereinafter referred to as the &ldquo;<strong>LESSOR</strong>&rdquo;;</p>

<p>&nbsp;</p>

<p>and</p>

<p>&nbsp;</p>

<p><strong>{{$contract->tenant}}, </strong>a sole-proprietorship/ corporation with principal address at _{{$contract->address}}, represented herein by its {{$contract->position}}, <strong>{{$contract->lessee}}</strong>, hereinafter referred to as the &ldquo;<strong>LESSEE.</strong>&rdquo;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>W I T N E S S E T H :</strong></p>

<p>&nbsp;</p>

<p><strong>WHEREAS</strong>, the LESSOR is the owner of the <em><?php
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
@endforeach with an area of <strong>{{$contract->size}} square meters</strong> of the above-described property and the LESSOR agreed to lease the same to the LESSEE subject to the following terms and conditions:</p>

<p>&nbsp;</p>

<p><strong>NOW, THEREFORE</strong>, the LESSOR and the LESSEE agree as follows:</p>

<p>&nbsp;</p>

<ol>
	<li><strong>USE OF THE LEASED PREMISES.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The leased premises shall be used exclusively by the LESSEE for as a {{$contract->business}} business purposes only and the LESSEE is hereby prohibited to use said premises for any other purpose/s without the prior written consent of the LESSOR.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>PERIOD OF LEASE.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The term of the lease shall be for a period of {{$request->txtDuration}} years commencing on <strong>{{$contract->start_of_contract}} to {{$contract->end_of_contract}}</strong>, renewable and subject to negotiation as to the terms and conditions of the lease.&nbsp;</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>To exercise this option to renew, the LESSEE must give the LESSOR a written notice of intention to do so at least six (6) months before the term of the lease expires.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>In case of an approved renewal, the LESSEE shall issue such number of post-dated checks (PDC) as may be required by the LESSOR as rental payment for the approved renewed period of lease, on a date specified on the Notice of Approval of Renewal of lease.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>RESERVATION FEE.</strong></li>
</ol>

<p>The LESSEE upon receipt of the Notice of Award from the LESSOR confirming its rights to lease the premises and its acceptance thereto over the leased premises shall pay the RESERVATION FEE in the amount of <strong>PESOS: {{$contract->res_fee}},</strong> which shall be valid for <strong>thirty (30) days</strong> and shall be non-refundable. In the event that the lease proceeds, the Reservation Fee shall be applied to/deducted from the Security Deposit due.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>NET MONTHLY RENT.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The NET Rent per month for <strong>Year 1</strong> of the Lease Term ({{$contract->start_of_contract}} to {{$contract->end_of_contract}}) is<strong> PESOS: {{number_format($request->net_rent,2)}}</strong> inclusive of 12% Value Added Tax and less Withholding Tax, computed as follows:</li>
</ol>

<table border="1" cellpadding="0" cellspacing="0" style="width:343px">
	<tbody>
		<tr>
			<td style="height:2px; width:183px">
				<p><strong>YEAR 1</strong></p>
			</td>
			<td style="height:2px; width:160px">
				<p><strong>Monthly Rent</strong></p>
			</td>
		</tr>
		<tr>
			<td style="height:2px; width:183px">
				<p>Rate/sqm/month</p>
			</td>
			<td style="height:2px; width:160px">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:2px; width:183px">
				<p>Base Rent</p>
			</td>
			<td style="height:2px; width:160px">
				<p>&nbsp;</p>

				<p>{{$contract->total}}</p>
			</td>
		</tr>
		<tr>
			<td style="height:2px; width:183px">
				<p>Add: 12% VAT</p>
			</td>
			<td style="height:2px; width:160px">
				<p>&nbsp;</p>

				<p>&nbsp;{{$contract->vat}}</p>
			</td>
		</tr>
		<tr>
			<td style="height:2px; width:183px">
				<p>Sub-Total</p>
			</td>
			<td style="height:2px; width:160px">
				<p>&nbsp;</p>

				<p>{{$contract->subtotal}}</p>
			</td>
		</tr>
		<tr>
			<td style="height:2px; width:183px">
				<p>Less: 5% EWT</p>
			</td>
			<td style="height:2px; width:160px">
				<p>&nbsp;</p>

				<p>({{$contract->ewt}})</p>
			</td>
		</tr>
		<tr>
			<td style="height:2px; width:183px">
				<p><strong>Net Rent</strong></p>
			</td>
			<td style="height:2px; width:160px">
				<p>&nbsp;</p>

				<p><strong>&nbsp;{{$contract->final}} </strong></p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>The LESSEE shall issue TWELVE (12) post-dated checks (PDC) in the amount of the NET Rent indicated above to cover the monthly rental payments for Year 1 (February 1, 2017 to January 31, 2018) of the Lease Term.The PDCs for Year 1 are due upon execution of the Contract of Lease.</p>

<p>&nbsp;</p>

<ol>
	<li>The NET Rent per month for the succeeding years of the Lease Term are indicated in the Table of Rent:</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>TABLE OF RENT</strong></p>

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
			PHP	{{number_format($unit->price,2)}}
		</td>
	</tr>
	@endforeach
</table>

<ol>
	<li>The Schedule of Issuance of Post-Dated Checks are as follows:</li>
</ol>

<p>YEAR 1&nbsp;&nbsp;&nbsp; 12 PDCs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Due upon execution of Contract of Lease. The checks should be dated on the 16th of each month beginning _______ 2017 through _________ 2018.</p>

<ol>
	<li>This rental payment shall be payable at the principal office of the LESSOR, without the necessity of demand, reminder or the services of a collector.&nbsp; A one (1%) percent surcharge per day, computed from the date payment becomes due until full payment has been made, shall be charged in case of delay in the payment of rentals. Should any portion of the rentals be unpaid for over 60 days, the LESSOR has the right to terminate this contract.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>ADVANCE RENT.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE agrees to pay the LESSOR upon signing of this contract a dated check in the sum equivalent to <strong>PESOS: {{number_format($request->advance_rent,2)}} </strong><strong>,</strong> representing <strong>three</strong> <strong>(3)</strong> <strong>months&rsquo; rent</strong> as ADVANCE RENT, which shall be applied to the <strong>last three (3) months</strong> of the lease term</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>In case of pre-termination, the Advance Rent referred to in the preceding paragraph shall be forfeited in favor of the LESSOR and shall be treated as liquidated damages.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>SECURITY DEPOSIT.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>&nbsp;The LESSEE agrees to issue the LESSOR upon signing of this contract a dated check in the sum equivalent to <strong>PESOS: ______________________________________ and 00/100 (Php 000,000.00), </strong>representing <strong>three (3) months&rsquo;</strong> base rent of the first year of lease as SECURITY DEPOSIT for the performance of LESSEE&rsquo;s obligations under this lease contract.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The SECURITY DEPOSIT shall serve as security deposit for damage to the leased premises, unpaid bills for public utilities, unpaid rents and other fees due that might be due the LESSOR or any public utility. It shall be returned to the LESSEE without interest, and less whatever expenses chargeable against it within sixty (60) days from expiration or termination of the lease. In case the amount of security deposit is insufficient, the LESSEE shall remain liable for such unpaid amount plus interest.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The SECURITY DEPOSIT previously paid shall remain intact and shall be increased appropriately and correspondingly to the annual increase.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>COMMON AREA CHARGES (CUSA).</strong></li>
</ol>

<p>&nbsp;</p>

<p>The LESSEE shall pay the LESSOR a monthly charge of <strong>PESOS: {{$utilities->cusa_rate}} </strong>per square meter multiplied by the total floor area leasable, plus VAT, less {{$utilities->ewt_rate}}% EWT or a total of <strong>PESOS:{{number_format($request->cusa,2)}}</strong> per month upon the effectivity of this contract for the common area expenses on security, maintenance, insurance of the common area, janitorial, light, water, garbage collection fee, garden and parking maintenance, and other expenses for the common areas. The LESSEE shall issue checks every <strong>fifth (5th)</strong> <strong>day</strong> of the month for the duration of the lease. The CUSA may be subject to periodic review and may increase from time to time, provided that the LESSOR shall notify the LESSEE of such increase, not less than thirty (30) days prior to its effectivity.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>ESCALATION CLAUSE.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The Monthly Rent shall be increased annually by <strong>({{$utilities->escalation_rate}}%) to start on the second (2nd) year </strong>of the lease contract as computed in the table of rent.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The SECURITY DEPOSIT previously paid shall likewise be increased appropriately and correspondingly.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>UTILITY CHARGES AND APPLICATION.</strong></li>
</ol>

<p>&nbsp;</p>

<p>All charges on the leased premises, such as water, electricity, lights and lighting requirements, telephone and communication facilities, and other utility charges, shall be for the exclusive account of the LESSEE and shall be applied for by the LESSEE to the respective utility service offices. All costs that may be incurred for such applicants shall be borne by the LESSEE. However, the provision of the LESSOR&rsquo;s <em>Design and Fit-out Guidelines</em> with respect to the electrical connection/service shall be binding herewith.&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>GREASE TRAP MAINTENANCE </strong></li>
</ol>

<p>&nbsp;</p>

<p>Daily grease trap cleaning shall be for the account of the Lessee. A regular grease trap preventive maintenance shall likewise be done by the Lessee for its own account.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>FIT-OUT PERIOD, REQUIREMENTS AND CONTRACTOR&rsquo;S ALL RISKS INSURANCE.</strong></li>
</ol>

<p>&nbsp;</p>

<p>The LESSEE hereby expressly acknowledges that the leased premises being bare, are in good tenantable condition and agrees to keep the same in such condition for which purpose it binds itself to undertake at its exclusive expense all ordinary repairs necessary to maintain the same. Alterations or changes including repairs in the electric or plumbing and other existing installations and other improvements installed at the leased premises shall be for the Lessee&rsquo;s account. It is expressly agreed and understood, however, that the LESSEE shall not commence or proceed with any such repair work nor in any case introduce improvements or make any alterations in the leased premises without the prior written consent of the LESSOR.</p>

<p>&nbsp;</p>

<ol>
	<li>Prior to renovation, the LESSEE shall submit to the LESSOR sets of plans and specifications for the approval of the LESSOR.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Such plans and specifications must likewise be submitted to the local building official for purposes of application and issuance of a Renovation Permit. The Renovation Permit shall be a prerequisite for the issuance of a Notice to Fit Out, allowing the tenant to begin renovation/ fit-out work.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE, prior to the commencement of the fit-out, shall comply to, but not limited to the following, as may be referred to the Fit-out and Design Guidelines:</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Fit-Out Deposit. A refundable construction deposit, equivalent to one (1) month&rsquo;s rent, is required to ensure compliance to fit-out rules. Penalties/sanctions for violations of construction rules and regulations shall be automatically deducted from said deposit. Release of the Fit-Out Deposit net of deductions (as may be necessary) shall be made after issuance of clearance by the MENARCO Property Management Office.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Contractor&rsquo;s All Risks Insurance (CARI). This shall cover for physical loss or damage to the permanent or temporary works, formworks, materials, equipment, machinery and supplies during the construction / fit-out period; liability to third party in respect of any injury or death and/or damage to property, real or personal, arising out of or in the course of or caused by the fitting-out / renovation work.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Vetting Fee. A fee of Php100.00 per square meter, exclusive of VAT which is for the account of the LESSEE, will be charged with respect to the involvement of the Lessor&rsquo;s consultants in the review and approval of your fitting-out plans, and in the coordination works with the nominated contractors for any alteration and/or additional works required.&nbsp;</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Any work carried out should secure a work permit from the K Mall Administration Office. The Lessee is required to submit, for security reasons, the particulars of his contractors / authorized representatives so that their access into and departure from the building can be monitored by the security personnel.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE shall exercise extraordinary diligence in order to prevent exposing the Building to danger of fire and explosion. The LESSEE shall strictly comply with the Philippine Building Code and relevant fire regulations. The LESSEE: (i) shall not bring or store in the leased premises any inflammable or explosive goods or articles which may expose the leased premises to fire or increase the fire hazards or increase the premium on the insurance thereof without the prior consent of the LESSOR, except goods and merchandise carried in the normal course of its business.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>During the fit-out period, the expenses on the water and electricity consumption shall be chargeable to the LESSEE on a pro-rata basis.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE is given maximum of ___ month/s rent-free starting on <strong>_________________ to __________________ </strong>for its fit-out.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPAIRS, RENOVATION, ALTERATIONS AND OWNERSHIP OF IMPROVEMENTS.</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>In case of repairs, alterations and renovations during the period of the lease, the LESSEE shall not be allowed to do such works without first submitting the architectural and engineering design of the improvement of the leased area for approval. For this purpose, the provision set forth in the Fit-out and Design Guidelines to be furnished to the LESSEE shall be properly observed and complied with, which guidelines is attached hereto as Annex &ldquo;B&rdquo; and made an integral part of this contract. A Notice to Renovate / Repair shall be issued by the LESSOR to the LESSEE upon approval of the LESSEE&rsquo;s architectural and engineering design for the leased premises, and upon complying with all other requirements that the LESSOR deem necessary.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSOR may obliged the LESSEE to make necessary repairs and renovations of its leased premises when the same is apparently unsafe and/or no longer pass the standards of the unkeep of the Mall.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>All permanent improvements excluding that of the movable property, or alterations of whatever nature such as may be made therein, shall form an integral part of the leased premises and shall belong to and become the exclusive property of the LESSOR upon the termination of the lease, without need for reimbursement for the costs thereof.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIGNBOARDS RESTRICTIONS</strong></li>
</ol>

<p>&nbsp;</p>

<p>The LESSEE shall not paint any inscription, hang or display any signboard outside the leased premises, or in any portion of the building without the consent of the LESSOR. For uniformity of the signs and for the preservation of the aesthetic value of the building, the LESSOR shall provide for the specification of the signboard and shall designate the place for the signboard of the respective tenants which shall be found in the Design and Fit-out Guidelines which guidelines is attached hereto as Annex &ldquo;B&rdquo; and made an integral part of this contract.</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAMAGES TO THE LEASED PREMISES</strong></li>
</ol>

<p>&nbsp;</p>

<p>In case of fire or other casualty which have resulted from the negligence of the LESSEE or his/her employees, agents, or persons allowed by LESSEE to access to the leased premises, there shall be no abatement of rental and the LESSOR shall not be liable for any inconvenience or annoyance to the LESSEE or injury to his business and of the neighboring establishments and employees, resulting in any way from such damage thereto. The LESSOR may replace, repair or reconstruct the same for the account of the LESSEE, if after a reasonable time, LESSEE has not made the necessary repair or replacement or reconstruction thereon.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NON-PAYMENT OF RENT </strong></li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The failure of the tenant to pay rent for a total of two (2) months shall give the right to the owner to apply the Security Deposit for payment thereof and terminate the lease, and it shall likewise be a ground for ejectment.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBLEASE OR ASSIGNMENT</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE shall not directly or indirectly sublease, assign or transfer his/her right of lease over the leased premises or any portion thereof under any circumstance whatsoever, and any such contract made in violation of this clause shall be null and void.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSOR may sell, transfer, encumber or convey the lease premises provided prior written notice is given to the LESSEE. However, in the event of sale, transfer, encumbrance or conveyance of the leased premises, it shall be the obligation of the LESSOR to impose as a condition of sale, transfer or encumbrance that the vendee or party in whose favor the alienation or encumbrance is to be made, should take the leased premises subject to the terms and conditions of this contract.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PARKING AND OTHER JOINT AREAS</strong></li>
</ol>

<p>&nbsp;</p>

<p>The non-exclusive privilege to use parking areas and other portions of the building dedicated to common use by the LESSEE, its employees, clients and customers is not an integral part of this lease; as such, it may be restricted or regulated by the LESSOR at its sole discretion.</p>

<p>&nbsp;&nbsp;</p>

<p>&nbsp;&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RETURN, OVER-STAY AND ABANDONMENT OF LEASED PREMISES</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>LESSEE shall return and surrender the leased premises upon termination of this contract, whether for cause or expiration of its term, in as good condition as reasonable wear and tear will permit and without any delay whatsoever, devoid of all occupants, furniture, article and effects of any kind. If such premises be not surrendered at the expiration of this contract, the LESSEE shall be responsible to LESSOR for all damages which LESSOR shall suffer by reason thereof and will indemnify LESSOR against any claims.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>In case the LESSEE deserted or abandoned the leased premises for a continuous period of fifteen (15) working days without prior written notice to the LESSOR. The LESSOR shall have the right to enter and re-possess the leased premises either by force or otherwise without liability to any prosecution and exercise its rights thereto.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACCESS TO THE LEASED PREMISES BY THE LESSOR</strong></li>
</ol>

<p>&nbsp;</p>

<p>The LESSOR or his/her duly authorized representatives shall have the right to inspect the leased premises at any reasonable hour of the day upon prior notice to the LESSEE, to inspect the same, to make repairs, alterations, improvements which it may be deem necessary for the proper preservation and maintenance of the unit and to determine whether the LESSEE has faithfully complied with the provisions of this Contract.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPLIANCE WITH LAWS AND REGULATIONS</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE shall comply with any and all laws, ordinances, regulations or orders promulgated by proper government authorities whether local or national, arising from or regarding the use, occupation, improvement and sanitation of the leased premises, and non-compliance therewith shall be at the exclusive risk and expenses of the LESSEE.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSOR shall, during the effectivity of the lease, warrant the peaceful use, possession and enjoyment of the leased premises by the LESSEE. The LESSOR agrees not to do any act which will, in any manner, interfere with such use, possession and enjoyment of the leased premises.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INSURANCE, REAL ESTATE TAX AND BUSINESS PERMITS AND TAXES OF THE LEASED PREMISES</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSEE agrees to insure and keep insured the improvements on the leased premises at their full insurable value with a reputable insurance company acceptable to the LESSOR and to cause the insurance policy or policies to be made payable to the LESSEE and the LESSOR as their respective interest may appear at the time of loss or damage. In this regard, LESSEE shall within sixty (60) days from the effectivity of this agreement, furnish copy of such policy to the LESSOR.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Real estate tax on the land and the building shall be for the account of LESSOR while taxes, fees, and permits on the business contracted by LESSEE in the leased premises shall be for the account of LESSEE. This includes real property taxes on special assessment of the local government unit on the leased premises, which shall be for the account of the LESSEE and payable upon demand by the LESSOR.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Any and all documentary stamp taxes, notarization fees and other charges necessary for the execution of this Contract shall be for the account of LESSOR.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>The LESSOR shall insure the leased premises (excluding the properties of the LESSEE found therein) at its own expense against loss or damage by fire or other operational risks, the proceeds thereof to be used for immediate repairs of the leased premises in case the same or a portion thereof is totally or partially destroyed by fire and/or other fortuitous events, in order to make the leased premises tenantable for the LESSEE&rsquo;s purposes.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMEDIAL MEASURE</strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>In case of serious/gross violation or infringement of any of the foregoing terms and conditions, the LESSOR reserves the right to terminate this Contract of Lease immediately and the LESSEE agrees to vacate forthwith the premises without need of court proceeding: Provided, however, that if for any valid reason it shall become necessary for the LESSOR to institute an appropriate court action for the enforcement of his/her rights under this Contract to include payment of rent for the entire period, the LESSEE shall be liable in&nbsp; all damages pertinent to the leased premises including the 1% percent surcharge per day as attorney&rsquo;s fees in an amount equivalent to 10% of the amount claimed in the complaint aside from court costs and other legal charges allowed by the Rules of Court.</li>
</ol>

<p>&nbsp;</p>

<ol>
	<li>Without prejudice to the provision of the preceding paragraph, the parties hereto agree on a faithful execution of the provisions hereof and to settle difference that may arise herefrom amicably. Should any controversy arise which the parties hereto cannot resolve, the same shall be submitted to a group of arbitrators composed of three (3) members, one to be appointed by LESSOR another by LESSEE and the third one to be agreed upon by the two arbitrators previously chosen and the parties hereto shall submit to the decision of the arbitrators.</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEPARABILITY CLAUSE</strong></li>
</ol>

<p>&nbsp;</p>

<p>&nbsp; Unless otherwise stipulated by the parties herein, in case any terms and conditions of this Contract of Lease become unenforceable for any reason whatsoever, the other terms and conditions which are not affected thereby shall remain effective, and should not excuse the LESSOR nor the LESSEE from non-compliance herewith.&nbsp; Non-performance or non-compliance with the valid terms and conditions of this Contract of Lease shall constitute a breach as above-mentioned.</p>

Here are the other terms of the contract<br>
@foreach($contents as $content)
{{$content->description}}<br>
@endforeach
<br>
<br>


<p>&nbsp;</p>

<ol>
	<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VENUE OF ACTION</strong></li>
</ol>

<p>&nbsp;</p>

<p>Any action on this contract shall be brought only and exclusively, in the court of appropriate jurisdiction sitting in Taguig City.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>IN WITNESS WHEREOF</strong>, the parties hereby affix their signatures on this Contract of Lease on this _______ day of _______________, 20_____ at ________City, Philippines.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p>Lessor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lessee</p>

<p>&nbsp;</p>

<p>by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; by:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>SIGNED IN THE PRESENCE OF:</strong></p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>__________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _________________________</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<h1><strong>ACKNOWLEDGMENT</strong></h1>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>REPUBLIC OF THE PHILIPPINES&nbsp;&nbsp;&nbsp; )</strong></p>

<p><strong>CITY OF TAGUIG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )S.S.</strong></p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; BEFORE ME</strong>, a Notary Public for and in the City of _____________, personally appeared the following:</p>

<p>&nbsp;</p>

<table border="1" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td style="width:208px">
				<p>NAME</p>
			</td>
			<td style="width:208px">
				<p>VALID ID</p>
			</td>
			<td style="width:208px">
				<p>PLACE AND DATE OF ISSE</p>
			</td>
		</tr>
		<tr>
			<td style="width:208px">
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
			</td>
			<td style="width:208px">
				<p>&nbsp;</p>
			</td>
			<td style="width:208px">
				<p>&nbsp;</p>

				<p>&nbsp;</p>

				<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td style="width:208px">
				<p>&nbsp;</p>

				<p>&nbsp;</p>
			</td>
			<td style="width:208px">
				<p>&nbsp;</p>
			</td>
			<td style="width:208px">
				<p>&nbsp;</p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>known to me to be the same persons who executed the foregoing contract and who acknowledged to me the same as their free and voluntary act and deed, as well as the free and voluntary act and deed of the entities represented herein.</p>

<p>&nbsp;</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This contract consisting of ____(____) pages, including this whereon the acknowledgment is written, and a separate Annexes __________ has been signed by the parties and witnesses on each and every page thereof, and relates to Contract of Lease.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>WITNESS MY HAND AND SEAL</strong>, this _____ day of _______________ 20___ at the place first written.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Doc No. _____&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NOTARY PUBLIC</p>

<p>Page No. _____</p>

<p>Book No. _____</p>

<p>Series of 20___.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>
