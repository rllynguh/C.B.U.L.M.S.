 @extends('layout.coreLayout')
@section('scripts')
{!! Html::script("custom/buildingAjax.js") !!}
<script type="text/javascript">
  var dataurl="{{route("buildings.getData")}}";
  url="{{route("buildings.index")}}";
  urlfloor="{{route("buildings.storefloor")}}";
  urlbtype="{{route("custom.getBuildingType")}}";
  urlprov="{{route("custom.getProvince")}}";
  urlprice="{{route("buildings.storePrice")}}";
</script>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="card">
      <div class="header align-center">
        <h2>
          LIST OF BUILDINGS
        </h2>
      </div>
      <div class="body">
        <table class="table table-hover dataTable" id="myTable">
          <thead>
            <tr>
              <th class="align-center">Building ID</th>
              <th class="align-center">Building  Name</th>
              <th class="align-center">Location</th>
              <th class="align-center">Status</th>
              <th class="align-center">Action</th>
            </tr>
          </thead>
          <tbody id="myList">
          </tbody>
        </table>
      </div>
    </div>
  </div>