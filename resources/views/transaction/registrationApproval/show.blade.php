@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">Registration Approval</h2>
		</div>
		
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				{{  Form::open(array('route' => 'registrationApproval.store'))}}
				<div class="header align-center">
					<input type="hidden" value="{{$tenant->id}}" name="myId">
					<h2>
						{{$tenant->code}}
						<button type='button' class='btn bg-blue waves-effect waves-float btnChoose' value="header" >Accept/Reject</button>
						<div class="form-group">
							<input type="hidden" id="header_remarks"  class="form-control form-line" name="header_remarks" value="">
							<input type='hidden' name='header_is_active' id='header_is_active' value="1">
						</div>
					</h2>
				</div>
				<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content modal-col-green">
							<div class="modal-header">
								<h1 id="label" class="modal-title align-center p-b-15">What would you like to do with this item?<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
							</div>
							<div class="modal-body">
								Representative: {{$tenant->name}}
								<br>
								Company: {{$tenant->description}}
								<div id='regi_info'>
									{{-- used in javascript. don't delete --}}
								</div>
							</div>
							<div class="modal-footer">
								<textarea id='detail_remarks' class="form-control form-line" placeholder="remarks"></textarea>
								<button type='button' id='btnAccept' class='btn bg-blue waves-effect waves-float'>Accept</button>
								<button type='button' id='btnReject' class='btn bg-brown waves-effect waves-float'>Reject</button>
							</div>
						</div>

					</div>
				</div>
				<div class="body">
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
					<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> Generate Registration Approval</span></button>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/registrationApprovalShowAjax.js")!!}
<script type="text/javascript">
	mainUrl='{{route('registrationApproval.index')}}';
	showUrl='{{route('registrationApproval.index')}}/get/showData/{{$tenant->id}}';
	header_remarks="{{$tenant->tenant_remarks}}";
</script>
@endsection
