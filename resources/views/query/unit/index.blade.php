@extends('layout.coreLayout')
@section('content')

<div class="col-md-3">
  <div class="input-group input-group-lg">
    <span class="input-group-addon">
      <input  type="checkbox" class="filled-in" id="checkBuilding" value='1'>
      <label for="checkBuilding">Building</label>
    </span>
    <div class="form-line">
      {{ Form::select('building',$buildings, null, [
        'id' => 'building',
        'required' => 'required',
        'class' => 'form-control form-line align'])
      }}
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="input-group input-group-lg">
    <span class="input-group-addon">
      <input type="checkbox" class="filled-in" id="checFloor">
      <label for="checFloor">Floor</label>
    </span>
    <div class="form-line">
     {{ Form::select('floor',$floors, null, [
      'id' => 'floor',
      'required' => 'required',
      'class' => 'form-control form-line align'])
    }}
  </div>
</div>
</div>


<div class="body">
  <h2 id="header" class="align-center">
    LIST OF UNITS 
  </h2>
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">BUILDING</th>
        <th class="align-center">FLOOR</th>
        <th class="align-center">UNIT</th>
        <th class="align-center">UNIT TYPE</th>
        <th class="align-center">AREA</th>
        <th class="align-center">RATE</th>
        <th class="align-center">LOCATION</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
  <div id='bebiko'>
  </div>
  <button id="btnGenerate" type="submit" class="btn btn-lg bg-brown waves-effect waves-white">GENERATE</button>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/unitQueryAjax.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.flash.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/jszip.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/pdfmake.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/vfs_fonts.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.html5.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.print.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('unitQuery.getData')!!}" ;
</script>
@endsection
