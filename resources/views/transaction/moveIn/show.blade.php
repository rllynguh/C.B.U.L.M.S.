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
			Contract : {{$contract->code}}
			<br>				
			Client : {{$contract->tenant}}
			<br>		
			Business Type : {{$contract->business_type}}
			<br>	
			Contract Duration : {{$contract->duration}}
			<br>	
		</fieldset>
		<h3>Unit</h3>
		<fieldset>
			Choose from these units: <br>
			@foreach($units as $unit)
			<input type="checkbox" id="{{$unit->code}}" name="units[]" value="{{$unit->id}}" class="filled-in chk-col-yellow">
			<label for='{{$unit->code}}'> {{$unit->code}}</label> <br>
			@endforeach
		</fieldset>
		<h3>Finalization</h3>
		<fieldset>
			Date Moved
			<div class="form-group p-l-30">
				<div class="form-line">
					<input class="form-control align-center" type="date" required=""  name="dateMovedIn"> <br>	
				</div>
			</div>
			Remarks	
			<div class="form-group p-l-30">
				<div class="form-line">
					<textarea class="form-control align-center" name="remarks"></textarea>
				</div>
			</div>
		</fieldset>
		{{ Form::hidden('id',$contract->id,[
			])
		}}
		{{Form::close()}}

	</div>
	@endsection