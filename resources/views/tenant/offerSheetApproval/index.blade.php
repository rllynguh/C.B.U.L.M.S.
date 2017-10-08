@extends('layouts.tenantLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container">
  <div class="card">
    <div class="card-content body">
      <table class="table row-border display compact table-hover dataTable table-striped ui celled is-narrow" id="myTable">
        <thead>
          <tr>
            <th class="align-center">OFFER SHEET CODE</th>
            <th class="align-center">REGISTRATION CODE</th>
            <th class="align-center">UNITS OFFERED</th>
            <th class="align-center">ACTION</th>
          </tr>
        </thead>
        <tbody id = "myList">
        </tbody>
      </table>
    </div>
  </div> <!-- end of .card -->
</div>

@endsection
@section('scripts')
{!!Html::script("custom/offerSheetApprovalAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('offerSheetApproval.getData')!!}" ;
  var url="{!!route('offerSheetApproval.index')!!}" ;
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>
@endsection
