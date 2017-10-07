@extends('layout.coreLayout')
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
        <th class="align-center">CONTRACT</th>
        <th class="align-center">LESSOR</th>
        <th class="align-center">NUMBER OF UNITS</th>
        <th class="align-center">DATE ISSUED</th>
        <th class="align-center">ACTION</th>
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
</script>
@endsection
