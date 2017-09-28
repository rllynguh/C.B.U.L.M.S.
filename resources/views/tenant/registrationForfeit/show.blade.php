@extends('layouts.tenantLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a href="{{route("registrationForfeit.index")}}"> Regisration Forfeit</a></li>
	<li>
		<a href="{{route("registrationForfeit.show",$registration->id)}}"> {{$registration->regi_code}}</a></li>
	</ol>
	@endsection
	@section('content')
	<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-green">
				<div class="modal-header-delete">
					<h1 id="label" class="modal-title align-center p-b-15">REGISTRATION FORFEIT<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
				</div>
				<div class="modal-body">	
					<p>Are you sure you want to forfeit this registration detail?</p>
				</div>
				<div class="modal-footer">
					<button id="btnForfeit" type="button" class="btn btn-lg bg-red waves-effect waves-white col-md-12 col-sm-12"> FORFEIT</button>
				</div>
			</div>

		</div>
	</div>
	<div class="body">
		{{Form::open([
			'id' => 'wizard_with_validation',
			'route' => 'registrationForfeit.store'
			])}}

			<input type="hidden" value="{{$registration->id}}" name="myId">
			<input type='hidden' name='header_is_active' id='header_is_active' value="0">
			<h3>Tenant Information</h3>
			<fieldset>
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="card">
						<div class="header bg-light-green">
							<center>
								<h4>
									{{$registration->regi_code}}
								</h4>
							</center>
						</div>
						<div class="body">
							<div class="col-sm-6">
								<h5>Registration Code:</h5> 
								<h5>Date Registered:</h5> 
								<h5>
									@if($registration->unit_count>1)
									Units
									@else
									Unit	
									@endif
								</h5>  
							</div>
							<div class="align-right">
								<h5>{{$registration->regi_code}}   </h5>
								<h5>	{{$registration->regi_date}} </h5>
								<h5>	{{$registration->unit_count}} </h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</fieldset>

			<h3>Unit(s) Requested</h3>
			<fieldset>
				<div class="col-sm-12">
					@foreach($results as $key => $result)
					@if($key%3==0)
					<div>
						@endif
						<div class="col-sm-4">
							<div class="thumbnail">
								<div class="caption">
									<h3>Registration Detail # {{$result->id}}</h3>
									<b>Desired Building type: </b> {{$result->description}}<br>
									<b>Desired Unit type: </b>{{$result->unit_type}}<br>
									<b>Desired Size: </b>{{$result->size_range}}<br>
									<b>Desired Floor: </b>{{$result->floor}}<br>
									<b>Status: </b><span id='lblStatus{{$result->id}}'>Active</span><br>
									<div class="align-right">
										<button type='button' id='status{{$result->id}}' class='btn bg-orange btn-lg waves-effect waves-float btnChoose' value='{{$result->detail_id}}'>FORFEIT</button>
									</div>
									<input type='hidden' value='{{$result->detail_id}}' name='regi_id[]'>
									<input type='hidden' name='regi_is_active[]' id='regi{{$result->detail_id}}'value='0'><input id='remarks{{$result->detail_id}}' type='hidden' name='detail_remarks[]'>
								</div>
							</div>
						</div>
						@if($key%3!=0)
					</div>
					@endif
					<div>
						@endforeach
					</div>
				</fieldset>
				{{Form::close()}}
			</div>

			@endsection
			@section('scripts')
			{!!Html::script("custom/registrationForfeitShowAjax.js")!!}
			<script type="text/javascript">
				mainUrl='{{route('registrationForfeit.index')}}';
				showUrl='{{route('registrationForfeit.showData',$registration->id)}}';
			</script>
			@endsection
