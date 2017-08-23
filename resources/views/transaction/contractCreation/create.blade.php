@extends('layout.coreLayout')
@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Contract Proposal</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="javascript:void(0);">Action</a></li>
							<li><a href="javascript:void(0);">Another action</a></li>
							<li><a href="javascript:void(0);">Something else here</a></li>
						</ul>
					</li>
				</ul>
			</div>
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
										{{$unit->size}} sqm
									</td>
									<td>
										₱ {{$unit->rate }} 
									</td>
									<td>
										₱ {{$unit->price }} 
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						Total: ₱ {{$total}}
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
									<td class="align-center">₱ {{$total}}</td>
								</tr>
								<tr>
									<td class="align-center">Add: {{$utilities->vat_rate}}% VAT</td>
									<td class="align-center">₱ {{$vat}}</td>
								</tr>
								<tr>
									<td class="align-center">Sub-Total</td>
									<td class="align-center">₱ {{$subtotal}}</td>
								</tr>
								<tr>
									<td class="align-center">Less: {{$utilities->ewt_rate}}% EWT</td>
									<td class="align-center">₱ {{$ewt}}</td>
								</tr>
								<tr>
									<td class="align-center">Net Rent</td>
									<td class="align-center">₱ {{$final}}</td>
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
										₱ {{$advancerent}}
									</td>
								</tr>
								<tr>
									<td>
										Security Deposit({{$utilities->security_deposit_rate}} month(s) base Rent - Reservation Fee if any)
									</td>
									<td>
										₱ {{$securitydeposit}}
									</td>
								</tr>
								<tr>
									<td>
										Common User Service Area Rate({{$utilities->cusa_rate}} * area) 
									</td>
									<td>
										₱ {{$cusa}}
									</td>
								</tr>
								<tr>
									<td>
										Vetting Fee ({{$utilities->vetting_fee}} * area exclusive of vat)
									</td>
									<td>
										₱ {{$vettingfee}}
									</td>
								</tr>
								<tr>
									<td>
										Fit out deposit ({{$utilities->fit_out_deposit}} * rent)
									</td>
									<td>
										₱ {{$fitout}}
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
						<input type="checkbox" value='{{$content->id}}' name="contents[]"> {{$content->description}} <br>
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
						Billing Date
						<input name="billingDate" type="date">
					</fieldset>
					{{Form::close()}}

				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('scripts')
		{{-- {!!Html::script("custom/contractCreationCreateAjax.js")!!}
		<script type="text/javascript">
			dataurl="{{route('contract-create.index')}}/get/createData/{{$tenant->id}}";
		</script> --}}
		@endsection