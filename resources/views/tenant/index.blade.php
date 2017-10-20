@extends('layouts.tenantLayout')
@section('breadcrumbs')
<h4 class = 'align-center'>Dashboard</h4>
@endsection
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

<!-- TODO pull data -->
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box-4 hover-zoom-effect">
			<div class="icon">
				<i class="material-icons col-blue">assignment</i>
			</div>
			<div class="content">
				<div class="text">Contracts</div>
				<div class="number">15</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box-4 hover-zoom-effect">
			<div class="icon">
				<i class="material-icons col-blue">home</i>
			</div>
			<div class="content">
				<div class="text">Units</div>
				<div class="number">15</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('styles')
@endsection