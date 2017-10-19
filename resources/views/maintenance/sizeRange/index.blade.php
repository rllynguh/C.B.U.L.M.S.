@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Maintenance</a></li>
  <li><a href="{{route('size_range.index')}}"> Size Range</a></li>
</ol>
@endsection
@section('content')
<!--Delete MODAL-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-col-green">
      <div class="modal-header-delete">
        <h2 class="modal-title align-center p-b-15 p-l-35">DELETE<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
      </div>
      <div class="modal-body align-center">
        <p>Are you sure do you want to delete this record?</p>
      </div>
      <div class="modal-footer align-center">
        <button id="btnDelete" type="submit" class="btn btn-lg bg-red waves-effect waves-white col-md-12 col-sm-12"><i class="mdi-action-delete"></i> DELETE</button>
      </div>
    </div>
  </div>
</div>
<!--Delete MODAL-->

<!--MODAL-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-col-green">
      {{ Form::open([
        'id' => 'myForm', 'class' => 'form-horizontal'
      ])
    }}
    <div class="modal-header">
      <h1 id="label" class="modal-title align-center p-b-15">NEW ACCREDITED SIZE RANGE<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
    </div>
    <div class="modal-body">
      <div class="form-group p-l-30">
        <div class="form-line">
          {{ Form::number('txtFrom',null,[
            'id'=> 'txtFrom',
            'required' => 'required',
            'min' => '50',
            'max' => '2000',
            'autocomplete' => 'off',
            'placeholder' => 'rate/sqm/month',
            'step' => '0.01',
            'class' => 'form-control text-center',
          ])
        }}
      </div>
    </div>
    <div class="form-group p-l-30">
      <div class="form-line">
        {{ Form::number('txtTo',null,[
          'id'=> 'txtTo',
          'required' => 'required',
          'min' => '70',
          'max' => '2000',
          'autocomplete' => 'off',
          'placeholder' => 'rate/sqm/month',
          'step' => '0.01',
          'class' => 'form-control text-center',
        ])
      }}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> SAVE</span></button>
  <input type="hidden" id="myId" value="0">
</div>
{{Form::close()}}
</div>

</div>
</div>
<!--MODAL-->
<div class="body">
 <h2 class="align-center"><button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5 " id="btnAddModal"  type="button" >
  <i class="mdi-content-add pulls"></i> NEW
</button></h2>
<table class="table table-bordered table-striped" id="myTable">
  <thead>
    <tr>
      <th class="align-center">FROM</th>
      <th class="align-center">TO</th>
      <th class="align-center">STATUS</th>
      <th class="align-center">ACTION</th>
    </tr>
  </thead>
  <tbody >
  </tbody>
</table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/sizeRangeAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('size_range.getData')!!}" ;
  var url="{!!route('size_range.index')!!}" ;
</script>
@endsection
