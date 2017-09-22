@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a href="{{url('/tenant')}}"><i class="mdi-action-home"></i> Home</a></li>
	<li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
	<li><a href="{{route("registrationForfeit.index")}}"><i class="mdi-action-delete"></i> Regisration Forfeit</a></li>
	<li>
		<a href="{{route("registrationForfeit.show",$result->id)}}"> {{$result->code}}</a></li>
	</ol>
	@endsection
	@section('content')
	<div class="body">
		{{  Form::open(array('route' => 'registrationForfeit.store'))}}

		<input type="hidden" value="{{$result->id}}" name="myId">
		<h2>
			<button type='button' class='btn bg-blue waves-effect waves-float btnChoose' value="header" >Accept/Reject</button>
			<div class="form-group">
				<input type='hidden' name='header_is_active' id='header_is_active' value="0">
			</div>
		</h2>
		<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-col-green">
					<div class="modal-header">
						<h1 id="label" class="modal-title align-center p-b-15">What would you like to do with this item?<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
					</div>
					<div class="modal-body">
						<div id='regi_info'>
							{{-- used in javascript. don't delete --}}
						</div>
					</div>
					<div class="modal-footer">
						<button type='button' id='btnCancel' class='btn bg-blue waves-effect waves-float'>Cancel</button>
						<button type='button' id='btnForfeit' class='btn bg-brown waves-effect waves-float'>Forfeit</button>
					</div>
				</div>

			</div>
		</div>
		<table class="table table-hover dataTable" id="myTable">
			<thead>
				<tr>
					<th class="align-center">Registration Detail</th>
					<th class="align-center">Preferred Building Type</th>
					<th class="align-center">Preferred Unit Size Range</th>
					<th class="align-center">Preferred Unit Type</th>
					<th class="align-center">Preferred Floor</th>
					<th class="align-center">Action</th>

				</tr>
			</thead>
			<tbody id="myList">

			</tbody>
		</table>
		<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> Generate Registration Forfeit</span></button>
		{{Form::close()}}
	</div>

	@endsection
	@section('scripts')
	{!!Html::script("custom/registrationForfeitShowAjax.js")!!}
	<script type="text/javascript">
		mainUrl='{{route('registrationForfeit.index')}}';
		showUrl='{{route('registrationForfeit.showData',$result->id)}}';
		header_remarks="{{$result->tenant_remarks}}";
	</script>
	@endsection
