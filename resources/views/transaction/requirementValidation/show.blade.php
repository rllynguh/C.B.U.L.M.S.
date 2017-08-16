@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">{{$requirement->code}}</h2>
			<h2 class="align-center">{{$requirement->tenant}}</h2>
		</div>
		
	</div>
	<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
		{{ Form::open([
			'id' => 'frmRequirement', 'class' => 'form-horizontal'
			])
		}}
		{{ Form::hidden('myId',$id,[
			'id'=> 'myId',
			])
		}}
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">
				<div class="modal-header">
					<h1 id="label" class="modal-title align-center p-b-15">What would you like to do with this item?<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
				</div>
				<div class="modal-body">
					Tenant: {{$requirement->tenant}}
					<br>
					{{$requirement->requirement}}
				</div>
				<div class="modal-footer">
					<textarea id='modal_remarks' name="modal_remarks" class="form-control form-line" placeholder="remarks"></textarea>
					<button type='button' class='btn bg-blue waves-effect waves-float btnDecide' value='1'>Accept</button>
					<button type='button'  class='btn bg-brown waves-effect waves-float btnDecide' value='2'>Needs Revision</button>
					<input type="hidden" value="1" id="decision" name="decision">
				</div>
			</div>
		</div>
		{{Form::close()}}
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<h2 class="align-center">{{$requirement->requirement}} <button id='btnChoose' type='button' class='btn bg-blue waves-effect waves-float' value="header" >Accept/Reject</button></h2>
				<embed src="{{ asset($pdf) }}" width="100%" height="700px" type='application/pdf'>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('scripts')
	{{Html::script('custom/requirementValidationShowAjax.js')}}
	<script type="text/javascript">
		url = "{{route('requirementValidation.index',$id)}}";
	</script>
	@endsection
