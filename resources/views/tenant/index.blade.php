@extends('layouts.tenantLayout')
@section('content')
@foreach($urgent as $notif)
<div class="card">
	<div class="header bg-red">
		<h2>
		{{$notif->title}}
		</h2>
	</div>
	<div class="body">
		{{$notif->description}}
	</div>
</div>
@endforeach
@endsection
@section('styles')
@endsection