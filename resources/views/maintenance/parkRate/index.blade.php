@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Maintenance</a></li>
  <li><a href="{{route('parkrates.index')}}"> Park Rates</a></li>
</ol>
@endsection
@section('content')
<!--MODAL-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-col-green">
     {{ Form::open([
      'id' => 'myForm', 
      'class' => 'form-horizontal data-parsley-validate'
    ])
  }}
  <div class="modal-header">
    <h1 class="modal-title align-center p-b-15">UPDATE PARKING RATE<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
  </div>
  <div class="modal-body">
    <div class="form-group p-l-30">
      <div class="form-line">
       {{ Form::number('txtRate',null,[
        'id'=> 'txtRate',
        'required' => 'required',
        'min' => '400',
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
  <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i> SAVE</button>
  {{ Form::hidden('myId',null,[
    'id' => 'myId',
  ])
}}
</div>
{{Form::close()}}
</div>

</div>
</div>
<!--MODAL-->

<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">BUILDING</th>
        <th class="align-center">DATE UPDATED</th>
        <th class="align-center">RATE</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/parkRateAjax.js")!!}
<script type="text/javascript">
  var dataurl="{{route("parkrates.getData")}}"
  var url="{{route("parkrates.index")}}"
</script>
@endsection