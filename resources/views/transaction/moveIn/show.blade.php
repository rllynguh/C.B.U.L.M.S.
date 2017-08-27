@extends('layout.coreLayout')
@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Move In Form</h2>
			</div>
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
						<input type="checkbox" value="{{$unit->id}}" name="units[]"> {{$unit->code}}<br>	
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
			</div>
		</div>
	</div>
	@endsection