@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="body">
  <h2 id="header" class="align-center">
    LIST OF DELINQUENT TENANT 
  </h2>
  <div class="form-group">
    <div class="col-sm-4">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-4">
      <label>Days Delayed</label>                
      <div class="form-line">
        <select id='days' name='days' class="form-control align-center">
          <option value='0'>
           above 30 days
         </option>
         <option value='1'>
           above 60 days
         </option>
         <option value='2'>
          above 120 days
        </option>
      </select>
    </div>
  </div>
</div>
<div class="col-sm-4">
</div>
</div>
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">CONTRACT</th>
        <th class="align-center">TENANT</th>
        <th class="align-center">BUSINESS</th>
        <th class="align-center">UNIT REQUESTED</th>
        <th class="align-center">PAYMENT GAP</th>
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
{!!Html::script("custom/delinquentQueryAjax.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.flash.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/jszip.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/pdfmake.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/vfs_fonts.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.html5.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.print.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('delinquentQuery.getData')!!}" ;
</script>
@endsection
