 {!!Html::style("plugins/bootstrap/css/bootstrap.min.css")!!}
 {!!Html::style("plugins/node-waves/waves.min.css")!!}
 {!!Html::style("plugins/animate-css/animate.min.css")!!}
 {!!Html::style("css/style.min.css")!!}
 {!!Html::style("css/parsleyStyle.min.css")!!}
 {!!Html::style("css/themes/all-themes.min.css")!!}

 <div class="row clearfix">
 	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
 	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
 		<div class="card m-t-20">
 			<div class="header">
 				<h2 class="align-center">TENANT REGISTRATION</h2>
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
 					'enctype' => 'multipart/form-data',
 					'id' => 'wizard_with_validation'
 					])}}
 					<h3>Company Information</h3>
 					<fieldset>
 						<div class="panel-body">
 							<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
 								<h2 class="card-inside-title p-b-20">Company Details
 									<small>[*] indicates field is required.</small></h2>
 									<div>
 										<!-- COMPANY NAME -->
 										<div class="col-sm-6 col-md-6 col-xs-6">
 											<div class="form-line">
 												{{ Form::label('tenant', 'Company Name*', [
 													'class' => ''
 												]) 
 											}}
 											<div class="form-group ">
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
 								</div>

 								<!-- BUSINESS TYPE -->
 								<div class="col-sm-6 col-md-6 col-xs-6">
 									<div class="form-line">
 										{{ Form::label('busitype', 'Business Type*', [
 											'class' => 'control-label'
 										]) 
 									}}
 									<div class="form-group ">
 										{{ Form::select('busitype',$busitype, null, [
 											'id' => 'busitype',
 											'required' => 'required',
 											'class' => 'form-control form-line align'])
 										}}
 									</div>
 								</div>
 							</div>
 						</div>
 					</div>

 					<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
 						<h2 class="card-inside-title p-t-20 p-b-10">Company Address</h2>
 						<div>
 							<!-- ADDRESS # -->
 							<div class="col-sm-4 col-md-4 col-xs-4">
 								<div class="form-line">
 									{{ Form::label('tena_number', 'Address Number*', [
 										'class' => 'control-label'
 									]) 
 								}}
 								<div class="form-group ">
 									{{ Form::text('tena_number', null, [
 										'id' => 'tena_number',
 										'class' => 'form-control form-line',
 										'maxlength' => '5',
 										'required' => 'required',
 										'autocomplete' => 'off',
 									]) 
 								}}
 							</div>
 						</div>
 					</div>

 					<!-- STREET -->
 					<div class="col-sm-4 col-md-4 col-xs-4">
 						<div class="form-line">
 							{{ Form::label('tena_street', 'Street*', [
 								'class' => 'control-label'
 							]) 
 						}}
 						<div class="form-group ">
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
 			</div>

 			<!-- BRGY -->
 			<div class="col-sm-4 col-md-4 col-xs-4">
 				<div class="form-line">
 					{{ Form::label('tena_barangay', 'Barangay*', [
 						'class' => 'control-label'
 					]) 
 				}}
 				<div class="form-group ">
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
 	</div>

 </div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
	<div>
		<!-- PROVINCE -->
		<div class="col-sm-6 col-md-6 col-xs-6">
			<div class="form-line">
				{{ Form::label('tena_province', 'Province*', [
					'class' => 'control-label'
				]) 
			}}
			<div class="form-group ">
				{{ Form::select('tena_province', $tenaprov,null, [
					'id' => 'tena_province',
					'class' => 'form-control form-line'])
				}}
			</div>
		</div>
	</div>

	<!-- CITY -->
	<div class="col-sm-6 col-md-6 col-xs-6">
		<div class="form-line">
			{{ Form::label('tena_city', 'City*', [
				'class' => 'control-label'
			]) 
		}}
		<div class="form-group ">
			{{ Form::select('tena_city', [
			], null, [
				'id' => 'tena_city',
				'class' => 'form-control form-line'])
			}}
		</div>
	</div>
</div>
</div>
</div>
</div>
</fieldset>

<h3>Representative Information</h3>
<fieldset>
	<div class="panel-body">
		<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
			<h2 class="card-inside-title p-b-20">Representative Details
				<small>[*] indicates field is required</small></h2>
				<div>
					<!-- REP NAME fname-->
					<div class="col-sm-4 col-md-4 col-xs-4">
						<div class="form-line">
							{{ Form::label('tenant','First Name*',[
								'class' => ''
							])
						}}
						<div class="form-group ">
							{{ Form::text('fname', null, [
								'id' => 'fname',
								'class' => 'form-control form-line',
								'maxlength' => '25',
								'required' => 'required',
								'autocomplete' => 'off',
								'data-parsley-pattern' => '^[a-zA-Z. ]+$'
							]) 
						}}
					</div>
				</div>
			</div>

			<!-- REP NAME mname -->
			<div class="col-sm-4 col-md-4 col-xs-4">
				<div class="form-line">
					{{ Form::label('tenant','Middle Name*',[
						'class' => ''
					])
				}}
				<div class="form-group ">
					{{ Form::text('mname', null, [
						'id' => 'mname',
						'class' => 'form-control form-line',
						'maxlength' => '25',
						'required' => 'required',
						'autocomplete' => 'off',
						'data-parsley-pattern' => '^[a-zA-Z. ]+$'
					]) 
				}}
			</div>
		</div>
	</div>

	<!-- REP NAME lname -->
	<div class="col-sm-4 col-md-4 col-xs-4">
		<div class="form-line">
			{{ Form::label('tenant','Last Name*',[
				'class' => ''
			])
		}}
		<div class="form-group ">
			{{ Form::text('lname', null, [
				'id' => 'lname',
				'class' => 'form-control form-line',
				'maxlength' => '25',
				'required' => 'required',
				'autocomplete' => 'off',
				'data-parsley-pattern' => '^[a-zA-Z. ]+$'
			]) 
		}}
	</div>
</div>
</div>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12">
	<div>
		<!-- POSITION -->
		<div class="col-sm-6 col-md-6 col-xs-6">
			<div class="form-line">
				{{ Form::label('position', 'Position*', [
					'class' => 'control-label'
				]) 
			}}
			<div class="form-group ">
				{{ Form::select('position', $posi, null, [
					'id' => 'position',
					'class' => 'form-control form-line'])
				}}
			</div>
		</div>
	</div>

	<!-- PICTURE -->
	<div class="col-sm-6 col-md-6 col-xs-6">
		<div class="form-group">
			{{ Form::label('tenant', 'Picture*', [
				'class' => 'control-label'
			]) 
		}}
		{{ Form::file('picture', [
			'required' => 'required',
			'id' => 'picture'
		]) 
	}}
</div>
</div>
</div>
</div>

<!-- CONTACT DETAILS START -->
<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
	<h2 class="card-inside-title p-b-10">Contact Details</h2>
	<div>
		<!-- Cellphone # -->
		<div class="col-sm-4 col-md-4 col-xs-4">
			<div class="form-line">
				{{ Form::label('cellno', 'Cellphone Number*', [
					'class' => 'control-label'
				]) 
			}}
			<div class="form-group ">
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
</div>

<!-- Telno -->
<div class="col-sm-4 col-md-4 col-xs-4">
	<div class="form-line">
		{{ Form::label('telno', 'Telephone Number*', [
			'class' => 'control-label'
		]) 
	}}
	<div class="form-group ">
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
</div>

<!-- Email add -->
<div class="col-sm-4 col-md-4 col-xs-4">
	<div class="form-line">
		{{ Form::label('email', 'Email Address*', [
			'class' => 'control-label'
		]) 
	}}
	<div class="form-group ">
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
</div>
</div>
<!-- CONTACT DETAILS END -->

<!-- REP ADDRESS START -->
<div class="col-sm-12 col-md-12 col-xs-12 m-t-10 nopadding">
	<h2 class="card-inside-title p-b-10">Representative Address</h2>
	<div>
		<!-- Address # -->
		<div class="col-sm-4 col-md-4 col-xs-4">
			<div class="form-line">
				{{ Form::label('repr_number', 'Address Number*', [
					'class' => 'control-label'
				]) 
			}}
			<div class="form-group ">
				{{ Form::number('repr_number', null, [
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
</div>

<!-- STREET -->
<div class="col-sm-4 col-md-4 col-xs-4">
	<div class="form-line">
		{{ Form::label('repr_street', 'Street*', [
			'class' => 'control-label'
		]) 
	}}
	<div class="form-group ">
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
</div>

<!-- BARANGAY -->
<div class="col-sm-4 col-md-4 col-xs-4">
	<div class="form-line">
		{{ Form::label('repr_barangay', 'Barangay*', [
			'class' => 'control-label'
		]) 
	}}
	<div class="form-group ">
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
</div>
</div>
</div>

<!-- PROVINCE AND CITY -->
<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
	<div>
		<!-- PROVINCE -->
		<div class="col-sm-6 col-md-6 col-xs-6">
			<div class="form-line">
				{{ Form::label('repr_province', 'Province*', [
					'class' => 'control-label'
				]) 
			}}
			<div class="form-group ">
				{{ Form::select('repr_province', $reprprov, null, [
					'id' => 'repr_province',
					'class' => 'form-control form-line'])
				}}
			</div>
		</div>
	</div>

	<!-- CITY -->
	<div class="col-sm-6 col-md-6 col-xs-6">
		<div class="form-line">
			{{ Form::label('repr_city', 'City*', [
				'class' => 'control-label'
			]) 
		}}
		<div class="form-group ">
			{{ Form::select('repr_city', [
			], null, [
				'id' => 'repr_city',
				'class' => 'form-control form-line'])
			}}
		</div>
	</div>
</div>
</div>
</div>
<!-- END REP ADDRESS -->
</div>
</fieldset>

<h3>Unit Specifications</h3>
<fieldset>
	<div class="panel-body">
		<div id="fields">
		</div>
		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<div class="input-group">
					<label class="control-label">Building Type*</label>
					<div class="form-line">
						<select class="form-control form-line" id="builtype1" name="builtype[]"></select>
					</div>
				</div>
			</div>
		</div>	

		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<label class="control-label">Floor #*</label>
				<div class="form-line">
					<select class="form-control form-line" id="floor1" name="floor[]"></select>
				</div>
			</div>
		</div>

		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<div class="input-group">
					<label class="control-label">Unit Type*</label>
					<div class="form-line">
						<select class="form-control form-line" id="utype1" name="utype[]">
							<option value="0">Raw</option>
							<option value="1">Shell</option>
						</select>
					</div>
				</div>
			</div>
		</div>	

		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<label class="control-label">Size*</label>
				<div class="form-line">
					<select class="form-control form-line" id="size1" name="size[]"></select>
				</div>

			</div>
		</div>

		<div class="col-sm-12 nopadding">
			<div class="form-group">
				<label class="control-label">Remarks*</label>
				<div class="form-line">
					<textarea class="form-control form-line" id="remarks1" name="remarks[]" value=""></textarea>
				</div>
			</div>
			<div class="input-group-btn">
				<button class="btn btn-success" type="button"  onclick="fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<h3>Remarks</h3>
<fieldset>
	<div class="panel-body">

		<div class="col-sm-12 nopadding">
			<div class="form-group">
				<div class="form-line">
					{{ Form::label('duration', 'Desired Duration of Contract*', [
						'class' => 'control-label'
					]) 
				}}
				{{ Form::number('duration', null, [
					'id' => 'duration',
					'class' => 'form-control form-line',
					'max' => '3',
					'required' => 'required',
					'autocomplete' => 'off',
					'data-parsley-type' => 'number',
					'required' => ''
				]) 
			}}
		</div>
	</div>
</div>
<div class="col-sm-12 nopadding">
	<div class="form-group">
		<label class="control-label">Remarks*</label>
		<div class="form-line">
			<textarea required="" class="form-control form-line" id="header_remarks" name="header_remarks" value=""></textarea>
		</div>
	</div>
</div>
</div>
</fieldset>
<h3>Summary</h3>
<fieldset>
	<div class="col-sm-6">
		<div class="thumbnail">
			<img id='preview' class="img-circle" height="100" width="100">
			<div class="caption">
				<h3 id="dispName"></h3>
				<h6 id="dispPosition"></h6>
				<div>
					<p id="dispCompany"></p> 
					<p id="dispBusiness"></p>  
					<p id="dispCompAddress"></p> 
					<p id="dispCell"></p> 
					<p id="dispTel"></p> 
					<p id="dispEmail"></p> 
					<p id="dispRepAddress"></p> 
				</div>
			</div>
		</div>
	</div>
 								{{-- <div class="col-sm-6">
 									<img id='preview' height="150" width="150">
 								</div> --}}
 								{{-- <div class="col-sm-6">
 									<label>Company: </label>
 									<label id="dispCompany"></label>  <label>Business: </label><label id="dispBusiness"></label>  <br>
 									<label>Address: </label>
 									<label id="dispCompAddress"></label> <br>
 									<label>Name: </label>
 									<label id="dispName"></label> <br>
 									<label>Position: </label>
 									<label id="dispPosition"></label> <br>
 									<label>Cellphone: </label>
 									<label id="dispCell"></label> <br>
 									<label>Telephone Number: </label>
 									<label id="dispTel"></label> <br>
 									<label>Email: </label>
 									<label id="dispEmail"></label> <br>
 									<label>Address: </label>
 									<label id="dispRepAddress"></label> <br>
 								</div> --}}
 								<div class="col-sm-6">
 									<label>Duration: </label>
 									<label id="dispDuration"></label> <br>
 									<label>Remarks: </label>
 									<label id="dispRemarks"></label> <br>
 									<div id="dispRequest"></div> <br>
 								</div>
 							</fieldset>
 							{{-- {{Form::submit('GO')}} --}}
 							{{Form::close()}}

 						</div>
 					</div>
 				</div>
 			</div>
 			{!!Html::script("plugins/jquery/jquery.min.js")!!}
 			{!!Html::script("plugins/jquery-steps/jquery.steps.min.js")!!}
 			{!!Html::script("plugins/jquery-validation/jquery.validate.min.js")!!}
 			{!!Html::script("plugins/bootstrap/js/bootstrap.min.js")!!}
 			{!!Html::script('plugins/jquery/parsley.min.js')!!}
 			{!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.min.js')!!}
 			{!!Html::script('plugins/node-waves/waves.min.js')!!}
 			{!!Html::script("custom/tenantRegistrationAjax.min.js")!!}
 			{!!Html::script('js/pages/forms/advanced-form-elements.min.js')!!}
 			{!!Html::script('js/notify/notify.min.js')!!}
 			{!!Html::script("plugins/jquery-datatable/jquery.dataTables.min.js")!!}
 			{!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")!!}
 			{!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js")!!}
 			{!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
 			{!!Html::script('js/admin.min.js')!!}
 			<script type="text/javascript">
 				buil_type_url="{{route("custom.getBuildingType")}}";
 				prov_url="{{route("custom.getProvince")}}";
 				posi_url="{{route("custom.getPosition")}}";
 				floor_url="{{route("custom.getFloor")}}";
 				range_url="{{route("custom.getRange")}}";
 			</script>
 			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

 			</div>