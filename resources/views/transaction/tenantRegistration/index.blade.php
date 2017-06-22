@extends('layout.coreLayout')
@section('content')
{{Form::open()}}
<div class="panel panel-default">

	<div class="panel-heading">Unit Specifications</div>
	<div class="panel-body">

		<div id="fields">

		</div>
		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<input type="text" class="form-control" id="floor" name="floor[]" value="" placeholder="Floor">
			</div>
		</div>

		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<div class="input-group">
					<select class="form-control" id="type" name="type[]">
					</select>
				</div>
			</div>
		</div>	

		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<input type="text" class="form-control" id="size" name="size[]" value="" placeholder="Size">
			</div>
		</div>

		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<input type="text" class="form-control" id="remarks" name="remarks[]" value="" placeholder="Remarks">
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
@endsection