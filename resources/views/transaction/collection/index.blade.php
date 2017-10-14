@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a> Transaction</a></li>
	<li><a> Billing and Collection</a></li>
	<li><a href="{{route('collection.index')}}">Collection</a></li>
</ol>
@endsection
@section('content')
<!--CHANGE MODAL-->
<div class="modal fade" id="modalBalance" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content modal-col-green">
			<div class="modal-header">
				<h2 class="modal-title align-center p-b-15 p-l-35">COLLECTION<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
			</div>
			<div class="modal-body align-center">
				Your Change:₱  <span id='txtChange'></span>
				<p>What would you like to do with your change?</p>
			</div>
			<div class="modal-footer align-center">
				{{ Form::open([
					'id' => 'frmBalance', 'class' => 'form-horizontal'
				])
			}}
			{{ Form::hidden('balance',null,[
				'id' => 'balance'
			])
		}}
		{{ Form::hidden('user',null,[
			'id' => 'user'
		])
	}}
	<a class="btn btn-lg bg-orange waves-effect waves-white" data-dismiss="modal">KEEP IT</a>
	<button id="btnBalance" type="submit" class="btn btn-lg bg-light-green waves-effect waves-white"> ADD TO YOUR ACCOUNT</button>
	{{Form::close()}}
</div>
</div>
</div>
</div>
<!--CHANGE MODAL-->
<div class="body">
	{{-- modal collection starts here --}}
	<div class="modal fade" id="modalCollection" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content modal-col-green">
				{{ Form::open([
					'id' => 'frmCollection', 'class' => 'form-horizontal'
				])
			}}
			{{ Form::hidden('change',null,[
				'id' => 'change'
			])
		}}
		{{ Form::hidden('myId',null,[
			'id' => 'myId'
		])
	}}
	{{ Form::hidden('pdc_id',null,[
		'id' => 'pdc_id'
	])
}}
<div class="modal-header">
	<h1  class="modal-title align-center p-b-15"><span>Collect Payment</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
</div>
<div class="modal-body">
	<div id='divCollect' class="col-sm-6">
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<div id='divBank' class="col-sm-6 form-line">
			</div>
			Mode of payment
			<div class="form-line col-sm-6" id='idSelect'>

			</div>
			<div class="col-sm-6">
				Date Collected
			</div>
			<div class="form-line col-sm-6">
				<input class="form-control align-center" type="date" required=""  name="dateCollected"> <br>  
			</div>
			<div class="col-sm-6">
				Amount Collected
			</div>
			<div class="input-group" class="col-sm-6">
				<span class="input-group-addon">
					₱
				</span>
				<div class="form-line">
					{{ Form::text('txtAmount',null,[
						'id'=> 'txtAmount',
						'class' => 'form-control text-center',
						'autocomplete' => 'off',
						'required' => 'required',
						'data-parsley-type' => 'number',
						'max' => '1000000',
						'min' => '1000'
					])
				}}
			</div>
		</div>

	</div>
</div>
</div>
<div class="modal-footer m-t--30">
	<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> Collect payment</span></button>
</div>
{{Form::close()}}
</div>
</div>
</div>
{{-- modal collection ends here --}}
<table class="table table-hover dataTable" id="myTable">
	<thead>
		<tr>
			<th class="align-center">TENANT</th>
			<th class="align-center">BILLING CODE</th>
			<th class="align-center">AMOUNT DUE</th>
			<th class="align-center">AMOUNT PAID</th>
			<th class="align-center">ACTION</th>
		</tr>
	</thead>
	<tbody id="myList">
	</tbody>
</table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/collectionAjax.js")!!}
<script type="text/javascript">
	var dataurl="{!!route('collection.getData')!!}" ;
	var url="{!!route('collection.index')!!}" ;
	var bankUrl="{!!route('custom.getBanks')!!}" ;
</script>
@endsection
