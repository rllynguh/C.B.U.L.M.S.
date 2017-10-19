@extends('layouts.tenantLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a> Contracts</a></li>
	<li><a href="{{route("contract.show",$currentcontract->id)}}"> {{$currentcontract->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="body">
	<h2 class="align-center">{{$currentcontract->code}}</h2>
	<h2 class="align-center">{{$currentcontract->date_issued}}</h2>
	<h2 class="align-center">{{$currentcontract->lessor}}</h2>
	<embed src="{{ asset("docs/".$currentcontract->pdf) }}" width="100%" height="700px" type='application/pdf'>
		{{  Form::open(array('route' => 'contract.store'))}}
		{{ Form::hidden('myId',$currentcontract->id,[
			'id'=> 'myId',
		])
	}}
	<input type="checkbox" id="agree" name="agree" class="filled-in chk-col-yellow">
	<label for='agree'> I have read and agree to the terms and conditions</label>
	<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12"><i class="mdi-content-save"></i><span> Submit</span></button>
	{{Form::close()}}
</div>
</div>
</div>
</div>
</div>
@endsection
