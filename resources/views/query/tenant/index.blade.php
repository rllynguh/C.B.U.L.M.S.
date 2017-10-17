@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="body">
  <h2 id="header" class="align-center">
    LIST OF TENANTS 
  </h2>
  <div class="form-group">
    <div class="col-sm-4">
    </div>
  </div>
  <div class="col-sm-4">
  </div>
</div>
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">TENANT</th>
        <th class="align-center">LOCATION</th>
        <th class="align-center">UNIT</th>
        <th class="align-center">AREA</th>
        <th class="align-center">RATE/SQM</th>
        <th class="align-center">RENT RATE</th>
        <th class="align-center">LEASE PERIOD</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
  <div id='bebiko'>
  </div>
</div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/tenantQueryAjax.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.flash.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/jszip.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/pdfmake.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/vfs_fonts.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.html5.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.print.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('tenantQuery.getData')!!}" ;
</script>
@endsection
