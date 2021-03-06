@extends('layouts.tenantLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Contracts Extension/Renewal</a></li>
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
@include('partials.tenant._contractDetailsModal')
@endsection
@section('scripts')
{!!Html::script("custom/contractExtensionAjax.js")!!}
<script type="text/javascript">
  var urldata="{!!route("tenant.contract.extend.data")!!}";
  var urlUnits = "{!!route('tenant.getUnits')!!}";
  var urlPost = "{!!route("tenant.contract.extend.post")!!}";
</script>
@endsection
