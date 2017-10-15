@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route('transaction.amendmentApproval.index')}}">Amendment Approval</a></li>
</ol>
@endsection
@section('content')
<div class="card">
  <div class="body">
    <table class="table table-hover dataTable" id="myTable">
      <thead>
        <tr>
        </tr>
      </thead>
      <tbody id="falala">
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script src="/custom/amendmentApprovalAjax.js"></script>
<script type="text/javascript">
var dataurl="{{route("transaction.amendmentApproval.data")}}";
</script>
@endsection