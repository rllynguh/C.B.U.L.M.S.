@extends('layouts.tenantLayout')
@section('content')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Contracts</a></li>
  <li><a href="{{route("contract.index")}}"> View Contract</a></li>
</ol>
@endsection
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">Contract</th>
        <th class="align-center">Lessor</th>
        <th class="align-center">Number of Units</th>
        <th class="align-center">Date Issued</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/contractViewAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('contract.getData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>
@endsection
