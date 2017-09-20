@extends('layout.coreLayout')
@section('content')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{url('/tenant')}}"><i class="mdi-action-home"></i> Home</a></li>
  <li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
  <li><a><i class="mdi-action-assignment"></i> Contracts</a></li>
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
{!!Html::script("custom/contractViewAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('contract.getData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
</script>
@endsection
