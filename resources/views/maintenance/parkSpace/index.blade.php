    @extends('layout.coreLayout')
    @section('scripts')
    {!! Html::script("custom/parkSpaceAjax.js") !!}
    <script type="text/javascript">
      var dataurl="{{route("parkspaces.getData")}}";
      url="{{route("parkspaces.index")}}"
    </script>
    @endsection
    @section('content')
    <div class="container-fluid">
      <div class="body">
        <div class="block-header">
          <h2 class="align-center">PARKING SPACES<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5" type="button" id="btnAddModal">
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
                  <h1 id="label" class="modal-title align-center p-b-15">NEW PARKING UNIT<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
                </div>
                <div class="modal-body">
                  <div class="form-group p-l-30">
                    <div class="form-line">
                      <h5 class="card-inside-title">Building</h5>
                      <select required  id="comBuilding" name="comBuilding" class="form-control show-tick align-center">
                      </select>
                    </div>
                  </div>

                  <div class="form-group p-l-30">
                    <div class="form-line">
                      <h5 class="card-inside-title">Park Area</h5>
                      <select required  id="comParkArea" name="comParkArea" class="form-control show-tick align-center">
                      </select>
                    </div>
                  </div>

                  <div class="form-group p-l-30">
                    <div class="form-line">
                      <h5 class="card-inside-title">Park Space Number</h5>
                      <input required readonly="" type="number" id="txtPNum" name="txtPNum" class="form-control align-center"  >
                    </div>
                  </div>

                  <div class="form-group p-l-30">
                    <div class="form-line">
                      <h5 class="card-inside-title">Size</h5>
                      {{ Form::text('txtArea',null,[
                        'id'=> 'txtArea',
                        'required' => 'required',
                        'class' => 'form-control text-center',
                        'data-parsley-type' => "number",
                        'min' => '99',
                        'max' => '9999',
                        'autocomplete' => 'off',
                        'placeholder' => 'sqm',
                        ])
                      }}
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> SAVE</span></button>
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


          <div class="card">
            <div class="header align-center">
              <h2>
                LIST OF PARKING SPACES
              </h2>
            </div>
            <div class="body">
              <table class="table table-hover dataTable" id="myTable">
                <thead>
                  <tr>
                    <th class="align-center">BUILDING</th>
                    <th class="align-center">FLOOR</th>
                    <th class="align-center">PARKING AREA</th>
                    <th class="align-center">PARKING SPACE</th>
                    <th class="align-center">SIZE</th>
                    <th class="align-center">STATUS</th>
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
