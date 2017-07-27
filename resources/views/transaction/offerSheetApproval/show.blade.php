@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
		</div>

	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				{{  Form::open(array('route' => 'offerSheetApproval.store'))}}
				<div class="header align-center">
					<input type="hidden" value="{{$result->id}}" name="myId">
					<h2>
						Offer Sheet Approval for {{$result->code}}
						<div class="switch"><label>Accept<input name='checkboxReject' type="checkbox" id="checkboxReject" value="ad"><span class="lever switch-col-red"></span>Reject</label></div>
						<div class="form-group">
							<label class="control-label">Remarks*</label>
							<textarea class="form-control form-line" name="header_remarks" value=""></textarea>
						</div>
					</h2>
				</div>
				Lessor: {{$result->name}}
				<div class="body">
					<table class="table table-hover dataTable" id="myTable">
						<thead>
							<tr>
								<th class="align-center">Offer Sheet Detail</th>
								<th class="align-center">Registration Detail</th>
								<th class="align-center">Unit Offered</th>
								<th class="align-center">Building Type Offered</th>
								<th class="align-center">Size Offered</th>
								<th class="align-center">Unit Type Offered</th>
								<th class="align-center">Floor Offered</th>
								<th class="align-center">Action</th>


							</tr>
						</thead>
						<tbody id="myList">

						</tbody>
					</table>
					<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> SAVE</span></button>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetApprovalShowAjax.js")!!}
<script type="text/javascript">
	dataurl='{{route('offerSheetApproval.index')}}/get/showData/{{$result->id}}';
</script>
@endsection
