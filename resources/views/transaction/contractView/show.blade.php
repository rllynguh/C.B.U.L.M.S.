@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">{{$currentcontract->code}}</h2>
			<h2 class="align-center">{{$currentcontract->date_issued}}</h2>
			<h2 class="align-center">{{$currentcontract->lessor}}</h2>
		</div>
		
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<embed src="{{ asset("docs/".$currentcontract->pdf) }}" width="100%" height="700px" type='application/pdf'>
					{{  Form::open(array('route' => 'contract.store'))}}
					{{ Form::hidden('myId',$currentcontract->id,[
						'id'=> 'myId',
						])
					}}
					<input type="checkbox" name="aggree"> i have read and agree to the terms and conditions.
					<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12"><i class="mdi-content-save"></i><span> Submit</span></button>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@endsection
