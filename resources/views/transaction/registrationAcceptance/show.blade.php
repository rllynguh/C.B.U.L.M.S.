@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">Registration Acceptance</h2>
		</div>
		
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				{{  Form::open(array('route' => 'registration-acceptance.store'))}}
				<div class="header align-center">
					<input type="hidden" value="{{$tenant->id}}" name="myId">
					<h2>
						{{$tenant->code}}
						<div class="switch"><label>Accept<input name='checkboxReject' type="checkbox" id="checkboxReject" value="ad"><span class="lever switch-col-red"></span>Reject</label></div>
					</h2>
				</div>

				Representative: {{$tenant->name}}
				<br>
				Company: {{$tenant->description}}
				<div class="body">
					<table class="table table-hover dataTable" id="myTable">
						<thead>
							<tr>
								<th class="align-center">Registration Detail</th>
								<th class="align-center">Preferred Building Type</th>
								<th class="align-center">Preferred Unit Size Range</th>
								<th class="align-center">Preferred Unit Type</th>
								<th class="align-center">Preferred Floor</th>
								<th class="align-center">Action</th>

							</tr>
						</thead>
						<tbody id="myList">
							
						</tbody>
					</table>
					<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> SAVE</span></button>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/registrationAcceptanceShowAjax.js")!!}
<script type="text/javascript">
	url='{{route('registration-acceptance.index')}}/get/showData/{{$tenant->id}}';
</script>
@endsection
