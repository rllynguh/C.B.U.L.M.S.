    @extends('layout.coreLayout')
    @section('content')
    <meta name="_token" content="{!! csrf_token() !!}" />
    <div class="container-fluid">
      <div class="body">
        <div class="block-header">
          <h2 class="align-center">PARKING AREA<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5" type="button" id="btnAddModal">
            <i class="mdi-content-add pulls"></i> NEW
          </button></h2>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <!--MODAL-->
          <div class="modal fade" id="modalParkSpace" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-col-green">
                <form id="frmParkSpace" class="form-horizontal" >
                  <div class="modal-header">
                    <h1 class="modal-title align-center p-b-15">NEW PARKING SPACE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
                  </div>
                  <div class="modal-body">
                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Building</h5>
                        <input readonly="" class="form-control align-center" type="text" name="txtBuilDesc" id="txtBuilDesc">
                      </div>
                    </div>

                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Park Area</h5>
                        <input readonly="" class="form-control align-center" type="text" name="txtParkArea" id="txtParkArea">
                      </div>
                    </div>

                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Park Space Number</h5>
                        <input required readonly="" type="number" id="txtPPNum" name="txtPPNum" class="form-control align-center"  >
                      </div>
                    </div>

                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Size</h5>
                        <input required type="number" min="1" max="9999" autocomplete="off" data-parsley-type="number" id="txtPArea" name="txtPArea" class="form-control align-center" placeholder="sqm" step="0.01" >
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveParkSpace" value="add"><i class="mdi-content-save"></i><span> SAVE</span></button>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="comParkArea" id="comParkArea">
                    <input type="hidden" value="parkAreaSpace" name="mode" id="mode">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--MODAL-->

          <!--MODAL-->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-col-green">
                <form data-parsley-validate id="myForm" class="form-horizontal">
                  <div class="modal-header">
                    <h1 id="label" class="modal-title align-center p-b-15">NEW PARKING AREA<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
                  </div>
                  <div class="modal-body">
                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Building Name</h5>
                        <select required id="comBuilding" name="comBuilding" class="form-control show-tick align-center">
                        </select>
                      </div>
                    </div>

                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Floor Number</h5>
                        <select required id="comFloor" name="comFloor" class="form-control show-tick align-center">
                        </select>
                      </div>
                    </div>

                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Floor Area</h5>
                        <input required type="number" min="99" max="9999" autocomplete="off" data-parsley-type="number" id="txtArea" name="txtArea" class="form-control align-center" placeholder="sqm" step="0.01" >
                      </div>
                    </div>

                    <div class="form-group p-l-30">
                      <div class="form-line">
                        <h5 class="card-inside-title">Number of Parking Space</h5>
                        <input autocomplete="off" minlength="1" maxlength="2" min="1" max="99" type="text" id="txtPNum" name="txtPNum" class="form-control align-center" data-parsley-pattern="^[0-9]+$" data-parsley-type="digits" required >
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> SAVE</span></button>
                    <input type="hidden" id="myId" name="myId" value="0">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--MODAL-->


          <div class="card">
            <div class="header align-center">
              <h2>
                LIST OF PARKING AREA
              </h2>
            </div>
            <div class="body">
              <table class="table table-hover dataTable" id="myTable">
                <thead>
                  <tr>
                    <th class="align-center">BUILDING</th>
                    <th class="align-center">PARKING AREA</th>
                    <th class="align-center">FLOOR</th>
                    <th class="align-center">SIZE</th>
                    <th class="align-center">NUMBER OF SPACES</th>
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
    @section('scripts')
    {!! Html::script("custom/parkAreaAjax.js") !!}
    <script type="text/javascript">
      var dataurl="{{route("parkareas.getData")}}";
      var url="{{route("parkareas.index")}}";
    </script>
    @endsection
