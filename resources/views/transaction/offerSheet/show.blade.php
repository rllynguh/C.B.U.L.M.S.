@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a href="{{route("offersheets.index")}}"> Offer Sheets</a></li>
	<li><a href="{{route("offersheets.show",$tenant->id)}}"> {{$tenant->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-col-green">
			<div class="modal-header">
				<h1 id="label" class="modal-title align-center p-b-15">CHOOSE FROM THESE UNITS<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
			</div>
			<div class="modal-body">
				<div id='divOptions'>

				</div>
			</div>
			<div class="modal-footer">
				<button id='btnSelect' type='button' class='btn bg-brown btn-lg waves-effect  waves-float col-lg-12 col-md-12 col-sm-12' >SELECT</button>
				<input type="hidden" id="myId" value="0">
			</div>
		</div>
	</div>
</div>
<div class="body">
	<i class="mdi-navigation-close"></i>
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'offersheets.store'
		])}}
		<h3>Tenant Information</h3>
		<fieldset>
			<div class="col-sm-6">
				<div class="thumbnail">
					<img class="img-circle" 
					src="{{ asset('images/users/'.$tenant->picture)}} " class="user-image" height="100" width="100" alt="User Image">
					<div class="caption">
						<h3 id="dispName">{{$tenant->tenant_name}}</h3>
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
				<h2>Approved by: {{$tenant->admin_name}}</h2>
			</div>
		</fieldset>
		<h3>Unit Requested</h3>
		<fieldset>
			@for($x=0;$x<count($results);$x++)
			@if($x%3==0)
			<div>
				@endif
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="thumbnail">
						<div class="caption">
							<h3>Registration Detail # {{$results[$x]->id}}</h3>

							<b>Unit: </b><span id='regi{{$results[$x]->id}}'>{{$results[$x]->unit_code}}</span><br>
							<b>Building type: </b> <span id='buildingType{{$results[$x]->id}}'>{{$results[$x]->description}}</span><br>
							<b>Unit type: </b><span id='unitType{{$results[$x]->id}}'>{{$results[$x]->unit_type}}</span><br>
							<b>Size: </b><span>{{$results[$x]->size_range}}</span><br>
							<b>Desired Floor: </b><span id='floor{{$results[$x]->id}}'>{{$results[$x]->floor}}</span><br>
							<b>Price: </b><span id='rate{{$results[$x]->id}}'>{{$results[$x]->rate}}</span><br>
							<b>Remarks: </b><span>{{$results[$x]->tenant_remarks}}</span><br>

							<input type='hidden' name='detail_id[]' value='{{$results[$x]->id}}'>
							<input type='hidden' name='offer_id[]' id='offer{{$results[$x]->id}}' value='{{$results[$x]->unit_id}}'>
							<div class="align-right">
								<button id='btnChoose' type='button' class='btn bg-light-green btn-lg waves-effect  waves-float' value='{{$results[$x]->id}}'><i class='mdi-content-add'></i>Choose Unit</button>
							</div>
						</div>
					</div>
				</div>
				@if($x%3!=0)
			</div>
			@endif
			<div>
				@endfor
			</fieldset>
			{{Form::close()}}
		</div>
		@endsection
		@section('scripts')
		{!!Html::script("custom/offerSheetShowAjax.js")!!}
		<script type="text/javascript">
			url='{{route('offersheets.index')}}';
			dataurl='{{route('offersheets.index')}}/get/showData/{{$tenant->id}}';
		</script>
		@endsection