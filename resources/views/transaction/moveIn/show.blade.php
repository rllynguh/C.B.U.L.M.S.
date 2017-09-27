@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a href="{{route('move-in.index')}}"> Move in</a></li>
	<li><a href="{{route('move-in.show',$contract->id)}}"> {{$contract->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="body">
	{{Form::open([
		'id' => 'wizard_with_validation',
		'route' => 'move-in.store'
		])}}
		<h3>Contract Information</h3>
		<fieldset>

			<div class="col-sm-6">
				<div class="thumbnail">
					<img class="img-circle" 
					src="{{ asset('images/users/'.$contract->picture)}} " class="user-image" height="100" width="100" alt="User Image">
					<div class="caption">
						<h3 id="dispName">{{$contract->name}}</h3>
						<h6 id="dispPosition">{{$contract->position}}</h6>
						<p id="dispCompany">{{$contract->tenant}}</p> 
						<p id="dispBusiness">{{$contract->business}}</p>  
						<p id="dispCompAddress">{{$contract->address}}</p> 
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<h2>{{$contract->code}}</h2>
				<h2>Contract Number: {{$contract->contract_header_code}}</h2>
				<h2>Contract Duration:
					{{$contract->duration }}
					@if($contract->duration>1)
					years
					@else
					year
					@endif
				</h2>
			</div>
		</fieldset>
		<h3>Unit</h3>
		<fieldset>
			@foreach($units as $key=>$unit)
			@if($key%2==0)
			<div>
				@endif
				<div class="col-sm-6">
					<div class="card">
						<div class="header bg-light-green">
							<input id='unit{{$unit->id}}' type='checkbox' class="filled-in chk-col-blue" type='checkbox' name='units[]' value="{{$unit->id}} ">
							<label for='unit{{$unit->id}}'><h4>{{$unit->code}}</h4></label> <br>
						</div>
						<div class="body">
							<div id="labels" class="col-sm-6">
								<b>Building Type: </b><br>
								<b>Building Name: </b><br>
								<b>Address: </b><br> 
								<b>Unit Type : </b><br> 
								<b>Floor : </b><br> 
								<b>Size : </b><br> 
							</div> 
							<div id="details" class="align-right" > 
								{{$unit->building_type}}   <br> 
								{{$unit->building}}   <br> 
								{{$unit->address}}   <br> 
								{{$unit->unit_type}}   <br> 
								{{$unit->floor}}   <br> 
								{{$unit->unit_size}}   <br> 
							</div>
						</div>
					</div> 
				</div>;
				@if($key%2!=0)
			</div>
			@endif
			@endforeach
		</fieldset>
		<h3>Finalization</h3>
		<fieldset>
			<div class="col-sm-3">	</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="header bg-light-green">
						<center><h4>DETAILS</h4></center>
					</div>	
					<div class="body">		
						<div class="form-group">
							<div class="form-group p-l-30">
								<div class="form-line">
									<label for="date">Date Moved</label>
									<input id='date' class="form-control align-center" type="date" required=""  name="dateMovedIn"> <br>	
								</div>
							</div>
						</div>
						<div>
							<div class="align-left form-group p-l-30">
								<div class="form-line">
									<label for='remarks'>Remarks</label>
									<textarea id='remarks' name='remarks' rows="1" class="form-control no-resize auto-growth" style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">	</div>
		</fieldset>
		{{ Form::hidden('id',$contract->id,[
			])
		}}
		{{Form::close()}}

	</div>
	@endsection