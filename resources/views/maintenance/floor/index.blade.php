    @extends('layout.coreLayout')
    @section('scripts')
    {!! Html::script("custom/floorAjax.js") !!}
    <script type="text/javascript">
     var dataurl="{{route("floors.getData")}}";
     url="{{route("floors.index")}}";
     urlunit="{{route("units.index")}}";
   </script>
   @endsection
   @section('content')
   <meta name="_token" content="{!! csrf_token() !!}" />
   <div class="container-fluid">
    <div class="body">
      <div class="block-header">
        <h2 class="align-center">FLOORS<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5" type="button" id="btnAddModal">
          <i class="mdi-content-add pulls"></i> NEW
        </button></h2>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        {{-- mofalFLoor start --}}
        <div class="modal fade" id="modalUnit" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-green">
              <form id="frmUnit" data-parsley-validate >
                <div class="modal-header">
                  <h1  class="modal-title align-center p-b-15">ADD UNIT<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
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
                      <h5 class="card-inside-title">Floor</h5>
                      <input readonly=""  id="txtUFNum" name="txtUFNum" type="text" class="form-control text-center" data-rule="quantity">
                    </div>
                  </div>

                  <div class="form-group p-l-10">
                    <div class="form-line">
                      <h5 class="card-inside-title">Unit Type</h5>
                      <select required id="comUnitType" name="comUnitType" class="form-control show-tick align-center">
                       <option value="0">Raw</option>
                       <option value="1">Shell</option>
                     </select>
                   </div>
                 </div>
                 <div class="form-group p-l-10">
                   <div class="form-line">
                     <h5 class="card-inside-title">Unit Number</h5>
                     <input readonly="" required="" type="text" id="txtUUNum" name="txtUUNum" class="form-control align-center" maxlength="20" required >
                   </div>
                 </div>
                 <div class="form-group ">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-line">
                      <h5 class="card-inside-title">Area</h5>
                      <input required type="number" min="1" max="9999" autocomplete="off" data-parsley-type="number" id="txtArea" name="txtArea" class="form-control align-center" placeholder="sqm" step="0.01" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer m-t--30">
                <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveUnit" ><i class="mdi-content-save"></i><span> SAVE</span></button>
                <input type="hidden" id="comFloor" name="comFloor">
                <input type="hidden" name="mode" value="floorUnit">
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- modalFLoor end --}}
      <!--MODAL-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-col-green">
            <form id="myForm" data-parsley-validate >
              <div class="modal-header">
                <h1 id="label" class="modal-title align-center p-b-15">NEW FLOOR<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
              </div>
              <div class="modal-body">
                <div class="form-group p-l-10">
                  <div class="form-line">
                    <h5 class="card-inside-title">Building Name</h5>
                    <select required id="comBuilding" name="comBuilding" class="form-control show-tick align-center">
                    </select>
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
                    <input autocomplete="off" min="1" max="99" required  id="txtUNum" name="txtUNum" type="number" class="form-control text-center max-digits-2" value="1" >
                  </div>
                </div>
              </div>
              <div class="modal-footer m-t--30">
                <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id='lblButton'> SAVE</span></button>
                <input  type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="myId" value="0">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--MODAL-->

      <div class="card">
        <div class="header align-center">
          <h2>
            LIST OF FLOORS
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Building  Name</th>
                <th class="align-center">Floor Number</th>
                <th class="align-center">Number of Units</th>
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
