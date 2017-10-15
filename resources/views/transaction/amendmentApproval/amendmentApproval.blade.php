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
@include('partials.transactions._amendmentApprovalModal')
@endsection
@section('scripts')
{!!Html::script("plugins/jquery-ui-1.12.1/jquery-ui.min.js")!!} 
<script src="/custom/amendmentApprovalAjax.js"></script>
<script type="text/javascript">
var dataurl="{{route("transaction.amendmentApproval.data")}}";
var urlUnits = "{!!route('tenant.getUnits')!!}";
</script>
@endsection
@section('styles')
{!!Html::style("plugins/jquery-ui-1.12.1/jquery-ui.min.css")!!}
@endsection