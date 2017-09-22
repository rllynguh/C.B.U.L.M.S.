@extends('layout.coreLayout')
@section('content')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route("offerSheetApproval.index")}}"> Offer Sheet Approval</a></li>
</ol>
@endsection
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">OFFER SHEET CODE</th>
        <th class="align-center">REGISTRATION CODE</th>
        <th class="align-center">LESSOR</th>
        <th class="align-center">Date PROPOSED</th>
        <th class="align-center">UNITS OFFERED</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetApprovalAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('offerSheetApproval.getData')!!}" ;
  var url="{!!route('offerSheetApproval.index')!!}" ;
</script>
@endsection
