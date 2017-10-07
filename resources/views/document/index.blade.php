@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Document</a></li>
	<li><a> Reservation Fee Receipt</a></li>
	<li><a href="{{route("docs.reservation-fee-receipt",$document->id)}}"> {{$document->code}}</a></li>
</ol>
@endsection
@section('content')
<div id='divPDF' class="body">
	<embed id='embedDiv' src="{{ asset("docs/".$document->pdf) }}" width="100%" height="500px" type='application/pdf'>
	</div>
</div>
</div>
</div>
</div>
@endsection

