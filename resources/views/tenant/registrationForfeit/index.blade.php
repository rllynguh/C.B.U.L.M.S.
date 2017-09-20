@extends('layout.tenantNav')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{url('/tenant')}}"><i class="mdi-action-home"></i> Home</a></li>
  <li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
  <li><a href="{{route("registrationForfeit.index")}}"><i class="mdi-action-delete"></i> Regisration Forfeit</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">Registration Code</th>
        <th class="align-center">Duuration Preferred</th>
        <th class="align-center">Unit requested</th>
        <th class="align-center">Date Requested</th>
        <th class="align-center">Remarks</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/registrationForfeitAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('registrationForfeit.getData')!!}" ;
  var url="{!!route('registrationForfeit.index')!!}" ;
</script>
@endsection
