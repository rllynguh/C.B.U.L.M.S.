 {!!Html::style("plugins/bootstrap/css/bootstrap.min.css")!!}
 {!!Html::style("plugins/node-waves/waves.min.css")!!}
 {!!Html::style("plugins/animate-css/animate.min.css")!!}
 {!!Html::style("css/style.min.css")!!}
 {!!Html::style("css/parsleyStyle.min.css")!!}
 {!!Html::style("css/themes/all-themes.min.css")!!}
 {!!Html::style("css/minimal-pace.min.css")!!}
 {!!Html::style("plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css")!!}
 <!--Registration MODAL-->
 <div class="content">
 	{{Form::open([
 		'id' => 'frmRegistration'
 		])}}
 		<div class="modal fade" id="modalRegistration" tabindex="-1" role="dialog">
 			<div class="modal-dialog modal-md" role="document">
 				<div class="modal-content modal-col-green modal-lg">
 					<div class="modal-header">
 						<h2 class="modal-title align-center p-b-15 p-l-35">Tenant Registration<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
 					</div>
 					<div class="modal-body align-center">
 						{{-- form open --}}
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
 							<div>
 								<!-- ADDRESS # -->
 								<div class="form-line">
 									{{ Form::label('tena_number', 'Address*', [
 										'class' => 'control-label'
 									]) 
 								}}
 								<div class="form-group ">
 									{{ Form::text('tena_address', null, [
 										'id' => 'tena_number',
 										'class' => 'form-control form-line',
 										'maxlength' => '100',
 										'required' => 'required',
 										'autocomplete' => 'off',
 									]) 
 								}}
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
 							{{ Form::label('tenant','Middle Name',[
 								'class' => ''
 							])
 						}}
 						<div class="form-group ">
 							{{ Form::text('mname', null, [
 								'id' => 'mname',
 								'class' => 'form-control form-line',
 								'maxlength' => '25',
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
{{-- 	<div class="col-sm-6 col-md-6 col-xs-6">
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
</div> --}}
</div>
</div>

<!-- CONTACT DETAILS START -->
<div class="col-sm-12 col-md-12 col-xs-12 nopadding">
	<h2 class="card-inside-title p-b-10">Contact Details</h2>
	<div>
		<!-- Cellphone # -->
		<div class="col-sm-4 col-md-4 col-xs-4">
			<div class="form-line">
				{{ Form::label('cellno', 'Cellphone Number', [
					'class' => 'control-label'
				]) 
			}}
			<div class="form-group ">
				{{ Form::text('cellno', null, [
					'id' => 'cellno',
					'class' => 'mobile-phone-number form-control form-line',
					'maxlength' => '25',
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
		{{ Form::label('telno', 'Telephone Number', [
			'class' => 'control-label'
		]) 
	}}
	<div class="form-group ">
		{{ Form::text('telno', null, [
			'id' => 'telno',
			'class' => 'telephone-number form-control form-line',
			'maxlength' => '25',
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
			'autocomplete' => 'off'
		]) 
	}}
</div>
</div>
</div>
</div>
</div>
<!-- CONTACT DETAILS END -->


</div>
</fieldset>
<h3>Finalization</h3>
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
					'min' => '1',
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
		<label class="control-label">Remarks</label>
		<div class="form-line">
			<textarea class="form-control form-line" id="header_remarks" name="header_remarks" value=""></textarea>
		</div>
	</div>
</div>
</div>
</fieldset>


{{-- form end --}}
</div>
<div class="modal-footer align-center">
	<button id='btnSave' type='submit' class='btn bg-brown btn-lg waves-effect  waves-float col-lg-12 col-md-12 col-sm-12' >Submit</button>
</div>
</div>
</div>
</div>
<!--Registration MODAL-->
<button id='btnModal' type='button' class='btn bg-brown btn-lg waves-effect  waves-float col-lg-12 col-md-12 col-sm-12' >Proceed with Registration</button>
@foreach($units as $key=>$unit)
@if($key%2==0)
<div>
	@endif
	<div class="col-sm-6">
		<div class="card">
			<div class="header bg-light-green">
				<input id='unit{{$unit->id}}' required="" type='checkbox' class="filled-in chk-col-blue" type='checkbox' name='units[]' value="{{$unit->id}} ">
				<label for='unit{{$unit->id}}'><h4>{{$unit->code}}</h4></label> <br>
			</div>
			<div class="align-center">
				
				<img 
				src="{{ asset('images/units/'.$unit->picture)}} " class="user-image" height="200" width="200" >
				<div class="body">
				</div>
				<div id="labels" class="col-sm-6">
					<b>Building Type: </b><br>
					<b>Building Name: </b><br>
					<b>Address: </b><br> 
					<b>Unit Type : </b><br> 
					<b>Floor : </b><br> 
					<b>Size : </b><br> 
					<b>Price : </b><br> 
				</div> 
				<div id="details" class="align-right" > 
					{{$unit->building_type}}   <br> 
					{{$unit->building}}   <br> 
					{{$unit->address}}   <br> 
					{{$unit->type}}   <br> 
					{{$unit->floor}}   <br> 
					{{$unit->size}}   <br> 
					{{$unit->price}}   <br> 
				</div>
			</div>
		</div> 
	</div>
	@if($key%2!=0)
</div>
@endif
@endforeach
{{Form::close()}}
</div>


{!!Html::script("plugins/jquery/jquery.min.js")!!}
{!!Html::script("plugins/jquery-datatable/jquery.dataTables.min.js")!!}
{!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js")!!}
{!!Html::script("plugins/jquery-steps/jquery.steps.min.js")!!}
{!!Html::script("plugins/jquery-validation/jquery.validate.min.js")!!}
{!!Html::script("plugins/bootstrap/js/bootstrap.min.js")!!}
{!!Html::script('plugins/jquery/parsley.min.js')!!}
{!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.min.js')!!}
{!!Html::script('plugins/node-waves/waves.min.js')!!}
{!!Html::script('js/pages/forms/advanced-form-elements.min.js')!!}
{!!Html::script('js/notify/notify.min.js')!!}
{!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")!!}
{!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
{!!Html::script("plugins/pace-js/pace.min.js")!!}
{!!Html::script('js/admin.min.js')!!}
{!!Html::script("custom/inquiryUnitsAjax.js")!!}
<script type="text/javascript">
	url="{{route('inquiry.store')}}";
</script>
