@extends('layout.coreLayout')
@section('content')

<div>
	

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-brown hover-expand-effect">
			<div class="icon">
				<i class="mdi-action-assignment"></i>
			</div>
			<div class="content">
				<div class="text">PENDING REGISTRATIONS</div>
				<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$count->registration}}</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-brown hover-expand-effect">
			<div class="icon">
				<i class="mdi-action-account-circle"></i>
			</div>
			<div class="content">
				<div class="text">ACTIVE TENANTS</div>
				<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$count->tenant}}</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-brown hover-expand-effect">
			<div class="icon">
				<i class="mdi-communication-business"></i>
			</div>
			<div class="content">
				<div class="text">VACANT UNITS</div>
				<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$count->unit}}</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-brown hover-expand-effect">
			<div class="icon">
				<i class="mdi-action-credit-card"></i>
			</div>
			<div class="content">
				<div class="text">UNSETTLED ACCOUNTS</div>
				<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$count->billing}}</div>
			</div>
		</div>
	</div>

	<div class="row clearfix">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="header">
					<h2>AVERAGE MARKET RATE</h2>
				</div>
				<div class="body jumbotron">
					<div class="align-center">
						<h1>{{$average}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<!-- Visitors -->
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="card">
				<div class="body bg-brown">
					<div class="m-b--35 font-bold">RECENTLY ADMITTED TENANTS</div>
					<ul class="dashboard-stat-list">
						@foreach($list->tenant as $tenant)
						<li>
							<span><b>{{$tenant->tenant}}</b></span>
							<span class="pull-right">{{$tenant->business}}</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<!-- #END# Visitors -->
		<!-- Latest Social Trends -->
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="card">
				<div class="body bg-brown">
					<div class="m-b--35 font-bold">RECENTLY OFFERED UNITS</div>
					<ul class="dashboard-stat-list">
						@foreach($list->unit as $unit)
						<li>
							<span><b>{{$unit->unit}}</b></span>
							<span class="pull-right">{{$unit->building}}</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<!-- #END# Latest Social Trends -->
		<!-- Answered Tickets -->
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="card">
				<div class="body bg-brown">
					<div class="font-bold m-b--35">COLLECTION DUE</div>
					<ul class="dashboard-stat-list">
						@foreach($list->collection as $collection)
						<li>
							<span><b>{{$collection->code}}</b></span>
							<span class="pull-right">{{$collection->date_issued}}</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<!-- #END# Answered Tickets -->
	</div>
</div>
@endsection
