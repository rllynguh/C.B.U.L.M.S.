@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route('move-in.index')}}"> Move in</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">CONTRACT CODE</th>
        <th class="align-center">CLIENT</th>
        <th class="align-center">BUSINESS</th>
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
{!!Html::script("custom/moveInAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('move-in.getData')!!}" ;
  var url="{!!route('move-in.index')!!}" ;
</script>
@endsection
