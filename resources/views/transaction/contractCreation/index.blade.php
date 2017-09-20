@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{url('/admin')}}"><i class="mdi-action-home"></i> Home</a></li>
  <li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
  <li><a><i class="mdi-action-assignment"></i> Contracts</a></li>
  <li><a href="{{route("contract-create.index")}}"> New Contract</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">REGISTRATION CODE</th>
        <th class="align-center">Client</th>
        <th class="align-center">Business</th>
        <th class="align-center">Unit requested</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/contractCreationAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('contract-create.getData')!!}" ;
  var url="{!!route('contract-create.index')!!}" ;
</script>
@endsection
