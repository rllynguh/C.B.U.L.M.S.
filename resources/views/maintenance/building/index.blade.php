    @extends('layout.coreLayout')
    @section('scripts')
    {!! Html::script("custom/buildingAjax.js") !!}
    <script type="text/javascript">
      var dataurl="{{route("buildings.getData")}}";
      url="{{route("buildings.index")}}";
      urlfloor="{{route("buildings.storefloor")}}";
    </script>
    @endsection
    @section('content')
    <meta name="_token" content="{!! csrf_token() !!}" />
    <div class="container-fluid">
      <div class="body">
        <div class="block-header">
          <h2 class="align-center">BUILDINGS<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5" type="button" id="btnAddModal">
            <i class="mdi-content-add pulls"></i> NEW
          </button></h2>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          {{-- mofalFLoor start --}}
          <div class="modal fade" id="modalFloor" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-col-green">
                <form id="frmFloor" data-parsley-validate >
                  <div class="modal-header">
                    <h1  class="modal-title align-center p-b-15">ADD FLOOR<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
                  </div>
                  <div class="modal-body">
                    <div class="form-group p-l-10">
                      <div class="form-line">
                        <h5 class="card-inside-title">Building</h5>
                        <input readonly=""  id="txtFBuilDesc" name="txtFBuilDesc" type="text" class="form-control text-center" data-rule="quantity">
                      </div>
                    </div>
                    <div class="form-group p-l-10">
                      <div class="form-line">
                        <h5 class="card-inside-title">Floor Number</h5>
                        <input readonly=""  id="txtFNum" name="txtFNum" type="text" class="form-control text-center" data-rule="quantity">
                      </div>
                    </div>
                    <div class="form-group p-l-10">
                      <div class="form-line">
                        <h5 class="card-inside-title">Number of Units</h5>
                        <input autocomplete="off" minlength="1" maxlength="2" data-parsley-type="digits" min="1" max="99" required  id="txtUNum" name="txtUNum" type="text" class="form-control text-center " data-parsley-pattern="^[0-9]+$">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer m-t--30">
                    <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveFloor" ><i class="mdi-content-save"></i><span> SAVE</span></button>
                    <input type="hidden" id="comBuilding" name="comBuilding">
                  </div>
                </form>
              </div>
            </div>
          </div>
          {{-- modalFLoor end --}}
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
                <form id="myForm" class="form-horizontal" data-parsley-validate>
                  <div class="modal-header">
                    <h1 id='label' class="modal-title align-center p-b-15">NEW BUILDING<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
                  </div>
                  <div class="modal-body">
                    <div class="form-group p-l-30 p-b-10">
                      <div class="col-sm-6 col-md-6">
                        <div class="form-line">
                          <h5 class="card-inside-title">Building Type</h5>
                          <select required id="comBuilType" name="comBuilType" class="form-control show-tick align-center">
                            @foreach($btype as $btype)
                            <option
                            value="{{$btype->intBuilTypeCode}}" class="align-center">{{$btype->strBuilTypeDesc}}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-line">
                        <h5 class="card-inside-title">Building Name</h5>
                        <input autocomplete="off" data-parsley-pattern = '^[a-zA-Z0-9. ]+$' type="text" name="txtBuilDesc" id="txtBuilDesc" class="form-control align-center" minlength="3" maxlength="20" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group p-l-30 p-b-10">
                    <div class="col-sm-12">
                      <div class="form-line">
                        <h5 class="card-inside-title">Number of Floors</h5>
                        <input autocomplete="off" id="txtBFNum" name="txtBFNum" min="1" max="99"
                        type="text" minlength="1" maxlength="2" class="form-control text-center" value="1"
                        required data-parsley-pattern="^[0-9]+$" data-parsley-type="number"
                        >
                      </div>
                    </div>
                  </div>

                  <div class="form-group p-l-30 p-b-10">
                    <div class="col-sm-4 col-md-4">
                      <div class="form-line">
                        <h5 class="card-inside-title">Address No.</h5>
                        <input data-parsley-type="digits" autocomplete="off" type="text" class="form-control align-center" name="txtSNum" id="txtSNum" maxlength="20" minlength="1" required >
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                      <div class="form-line">
                        <h5 class="card-inside-title">Street</h5>
                        <input autocomplete="off" type="text" data-parsley-pattern = '^[a-zA-Z0-9. ]+$' class="form-control align-center" name="txtStreet" id="txtStreet" maxlength="20" minlength="3" required >
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                      <div class="form-line">
                        <h5 class="card-inside-title">Town / Barangay</h5>
                        <input data-parsley-pattern = '^[a-zA-Z0-9. ]+$' autocomplete="off" type="text" class="form-control align-center" name="txtDistrict" id="txtDistrict" maxlength="20" minlength="3" required >
                      </div>
                    </div>
                  </div>
                  <div class="form-group p-l-30">
                    <div class="col-sm-6 col-md-6">
                     <div class="form-line">
                       <h5 class="card-inside-title">Province</h5>
                       <select required name="comProvince" id="comProvince" class="form-control show-tick align-center">
                        @foreach($province as $province)
                        <option value="{{$province->intProvinceCode}}"class="align-center">{{$province->strProvinceDesc}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group p-l-30">
                   <div class="col-sm-6 col-md-6">
                    <div class="form-line">
                      <h5 class="card-inside-title">City</h5>
                      <select required name="comCity" id="comCity" class="form-control show-tick align-center"></select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
             <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12 col-sm-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id='lblButton'> SAVE</span></button>
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
</div>
</div>
@endsection
