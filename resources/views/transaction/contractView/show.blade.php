@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a> Contracts</a></li>
	<li><a href="{{route("contract.show",$currentcontract->id)}}"> {{$currentcontract->code}}</a></li>
</ol>
@endsection
@section('content')
<div id='divPDF' class="body">
	<p class="align-center">{{$currentcontract->code}}</p>
	<p class="align-center">{{$currentcontract->date_issued}}</p>
	<p class="align-center">{{$currentcontract->lessor}}</p>
	<embed id='embedDiv' src="{{ asset("docs/".$currentcontract->pdf) }}" width="100%" height="500px" type='application/pdf'>
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
{{-- @section('scripts')
<script type="text/javascript">
	$(document).ready(function()
	{

		$("#divPDF").slimScroll({
			size: '8px', 
			width: '100%', 
			height: '100%', 
			color: '#ff4800', 
			allowPageScroll: true, 
			alwaysVisible: true     
		});
	});
</script>
@endsection --}}
