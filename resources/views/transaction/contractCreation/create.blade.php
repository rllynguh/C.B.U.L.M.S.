@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a href="{{url('/admin')}}"><i class="mdi-action-home"></i> Home</a></li>
	<li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
	<li><a><i class="mdi-action-assignment"></i> Contracts</a></li>
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
						<th class="align-center">Unit</th>
						<th class="align-center">Area</th>
						<th class="align-center">Rate per sqm</th>			
						<th class="align-center">Price</th>	
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

		<h3>Net Monthly Rent</h3>
		<fieldset>
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th class="align-center">Year 1</th>
						<th class="align-center">Monthly Rent</th>
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
		</fieldset>

		<h3>Rates</h3>
		<fieldset>
			<table class="table table-hover dataTable" id="myTable">
				<thead>
					<tr>
						<th class="align-center">Description</th>
						<th class="align-center">Rate</th>
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
		</fieldset>
		<h3>
			Terms and conditions
		</h3>
		<fieldset>
			Select terms and conditions for this contract<br>
			@if(!is_null($contents))
			@foreach($contents as $content)
			<input type="checkbox" value='{{$content->id}}' name="contents[]" id="term{{$content->id}}" class="filled-in chk-col-yellow">
			<label for="term{{$content->id}}">{{$content->description}}</label><br>
			@endforeach
			@endif
		</fieldset>
		<h3>
			Finalization
		</h3>
		<fieldset>
			Contract Duration
			{{ Form::number('txtDuration',null,[
				'class' => 'form-control text-center',
				'data-rule' => 'quantity',
				'autocomplete' => 'off',
				'min' => '1',
				'max' => '5',
				'required' => 'required',
				])
			}}
			Contract starting date
			<input name="startDate" type="date">
			Billing Date
			<input name="billingDate" type="date">
		</fieldset>
		{{Form::close()}}

	</div>
	@endsection
	@section('scripts')
		{{-- {!!Html::script("custom/contractCreationCreateAjax.js")!!}
		<script type="text/javascript">
			dataurl="{{route('contract-create.index')}}/get/createData/{{$tenant->id}}";
		</script> --}}
		@endsection