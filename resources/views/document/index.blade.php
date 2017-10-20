@extends('layouts.tenantLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Document</a></li>
	<li><a> {{$document->title}}</a></li>
	<li><a href="{{$document->url}}"> {{$document->code}}</a></li>
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

