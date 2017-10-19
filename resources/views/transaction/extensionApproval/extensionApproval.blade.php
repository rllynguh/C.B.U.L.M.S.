@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Contracts</a></li>
  <li><a> Extension Approval</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@component('partials._acceptRejectModal')
<strong>Whoops!</strong> Something went wrong!
@endcomponent
@section('scripts')
{!!Html::script("custom/contractExtensionApprovalAjax.js")!!}
<script type = "text/javascript">
	var urldata="{!!route("admin.contract.extension.data")!!}";
  var urlpost="{!!route("admin.contract.extension.post")!!}"
</script>
@endsection