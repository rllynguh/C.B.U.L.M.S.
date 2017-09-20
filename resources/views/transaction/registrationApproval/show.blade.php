@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">

	<li><a href="{{url('/admin')}}"><i class="mdi-action-home"></i> Home</a></li>
	<li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
	<li><a href="{{route("registrationApproval.index")}}"><i class="mdi-action-assignment-turned-in"></i> Registration Approval</a></li>
	<li><a href="javascript:void(0);"> {{$tenant->code}}</a></li>

</ol>
@endsection
@section('content')
<div class="body">
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'registrationApproval.store'
		])}}
		<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-col-green">
					<div class="modal-header">
						<h1 id="label" class="modal-title align-center p-b-15">What would you like to do with this item?<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
					</div>
					<div class="modal-body">
						<b>Representative: </b>{{$tenant->name}}
						<br>
						<b>Company: </b>{{$tenant->tenant}}
						<div id='regi_info'>
							{{-- used in javascript. don't delete --}}
						</div>
						<div><b>Remarks: </b></div>
					</div>
					<div class="modal-footer">
						<div class="form-group">
							<div class="form-line">
								<textarea id='detail_remarks' placeholder="Remarks" rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
							</div>
						</div>
						<button type='button' id='btnAccept' class='btn bg-blue waves-effect waves-float'>Accept</button>
						<button type='button' id='btnReject' class='btn bg-brown waves-effect waves-float'>Reject</button>
					</div>
				</div>

			</div>
		</div>
		<input type="hidden" value="{{$tenant->id}}" name="myId">
		<input type='hidden' name='header_is_active' id='header_is_active' value="1">
		<h3>Tenant Information</h3>
		<fieldset>
			<div class="col-sm-6">
				<div class="thumbnail">
					<img class="img-circle" 
					src="{{ asset('images/users/'.$tenant->picture)}} " class="user-image" height="100" width="100" alt="User Image">
					<div class="caption">
						<h3 id="dispName">{{$tenant->name}}</h3>
						<h6 id="dispPosition">{{$tenant->position}}</h6>
						<p id="dispCompany">{{$tenant->tenant}}</p> 
						<p id="dispBusiness">{{$tenant->business}}</p>  
						<p id="dispCompAddress">{{$tenant->address}}</p> 
						<p id="dispCell">{{$tenant->cell_num}}</p> 
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<h2>{{$tenant->code}}</h2>
				<h2>Date Registered: {{$tenant->date_issued}}</h2>
				<h2>Remarks: {{$tenant->tenant_remarks}}</h2>
				<h2>Desired Duration:
					{{$tenant->duration_preferred }}
					@if($tenant->duration_preferred>1)
					years
					@else
					year
					@endif
				</h2>
			</div>
		</fieldset>

		<h3>Unit(s) Requested</h3>
		<fieldset>
			@for($x=0;$x<count($results);$x++)
			@if($x%3==0)
			<div>
				@endif
				<div class="thumbnail col-sm-4">
					<div class="caption">
						<h3>Registration Detail # {{$results[$x]->id}}</h3>

						<b>Desired Building type: </b> {{$results[$x]->description}}<br>
						<b>Desired Unit type: </b>{{$results[$x]->unit_type}}<br>
						<b>Desired Size: </b>{{$results[$x]->size_range}}<br>
						<b>Desired Floor: </b>{{$results[$x]->floor}}<br>
						<b>Status: </b><span id='lblStatus{{$results[$x]->id}}'>Accepted</span><br>

						<button type='button' id='status{{$results[$x]->id}}' class='btn bg-blue btn-lg waves-effect waves-float btnChoose' value='{{$results[$x]->detail_id}}'><i class='mdi-action-visibility'></i> Show Details</button>
						<input type='hidden' value='{{$results[$x]->detail_id}}' name='regi_id[]'>
						<input type='hidden' name='regi_is_active[]' id='regi{{$results[$x]->detail_id}}'value='0'><input id='remarks{{$results[$x]->detail_id}}' type='hidden' name='detail_remarks[]'>
					</div>
				</div>
				@if($x%3!=0)
			</div>
			@endif
			<div>
				@endfor
			</fieldset>
			<h3>Finalization</h3>
			<fieldset>
				Remarks:
				<div class="form-group">
					<div class="form-line">
						<textarea name='header_remarks' rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
					</div>
				</div>
			</fieldset>
			{{Form::close()}}
		</div>
		@endsection
		@section('scripts')
		{!!Html::script("plugins/autosize/autosize.min.js")!!}
		{!!Html::script("custom/registrationApprovalShowAjax.js")!!}
		<script type="text/javascript">
			mainUrl='{{route('registrationApproval.index')}}';
			showUrl='{{route('registrationApproval.index')}}/get/showData/{{$tenant->id}}';
			header_remarks="{{$tenant->tenant_remarks}}";
		</script>
		@endsection
