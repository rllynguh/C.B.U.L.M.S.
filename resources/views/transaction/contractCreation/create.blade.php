@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a href="{{url('/admin')}}"> Home</a></li>
	<li><a> Transaction</a></li>
	<li><a> Contracts</a></li>
	<li><a href="{{route("contract-create.show",$id)}}">{{$tenant->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="body">
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'contract-create.store'
		])}}
	{{ Form::hidden('regi_id',$id,[
	])
}}
{{ Form::hidden('net_rent',$final,[
])
}}
{{ Form::hidden('advance_rent',$advancerent,[
])
}}
{{ Form::hidden('cusa',$cusa,[
])
}}
{{ Form::hidden('security_deposit',$securitydeposit,[
])
}}
{{ Form::hidden('vetting_fee',$vettingfee,[
])
}}
{{ Form::hidden('fit_out',$fitout,[
])
}}
<h3>Tenant Information</h3>
<fieldset>
	<div class="panel-body">
		<div class="col-sm-12 nopadding">
			<div class="form-group">
				{{ Form::label('tenant', 'Registration Code: ', [
					'class' => ''
				]) 
			}}
			{{$tenant->code}}

		</div>
		<div class="form-group">
			{{ Form::label('tenant', 'Company: ', [
				'class' => ''
			]) 
		}}
		{{$tenant->tenant}}

	</div>
	<div class="form-group">
		{{ Form::label('address', 'Address: ', [
			'class' => ''
		]) 
	}}
	{{$tenant->address}}

</div>
<div class="form-group">
	{{ Form::label('tenant', 'Business Type: ', [
		'class' => ''
	]) 
}}
{{$tenant->business_type}}

</div>
<div class="form-group">
	{{ Form::label('tenant', 'Representative: ', [
		'class' => ''
	]) 
}}
{{$tenant->full_name}}

</div>
</div>
</fieldset>

<h3>Units</h3>
<fieldset>
	<table class="table table-hover dataTable" id="myTable">
		<thead>
			<tr>
				<th class="align-center">UNIT</th>
				<th class="align-center">AREA</th>
				<th class="align-center">RATE PER SQM</th>			
				<th class="align-center">PRICE</th>	
			</tr>
		</thead>
		<tbody id="myList">
			@foreach($units as $unit)
			<tr>
				<td>
					{{$unit->code}}
				</td>
				<td>
					{{$unit->size}}
				</td>
				<td>
					{{$unit->rate }} 
				</td>
				<td>
					{{$unit->price }} 
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	Total: ₱ {{number_format($total,2)}}
</fieldset>

<h3>Rates</h3>
<fieldset>
	<div class="col-sm-4">
		<table class="table table-hover" id="myTable">
			<thead>
				<tr>
					<th class="align-center">YEAR 1</th>
					<th class="align-center">MONTHLY RENT</th>
				</tr>
			</thead>
			<tbody id="myList">
				<tr>
					<td class="align-center">Base Rent</td>
					<td class="align-center">₱ {{number_format($total,2)}}</td>
				</tr>
				<tr>
					<td class="align-center">Add: {{$utilities->vat_rate}}% VAT</td>
					<td class="align-center">₱ {{number_format($vat,2)}}</td>
				</tr>
				<tr>
					<td class="align-center">Sub-Total</td>
					<td class="align-center">₱ {{number_format($subtotal,2)}}</td>
				</tr>
				<tr>
					<td class="align-center">Less: {{$utilities->ewt_rate}}% EWT</td>
					<td class="align-center">₱ {{number_format($ewt,2)}}</td>
				</tr>
				<tr>
					<td class="align-center">Net Rent</td>
					<td class="align-center">₱ {{number_format($final,2)}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-sm-8">
		<table class="table table-hover dataTable" id="myTable">
			<thead>
				<tr>
					<th class="align-center">DESCRIPTION</th>
					<th class="align-center">RATE</th>
				</tr>
			</thead>
			<tbody id="myList">
				<tr>
					<td>
						Advance Rent({{$utilities->advance_rent_rate}} month(s) Rent)
					</td>
					<td>
						₱ {{number_format($advancerent,2)}}
					</td>
				</tr>
				<tr>
					<td>
						Security Deposit({{$utilities->security_deposit_rate}} month(s) base Rent - Reservation Fee if any)
					</td>
					<td>
						₱ {{number_format($securitydeposit,2)}}
					</td>
				</tr>
				<tr>
					<td>
						Common User Service Area Rate({{$utilities->cusa_rate}} * area) 
					</td>
					<td>
						₱ {{number_format($cusa,2)}}
					</td>
				</tr>
				<tr>
					<td>
						Vetting Fee ({{$utilities->vetting_fee}} * area exclusive of vat)
					</td>
					<td>
						₱ {{number_format($vettingfee,2)}}
					</td>
				</tr>
				<tr>
					<td>
						Fit out deposit ({{$utilities->fit_out_deposit}} * rent)
					</td>
					<td>
						₱ {{number_format($fitout,2)}}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</fieldset>

<h3>
	Terms and conditions
</h3>
<fieldset>
	Select terms and conditions for this contract<br>
	@if(!is_null($contents))
	@foreach($contents as $content)
	<input required="" type="checkbox" value='{{$content->id}}' name="contents[]" id="term{{$content->id}}" class="filled-in chk-col-yellow">
	<label for="term{{$content->id}}">{{$content->description}}</label><br>
	@endforeach
	@endif
</fieldset>
<h3>
	Finalization
</h3>
<fieldset>
	<div class="col-sm-3">	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="header bg-light-green">
				Contract
			</div>	
			<div class="body">
				<div>
					<div>		
						<div class="form-group">
							<div class="form-line">
								<h5 class="card-inside-title">Contract Duration(Years)</h5>
								{{ Form::number('txtDuration',null,[
									'class' => 'form-control text-center max-digits-2',
									'data-rule' => 'quantity',
									'autocomplete' => 'off',
									'min' => '1',
									'max' => '5',
									'required' => 'required',
								])
							}}
						</div>
					</div>
				</div>
				<div>
					<div class="{{-- col-sm-6 --}}">
						Contract Starting Date<br>
						<div class="form-group">
							<div class="form-line">
								<input name="startDate" type="date" class=" form-control" placeholder="Please choose a date...">
							</div>
						</div>
					</div>	
					<div class="{{-- col-sm-6 --}}">
						Billing Date<br>
						<div class="form-group">
							<div class="form-line">
								<input name="billingDate" type="date" class=" form-control" placeholder="Please choose a date...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">	</div>
</div>
</fieldset>
{{Form::close()}}

</div>
@endsection
@section('scripts')
{!!Html::script("js/pages/forms/form-wizard.min.js")!!}
@endsection