@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{url('/tenant')}}"> Home</a></li>
  <li><a> Transaction</a></li>
  <li><a href="{{route("registrationForfeit.index")}}"> Regisration Forfeit</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">Registration Code</th>
        <th class="align-center">Duration Preferred</th>
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
{!!Html::script("custom/registrationForfeitAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('registrationForfeit.getData')!!}" ;
  var url="{!!route('registrationForfeit.index')!!}" ;
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>
@endsection
