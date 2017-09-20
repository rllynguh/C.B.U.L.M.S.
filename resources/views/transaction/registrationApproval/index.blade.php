@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{url('/admin')}}"><i class="mdi-action-home"></i> Home</a></li>
  <li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
  <li><a href="{{route("registrationApproval.index")}}"><i class="mdi-action-assignment-turned-in"></i> Registration Approval</a></li>
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
{!!Html::script("custom/registrationApprovalAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('registrationApproval.getData')!!}" ;
  var url="{!!route('registrationApproval.index')!!}" ;
</script>
@endsection
