    @extends('layout.coreLayout')
    @section('scripts')
    {!! Html::script("custom/unitAjax.js") !!}
    <script type="text/javascript">
      var dataurl="{{route("units.getData")}}";
      url="{{route("units.index")}}";
    </script>
    @endsection
    @section('content')
    <div class="container-fluid">
      <div class="body">
        <div class="block-header">
          <h2 class="align-center">BUILDING UNITS<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5" type="button" id="btnAddModal">
            <i class="mdi-content-add pulls"></i> NEW
          </button></h2>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <!--Delete MODAL-->
         <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content modal-col-green">
              <div class="modal-header-delete">
                <h2 class="modal-title align-center p-b-15 p-l-35">DELETE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
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
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-col-green">
              <form  data-parsley-validate id="myForm" class="form-horizontal">
                <div class="modal-header">
                  <h1 id="label" class="modal-title align-center p-b-15">NEW BUILDING UNIT<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
                </div>
                <div class="modal-body">
                  <div class="form-group p-l-30 p-b-10">
                    <div class="col-md-6 col-sm-6">
                      <div class="form-line">
                        <h5 class="card-inside-title">Building Name</h5>
                        <select required id="comBuilding" name="comBuilding" class="form-control show-tick align-center">
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-line">
                        <h5 class="card-inside-title">Floor</h5>
                        <select required id="comFloor" name="comFloor" class="form-control show-tick align-center">
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group p-l-30 p-b-10">
                    <div class="col-md-6 col-sm-6">
                      <div class="form-line">
                        <h5 class="card-inside-title">Unit Type</h5>
                        <select required id="comUnitType" name="comUnitType" class="form-control show-tick align-center">
                         <option value="0">Raw</option>
                         <option value="1">Shell</option>
                       </select>
                     </div>
                   </div>
                   <div class="col-md-6 col-sm-6">
                     <div class="form-line">
                       <h5 class="card-inside-title">Unit Number</h5>
                       <input readonly="" required="" type="text" id="txtUNum" name="txtUNum" class="form-control align-center" maxlength="20" required >
                     </div>
                   </div>
                 </div>
                 <div class="form-group p-l-30 p-b-10">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-line">
                      <h5 class="card-inside-title">Area</h5>
                      <input required type="number" min="1" max="9999" autocomplete="off" data-parsley-type="number" id="txtArea" name="txtArea" class="form-control align-center" placeholder="sqm" step="0.01" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i> <span id="lblButton"> SAVE</span></button>
                <input type="hidden" id="myId" value="0">
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
            LIST OF BUILDING UNITS
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Building</th>
                <th class="align-center">Floor</th>
                <th class="align-center">Unit ID</th>
                <th class="align-center">Unit Type</th>
                <th class="align-center">Area</th>
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
