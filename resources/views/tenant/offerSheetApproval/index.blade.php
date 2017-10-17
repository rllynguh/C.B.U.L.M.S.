@extends('layouts.tenantLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route("offerSheetApproval.index")}}"> Offer Sheet Approval</a></li>
</ol>
@endsection
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="body">
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

@endsection
@section('scripts')
{!!Html::script('js/admin.min.js')!!}
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
@section('styles')
{!!Html::style("css/themes/all-themes.min.css")!!}
{!!Html::style("css/style.min.css")!!}
@endsection
