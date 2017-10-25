 {!!Html::style("plugins/bootstrap/css/bootstrap.min.css")!!}
 {!!Html::style("plugins/node-waves/waves.min.css")!!}
 {!!Html::style("plugins/animate-css/animate.min.css")!!}
 {!!Html::style("css/style.min.css")!!}
 {!!Html::style("css/parsleyStyle.min.css")!!}
 {!!Html::style("css/themes/all-themes.min.css")!!}
 {{Form::open([
 	'route' => 'inquiry.units'
 	])}}
 	{{ Form::label('txtSearch','Search location desired')}}
 	<div class="input-group" class="col-sm-6">
 		<div class="form-line">
 			{{ Form::text('txtSearch',null,[
 				'id'=> 'txtSearch',
 				'class' => 'form-control text-center',
 				'autocomplete' => 'off',
 				'required' => 'required',
 			])
 		}}
 	</div>
 </div>
 {{Form::close()}}
 {!!Html::script("plugins/jquery/jquery.min.js")!!}
 {!!Html::script("plugins/jquery-steps/jquery.steps.min.js")!!}
 {!!Html::script("plugins/jquery-validation/jquery.validate.min.js")!!}
 {!!Html::script("plugins/bootstrap/js/bootstrap.min.js")!!}
 {!!Html::script('plugins/jquery/parsley.min.js')!!}
 {!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.min.js')!!}
 {!!Html::script('plugins/node-waves/waves.min.js')!!}
 {!!Html::script('js/pages/forms/advanced-form-elements.min.js')!!}
 {!!Html::script('js/notify/notify.min.js')!!}
 {!!Html::script("plugins/jquery-datatable/jquery.dataTables.min.js")!!}
 {!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")!!}
 {!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js")!!}
 {!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
 {!!Html::script('js/admin.min.js')!!}