@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">{{$tenant->description}}</h2>
		</div>
		
	</div>
	{{  Form::open(array('route' => 'offersheets.store'))}}
	<div class="row clearfix">
		<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-col-green">
					<div class="modal-header">
						<h1 id="label" class="modal-title align-center p-b-15">Choose from these units<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
					</div>
					<div class="modal-body">
						<div id='divOptions'>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSelect" value="add"><i class="mdi-content-save"></i><span id="lblButton"> Select</span></button>
						<input type="hidden" id="myId" value="0">
					</div>

				</div>

			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header align-center">
					<h2>
						Unit Offers for {{$tenant->description}}
					</h2>
				</div>
				<div class="body">
					<table class="table table-hover dataTable" id="myTable">
						<thead>
							<tr>
								<th class="align-center">Registration Detail</th>
								<th class="align-center">Preferred Building Type</th>
								<th class="align-center">Preferred Unit Size Range</th>
								<th class="align-center">Preferred Unit Type</th>
								<th class="align-center">Preferred Floor</th>
								<th class="align-center">Unit Offer</th>
								<th class="align-center">Unit Rate</th>
								<th class="align-center">Action</th>

							</tr>
						</thead>
						<tbody id="myList">

						</tbody>
					</table>
				</div>
				<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> Generate Offer Sheet</span></button>
			</div>
		</div>
	</div>
	{{Form::close()}}
</div>
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetShowAjax.js")!!}
<script type="text/javascript">
	url='{{route('offersheets.index')}}';
	dataurl='{{route('offersheets.index')}}/get/showData/{{$tenant->id}}';
</script>
@endsection