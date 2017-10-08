@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route($route)}}"> {{$routeName}}</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">REGISTRATION CODE</th>
        <th class="align-center">CLIENT</th>
        <th class="align-center">BUSINESS</th>
        <th class="align-center">UNIT REQUESTED</th>
        <th class="align-center">ACTION</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/registrationApprovalAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route($test)!!}" ;
  var url="{!!route('registrationApproval.index')!!}" ;
</script>
@endsection
