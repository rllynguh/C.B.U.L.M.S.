@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">

	<li><a> Transaction</a></li>
	<li><a href="{{route("registrationApproval.index")}}"> Registration Approval</a></li>
	<li><a href="javascript:void(0);"> {{$tenant->code}}</a></li>

</ol>
@endsection
@section('content')
<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-col-green">
			<div class="modal-header">
				<h1 id="label" class="modal-title align-center p-b-15">REGISTRATION APPROVAL<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
			</div>
			<div class="modal-body">
				<p class="align-center"> Do you want to accept this unit registration?</p>
				
				<div id='regi_info'>
					{{-- used in javascript. don't delete --}}
				</div>
			</div>
			<div class="modal-footer">
				<button type='button' id='btnAccept' class='btn bg-light-green waves-effect waves-float'>ACCEPT</button>
				<button type='button' id='btnReject' class='btn bg-orange waves-effect waves-float'>REJECT</button>
			</div>
		</div>

	</div>
</div>
<div class="body">
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'registrationApproval.store'
		])}}
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
			<div class="col-sm-12">
				@foreach($results as $key =>$result)
				@if($key%2==0)
				<div>
					@endif
					<div class="col-sm-6">
						<div class="thumbnail">
							<div class="caption">
								<h2 class="align-center">{{$result->code}}</h2>
								<p class="align-center"><img src="{{ asset('images/units/'.$result->picture) }}"></p>
								<h3>Registration Detail # {{$result->id}}</h3>
								<b>Building type: </b> {{$result->building_type}}<br>
								<b>Unit type: </b>{{$result->unit_type}}<br>
								<b>Size: </b>{{$result->size}}<br>
								<b>Floor: </b>{{$result->floor}}<br>
								<b>Price: </b>{{$result->price}}<br>
								<b>Location: </b>{{$result->address}}<br>
								<b>Remarks: </b>{{$result->tenant_remarks}}<br>
								<b>Status: </b><span id='lblStatus{{$result->id}}'>Accepted</span><br>
								<div class="align-right">
									<button type='button' id='status{{$result->id}}' class='btn bg-light-green btn-lg waves-effect waves-float btnChoose' value='{{$result->id}}'>APPROVAL</button>
								</div>
								<input type='hidden' value='{{$result->id}}' name='regi_id[]'>
								<input type='hidden' name='regi_is_active[]' id='regi{{$result->id}}'value='0'><input id='remarks{{$result->id}}' type='hidden' name='detail_remarks[]'>
							</div>
						</div>
					</div>
					@if($key%2!=0)
				</div>
				@endif
				<div>
					@endforeach
				</div>
				<div class="col-sm-12">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class="form-group align-left">
							<div class="form-line">
								<label>Remarks</label>
								<textarea name='header_remarks' rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</fieldset>
			{{Form::close()}}
		</div>
		@endsection
		@section('scripts')
		{!!Html::script("js/pages/forms/form-wizard.min.js")!!}
		{!!Html::script("plugins/autosize/autosize.min.js")!!}
		{!!Html::script("custom/registrationApprovalShowAjax.min.js")!!}
		<script type="text/javascript">
			mainUrl='{{route('registrationApproval.index')}}';
			showUrl='{{route('registrationApproval.index')}}/{{$tenant->id}}';
			header_remarks="{{$tenant->tenant_remarks}}";
		</script>
		@endsection
