@extends('layout.coreLayout')
@section('content')
{{Form::open([
	'enctype' => 'multipart/form-data',
	])}}
	<div class="panel panel-default">

		<div class="panel-heading">Tenant Information</div>
		<div class="panel-body">
			<div class="col-sm-12 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="tenant" name="tenant" value="" placeholder="Company">
				</div>
			</div>
			<div class="col-sm-12 nopadding">
				<div class="form-group">
					<select class="form-control form-line" id="busitype" name="busitype">
					</select>
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="tena_number" name="tena_number" value="" placeholder="#">
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="tena_street" name="tena_street" value="" placeholder="Street">
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="tena_barangay" name="tena_barangay" value="" placeholder="Barangay">
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					<select class="form-control form-line" id="tena_province" name="tena_province">
					</select>
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					<select class="form-control form-line" id="tena_city" name="tena_city">
					</select>
				</div>
			</div>

		</div>

		<div class="panel-heading">Representative Information</div>
		<div class="panel-body">
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="fname" name="fname" value="" placeholder="First">
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="mname" name="mname" value="" placeholder="Middle">
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="lname" name="lname" value="" placeholder="Last">
				</div>
			</div>

			<div class="col-sm-12 nopadding">
				<div class="form-group">
					<select class="form-control form-line" id="position" name="position">
					</select>
				</div>
			</div>
			<div class="col-sm-6 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="cellno" name="cellno" value="" placeholder="Cel no.">
				</div>
			</div>
			<div class="col-sm-6 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="telno" name="telno" value="" placeholder="Tel no.">
				</div>
			</div>
			<div class="col-sm-12 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="email" name="email" value="" placeholder="Email">
				</div>
			</div>


			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="repr_number" name="repr_number" value="" placeholder="#">
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="repr_street" name="repr_street" value="" placeholder="Street">
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="repr_barangay" name="repr_barangay" value="" placeholder="Barangay">
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					<select class="form-control form-line" id="repr_province" name="repr_province">
					</select>
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					<select class="form-control form-line" id="repr_city" name="repr_city">
					</select>
				</div>
			</div>
			<div class="col-sm-12 nopadding">
				{{ Form::file('picture') }}
			</div>
		</div>
		<div class="panel-heading">Unit Specifications</div>
		<div class="panel-body">

			<div id="fields">

			</div>
			<div class="col-sm-3 nopadding">
				<div class="form-group">
					<div class="input-group">
						<select class="form-control form-line" id="builtype" name="builtype[]">
						</select>
					</div>
				</div>
			</div>	

			<div class="col-sm-3 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="floor" name="floor[]" value="" placeholder="Floor">
				</div>
			</div>

			<div class="col-sm-3 nopadding">
				<div class="form-group">
					<div class="input-group">
						<select class="form-control form-line" id="utype" name="utype[]">
							<option id="0">Raw</option>
							<option id="1">Shell</option>
						</select>
					</div>
				</div>
			</div>	

			<div class="col-sm-3 nopadding">
				<div class="form-group">
					<input type="text" class="form-control form-line" id="size" name="size[]" value="" placeholder="Size">
				</div>
			</div>

			<div class="col-sm-12 nopadding">
				<div class="form-group">
					<textarea class="form-control form-line" id="remarks" name="remarks[]" value="" placeholder="Remarks"></textarea>
				</div>
				<div class="input-group-btn">
					<button class="btn btn-success" type="button"  onclick="fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
				</div>
			</div>

			<div class="clear"></div>

		</div>
		{{Form::submit('GO')}}
	</div>
	{{Form::close()}}
	@endsection
	@section('scripts')
	{!!Html::script("custom/tenantRegistrationAjax.js")!!}
	<script type="text/javascript">
		buil_type_url="{{route("custom.getBuildingType")}}";
		busi_type_url="{{route("custom.getBusinessType")}}";
		prov_url="{{route("custom.getProvince")}}";
		posi_url="{{route("custom.getPosition")}}";
	</script>
	@endsection