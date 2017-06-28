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
					{{ Form::label('tenant', 'Company*', [
						'class' => ''
						]) 
					}}
					{{ Form::text('tenant', null, [
						'id' => 'tenant',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'data-parsley-pattern' => '^[a-zA-Z. ]+$',
						'autocomplete' => 'off'
						]) 
					}}

				</div>
			</div>
			<div class="col-sm-12 nopadding">
				<div class="form-group">
					{{ Form::label('busitype', 'Business', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::select('busitype', [
						], null, [
						'id' => 'busitype',
						'required' => 'required',
						'class' => 'form-control form-line align'])
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::label('tena_number', 'Number*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('tena_number', null, [
						'id' => 'tena_number',
						'class' => 'form-control form-line',
						'maxlength' => '4',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-type' => 'number'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::label('tena_street', 'Street*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('tena_street', null, [
						'id' => 'tena_street',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::label('tena_barangay', 'Barangay*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('tena_barangay', null, [
						'id' => 'tena_barangay',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
						]) 
					}}
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					{{ Form::label('tena_province', 'Province*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::select('tena_province', [
						], null, [
						'id' => 'tena_province',
						'class' => 'form-control form-line'])
					}}
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					{{ Form::label('tena_city', 'City', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::select('tena_city', [
						], null, [
						'id' => 'tena_city',
						'class' => 'form-control form-line'])
					}}
				</div>
			</div>

		</div>

		<div class="panel-heading">Representative Information</div>
		<div class="panel-body">
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::text('fname', null, [
						'id' => 'fname',
						'placeholder' => 'First Name',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z. ]+$'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::text('mname', null, [
						'id' => 'mname',
						'placeholder' => 'Middle Name',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z. ]+$'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::text('lname', null, [
						'id' => 'lname',
						'placeholder' => 'Last Name',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z. ]+$'
						]) 
					}}
				</div>
			</div>

			<div class="col-sm-12 nopadding">
				<div class="form-group">
					{{ Form::label('position', 'Position', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::select('position', [
						], null, [
						'id' => 'position',
						'class' => 'form-control form-line'])
					}}

				</div>
			</div>
			<div class="col-sm-6 nopadding">
				<div class="form-group">
					{{ Form::label('cellno', 'Cellphone Number*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('cellno', null, [
						'id' => 'cellno',
						'class' => 'mobile-phone-number form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'data-parsley-type' => 'number',
						'autocomplete' => 'off'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-6 nopadding">
				<div class="form-group">
					{{ Form::label('telno', 'Telephone Number*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('telno', null, [
						'id' => 'telno',
						'class' => 'telephone-number form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'data-parsley-pattern' => '^[a-zA-Z. ]+$',
						'autocomplete' => 'off'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-12 nopadding">
				<div class="form-group">
					<div class="form-group">
						{{ Form::label('email', 'Email Address*', [
							'class' => 'control-label'
							]) 
						}}
						{{ Form::text('email', null, [
							'id' => 'email',
							'class' => 'form-control form-line email',
							'maxlength' => '25',
							'required' => 'required',
							'data-parsley-pattern' => '^[a-zA-Z. ]+$',
							'autocomplete' => 'off'
							]) 
						}}
					</div>
				</div>
			</div>


			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::label('repr_number', 'Number*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('repr_number', null, [
						'id' => 'repr_number',
						'class' => 'form-control form-line',
						'maxlength' => '4',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-type' => 'number'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::label('repr_street', 'Street*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('repr_street', null, [
						'id' => 'repr_street',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
						]) 
					}}
				</div>
			</div>
			<div class="col-sm-4 nopadding">
				<div class="form-group">
					{{ Form::label('repr_barangay', 'Barangay*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::text('repr_barangay', null, [
						'id' => 'repr_barangay',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
						]) 
					}}
				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					{{ Form::label('repr_province', 'Province*', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::select('repr_province', [
						], null, [
						'id' => 'repr_province',
						'class' => 'form-control form-line'])
					}}

				</div>
			</div>

			<div class="col-sm-6 nopadding">
				<div class="form-group">
					{{ Form::label('repr_city', 'City', [
						'class' => 'control-label'
						]) 
					}}
					{{ Form::select('repr_city', [
						], null, [
						'id' => 'repr_city',
						'class' => 'form-control form-line'])
					}}

				</div>
			</div>
			<div class="col-sm-12 nopadding">
				{{ Form::file('picture', 
					[
					'required' => 'required'
					]) }}
				</div>
			</div>
			<div class="panel-heading">Unit Specifications</div>
			<div class="panel-body">

				<div id="fields">

				</div>
				<div class="col-sm-3 nopadding">
					<div class="form-group">
						<div class="input-group">
							<label class="control-label">Building Type*</label>
							<select class="form-control form-line" id="builtype" name="builtype[]">
							</select>
						</div>
					</div>
				</div>	

				<div class="col-sm-3 nopadding">
					<div class="form-group">
						<label class="control-label">Floor #*</label>
						<input type="text" class="form-control form-line" id="floor" name="floor[]" value="" >
					</div>
				</div>

				<div class="col-sm-3 nopadding">
					<div class="form-group">
						<div class="input-group">
							<label class="control-label">Unit Type*</label>
							<select class="form-control form-line" id="utype" name="utype[]">
								<option id="0">Raw</option>
								<option id="1">Shell</option>
							</select>
						</div>
					</div>
				</div>	

				<div class="col-sm-3 nopadding">
					<div class="form-group">
						<label class="control-label">Size*</label>
						<input type="text" class="form-control form-line" id="size" name="size[]" value="" >
					</div>
				</div>

				<div class="col-sm-12 nopadding">
					<div class="form-group">
						<label class="control-label">Remarks*</label>
						<textarea class="form-control form-line" id="remarks" name="remarks[]" value=""></textarea>
					</div>
					<div class="input-group-btn">
						<button class="btn btn-success" type="button"  onclick="fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
					</div>
				</div>

				<div class="clear"></div>

			</div>
			<div class="panel-heading">Remarks</div>
			<div class="panel-body">
				<div class="col-sm-12 nopadding">
					<div class="form-group">
						<textarea class="form-control form-line" id="header_remarks" name="header_remarks" value="" placeholder="Remarks"></textarea>
					</div>
				</div>
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