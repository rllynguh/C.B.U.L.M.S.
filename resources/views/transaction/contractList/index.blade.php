@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Contracts</a></li>
  <li><a href="{{route("contractList.index")}}">Contract List</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">CODE</th>
        <th class="align-center">CLIENT</th>
        <th class="align-center">BUSINESS</th>
        <th class="align-center">PERIOD OF CONTRACT</th>
        <th class="align-center">ACTION</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/contractListAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('contractList.getData')!!}" ;
</script>
@endsection
