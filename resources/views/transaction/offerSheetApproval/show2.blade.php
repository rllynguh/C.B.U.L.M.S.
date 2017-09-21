@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a href="{{url('/tenant')}}"><i class="mdi-action-home"></i> Home</a></li>
	<li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
	<li><a href="{{route("offerSheetApproval.index")}}"><i class="mdi-action-thumbs-up-down"></i> Offer Sheet Approval</a></li>
	<li><a href="{{route("offerSheetApproval.show",$results->id)}}"> {{$results->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="body">
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'offerSheetApproval.store'
		])}}
		<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-col-green">
					<div class="modal-header">
						<h1 id="label" class="modal-title align-center p-b-15">What would you like to do with this item?<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
					</div>
					<div class="modal-body">
						<div class="thumbnail">
							<img id='unit_img' class="img-circle user-image" height="100" width="100" alt="User Image">
						</div>
						Lessor: {{$results->name}}
						<br>
						<div id='myInfo'>
							{{-- used in javascript. don't delete --}}
						</div>
					</div>
					<div class="modal-footer">
						<textarea id='modal_remarks' class="form-control form-line" placeholder="remarks"></textarea>
						<button type='button' id='btnAccept' class='btn bg-blue waves-effect waves-float'>Accept</button>
						<button type='button' id='btnReject' class='btn bg-brown waves-effect waves-float'>Reject</button>
					</div>
				</div>

			</div>
		</div>
		<h3>Registration Info</h3>
		<fieldset>
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="card">
					<div class="header bg-light-green">
						<center>
							<h4>
								{{$results->regi_code}}
							</h4>
						</center>
					</div>
					<div class="body">

						<b>Registration Code:</b> {{$results->regi_code}}   <br>
						<b>Date Registered:</b> {{$results->regi_date}} <br>
						<b>Offer Sheet Code:</b> {{$results->code}}	<br>
						<b>Date Offered:</b> {{$results->offer_date}} 	 <br>
						<b>
							@if($results->unit_count>1)
							Units
							@else
							Unit	
							@endif
							Offered:</b> {{$results->unit_count}} <br>
							<b>Offered by: </b> {{$results->name}} <br>
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>

			</fieldset>
			<h3>Units Offered</h3>
			<fieldset>
				@foreach($units as $key=> $unit)
				@if($key%3==0)
				<div>
					@endif
					<div class="col-sm-4">
						<div class="thumbnail">
							<div class="caption">
								<center><h3>{{$unit->code}}</h3></center>
								<div class="col-sm-6 align-left">
									<b>Building: </b><br>
									<b>Address: </b><br><br>
									<b>Unit type: </b><br>
									<b>Size: </b><br>
									<b>Floor: </b><br>
									<b>Price: </b><br>
									<b>Status: </b><br>
								</div>
								<div class="col-sm-6 align-right">
									{{$unit->building}}<br>
									{{$unit->address}}<br>
									{{$unit->type}}<br>
									{{$unit->size}}<br>
									{{$unit->floor}}<br>
									{{$unit->price}}<br>
									<span id='lblStatus{{$unit->id}}'>Accepted</span><br>
								</div>
								<button type='button' id='status{{$unit->id}}' class='btn bg-blue btn-lg waves-effect waves-float btnChoose p-t-10' value='{{$unit->id}}'><i class='mdi-action-visibility'></i> Show Details</button>
								<input type='hidden' value='{{$unit->id}}' name='offer_id[]'>
								<input type='hidden' name='offer_is_active[]' id='offer{{$unit->id}}'value='1'><input id='remarks{{$unit->id}}' type='hidden' name='offer_remarks[]'>
							</div>
						</div>
					</div>
					@if($key%3!=0)
				</div>
				@endif
				<div>
					@endforeach
				</fieldset>
				<h3>Finalization</h3>
				<fieldset>
					Remarks:
					<div class="form-group">
						<div class="form-line">
							<textarea name='header_remarks' rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
						</div>
					</div>
					<input type="hidden" value="{{$results->id}}" name="myId">
					<input type='hidden' name='header_is_active' id='header_is_active' value="1">
				</fieldset>
				{{Form::close()}}
			</div>
			@endsection
			@section('scripts')
			{!!Html::script("custom/offerSheetApprovalShowAjax2.js")!!}
			<script type="text/javascript">
				mainUrl='{{route('offerSheetApproval.index')}}';
				dataurl='{{route('offerSheetApproval.index')}}/get/showData/{{$results->id}}';
				header_remarks="{{$results->tenant_remarks}}";
				dir='{{ asset('images/units/')}}';
			</script>
			@endsection
