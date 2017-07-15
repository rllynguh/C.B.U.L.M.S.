@extends('layout.coreLayout')
@section('content')
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      <h2 class="align-center">BUILDING TYPES<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5 " id="btnAddModal"  type="button" >
        <i class="mdi-content-add pulls"></i> NEW
      </button></h2>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <!--MODAL-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-col-green">
            {{ Form::open([
              'id' => 'myForm', 'class' => 'form-horizontal'
              ])
            }}
            <div class="modal-header">
              <h1 id="label" class="modal-title align-center p-b-15">NEW BUILDING TYPE<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div class="form-group p-l-30">
                <div class="form-line">
                  {{ Form::text('txtBuilTypeDesc',null,[
                    'id'=> 'txtBuilTypeDesc',
                    'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                    'class' => 'form-control text-center',
                    'autocomplete' => 'off',
                    'minlength' => '3',
                    'maxlength' => '20',
                    'required' => 'required',
                    'placeholder' => 'Ex. Mall'
                    ])
                  }}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton">SAVE</span></button>
              {{ Form::hidden(null,null,[
                'id'=> 'myId',
                ])
              }}
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
      <!--MODAL-->

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

      <div class="card">
        <div class="header align-center">
          <h2>
            LIST OF BUILDING TYPES
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Building Type</th>
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
  </div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/buildingTypeAjax.js")!!}
<script type="">
  var dataurl="{{route("buildingtypes.getData")}}";
  var url="{{route("buildingtypes.index")}}"
</script>
@endsection
