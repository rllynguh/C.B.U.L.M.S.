@extends('layouts.tenantLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a href="{{route("offerSheetApproval.index")}}"> Offer Sheet Approval</a></li>
	<li><a href="{{route("offerSheetApproval.show",$results->id)}}"> {{$results->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-col-green">
			<div class="modal-header">
				<h1 id="label" class="modal-title align-center p-b-15">OFFER SHEET APPROVAL<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
			</div>
			<div class="modal-body">
				<div class="col-sm-6">
					<div class="thumbnail">
						<img id='unit_img' class="user-image" height="200" width="200" alt="User Image">
						<div class="caption">
							<center><h4 id='unit_code'>Unit name</h4></center>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<h3>Building	</h3>
					<center><h4 id='building'>building Herer woooo</h4></center>  
					<h3>Address	</h3>
					<center><h4 id='half_address'>Address Herer woooo</h4></center>
					<center><h4 id='city_province'>Address Herer woooo</h4></center>
					<h3 >Rate</h3>
					<center><h4 id='rate'>wantawsanmilyonpesosesoses</h4></center>		
				</div>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="align-center"></th>
							<th class="align-center">REQUESTED</th>
							<th class="align-center">OFFERED</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								BUILDING TYPE	
							</td>
							<td id='offered_building_type'>
								samtin
							</td>	
							<td id='ordered_building_type'>
								samorting	
							</td>
						</tr>
						<tr>
							<td>
								UNIT TYPE	
							</td>
							<td id='ordered_unit_type'>
								samtin
							</td>	
							<td id='offered_unit_type'>
								samorting	
							</td>
						</tr>
						<tr>
							<td>
								SIZE	
							</td>
							<td id='ordered_size_range'>
								samtin
							</td>	
							<td id='offered_size'>
								samorting	
							</td>
						</tr>
						<tr>
							<td>
								FLOOR	
							</td>
							<td id='ordered_floor'>
								samtin
							</td>	
							<td id='offered_floor'>
								samorting	
							</td>
						</tr>
					</tbody>
				</table>
				<div class="col-sm-1">
				</div>
				<div class="col-sm-10">
					<div class="form-group align-left">
						<div class="form-line">
							<label class="control-label align-left">Remarks</label>
							<textarea id='modal_remarks' rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
						</div>
					</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
			<div class="modal-footer">
				<div class="col-sm-12">
					<button type='button' id='btnAccept' class='btn-lg bg-light-green waves-effect waves-float'>ACCEPT</button>
					<button type='button' id='btnReject' class='btn-lg bg-orange waves-effect waves-float'>REJECT</button>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="body">
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'offerSheetApproval.store'
		])}}
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
						<div class="col-sm-6">
							<b>Registration Code:</b> <br>
							<b>Date Registered:</b> <br>
							<b>Offer Sheet Code:</b> <br>
							<b>Date Offered:</b> <br>
							<b>
								@if($results->unit_count>1)
								Units
								@else
								Unit	
								@endif
							Offered:</b>  <br>
							<b>Offered by: </b>  <br>
						</div>
						<div class="align-right">
							{{$results->regi_code}}   <br>
							{{$results->regi_date}} <br>
							{{$results->code}}	<br>
							{{$results->offer_date}} 	 <br>
							{{$results->unit_count}} <br>
							{{$results->name}} <br>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3"></div>

		</fieldset>
		<h3>Units Offered</h3>
		<fieldset>
			<div class="col-sm-12">
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
								<div class='align-right'>
									<button type='button' id='status{{$unit->id}}' class='align-right btn bg-light-green btn-lg waves-effect waves-float btnChoose p-t-10' value='{{$unit->id}}'><i class='mdi-action-visibility'></i> Show Details</button>
								</div>
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
				</div>
				<div class="col-sm-12">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class="form-group align-left">
							<label>Remarks</label>
							<div class="form-line">
								<textarea name='header_remarks' rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
								<input type='hidden' name='header_is_active' id='header_is_active' value="1">
								<input type="hidden" value="{{$results->id}}" name="myId">

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
		{!!Html::script("custom/offerSheetApprovalShowAjax.min.js")!!}
		<script type="text/javascript">
			mainUrl='{{route('offerSheetApproval.index')}}';
			dataurl='{{route('offerSheetApproval.index')}}/get/showData/{{$results->id}}';
			header_remarks="{{$results->tenant_remarks}}";
			dir='{{ asset('images/units/')}}';
			urlbtype="{{route("custom.getBuildingType")}}";
			buil_type_url="{{route("custom.getBuildingType")}}";
			floor_url="{{route("custom.getFloor")}}";
			range_url="{{route("custom.getRange")}}";
		</script>
		@endsection