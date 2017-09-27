@extends('layouts.tenantLayout')
@section('content')
<div class="flex-container">
      <hr class="m-t-0">
      <div class="card">
        <div class="card-content">
          <table class="table row-border display compact table-hover dataTable table-striped ui celled is-narrow" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Contract</th>
                <th class="align-center">Lessor</th>
                <th class="align-center">Number of Units</th>
                <th class="align-center">Date Issued</th>
                <th class="align-center">Action</th>
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
{!!Html::script("custom/contractAmmendmentAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('tenant.contractData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>
@endsection
