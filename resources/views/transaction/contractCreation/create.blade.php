@extends('layout.coreLayout')
@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>ADVANCED FORM EXAMPLE WITH VALIDATION</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
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
					'enctype' => 'multipart/form-data',
					'id' => 'wizard_with_validation'
					])}}
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
									{{ Form::label('tenant', 'Business Type: ', [
										'class' => ''
										]) 
									}}
									{{$tenant->business_type}}

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
											PHP {{$unit->rate }} 
										</td>
										<td>
											PHP {{$unit->price }} 
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							Total: PHP {{$total}}
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
										<td class="align-center">PHP {{$total}}</td>
									</tr>
									<tr>
										<td class="align-center">Add: 12% VAT</td>
										<td class="align-center">PHP {{$vat=$total*.12}}</td>
									</tr>
									<tr>
										<td class="align-center">Sub-Total</td>
										<td class="align-center">PHP {{$subtotal=$total+$vat}}</td>
									</tr>
									<tr>
										<td class="align-center">Less: 5% EWT</td>
										<td class="align-center">PHP {{$ewt=$subtotal*.05}}</td>
									</tr>
									<tr>
										<td class="align-center">Net Rent</td>
										<td class="align-center">PHP {{$netrent=$subtotal - $ewt}}</td>
									</tr>
								</tbody>
							</table>
						</fieldset>

						<h3>Rates</h3>
						<fieldset>
							Advance Rent(3 months Rent) <br>
							{{$advancerent=$netrent*3}}<br>
							Security Deposit(3 months base Rent) <br>
							{{$securitydeposit=$total*3}}<br>
							Common User Service Area Rate(70 * area) <br>
							{{$cusa}}<br>
							Vetting Fee (100 * area)<br>
							{{$vet}}
						</fieldset>
						<h3>
							Terms and conditions
						</h3>
						<fieldset>
							lorem
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