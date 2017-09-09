    @extends('layout.coreLayout')
    @section('scripts')
    {!! Html::script("custom/buildingAjax.js") !!}
    <script type="text/javascript">
      var dataurl="{{route("buildings.getData")}}";
      url="{{route("buildings.index")}}";
      urlfloor="{{route("buildings.storefloor")}}";
      urlbtype="{{route("custom.getBuildingType")}}";
      urlprov="{{route("custom.getProvince")}}";
      urlprice="{{route("buildings.storePrice")}}";
    </script>
    @endsection
    @section('content')
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
          {{-- modalprice open :) --}}
          <div class="modal fade" id="modalPrice" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-col-green">
               {{ Form::open([
                'id' => 'frmPrice', 'class' => 'form-horizontal'
                ])
              }}
              {{ Form::hidden('building_id',null,[
                'id' => 'building_id'
                ])
              }}
              <div class="modal-header">
                <h1  class="modal-title align-center p-b-15">PRICING<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
              </div>
              <div class="modal-body">

                <!--Prcing type-->
                <div class="form-group p-l-30 p-b-10">
                  <div class= "col-sm-6 col-md-6">
                    <div class= "form-line">
                      <h5 class="card-inside-title">Pricing Type</h5>
                      <select required id="comBasePrice" class="form-control show-tick align-center">
                        <option value="0">
                          Market Rate
                        </option>
                        <option value="1">
                          Fixed
                        </option>
                      </select>
                    </div>
                  </div>

                  <!--Price-->
                  <div class= "col-sm-6 col-md-6">
                    <div class= "form-line">
                      <h5 class="card-inside-title">Price</h5>
                      {{ Form::text('txtBasePrice',null,[
                        'id'=> 'txtBasePrice',
                        'class' => 'form-control text-center',
                        'readonly' => '',
                        'data-parsley-type' => 'number',
                        'autocomplete' => 'off',
                        'min' => '100',
                        'max' => '1000',
                        'required' => 'required',
                        ])
                      }}
                    </div>
                  </div>
                </div>

                <!--Price Increase Type-->
                <div class="form-group p-l-30 p-b-30">
                  <div class= "col-sm-6 col-md-6">
                    <div class= "form-line">
                      <h5 class="card-inside-title">Price Increased Type</h5>
                      <select required id="comPriceChange" name="comPriceChange" class="form-control show-tick align-center">
                        <option value="0">
                          Percentage
                        </option>
                        <option value="1">
                          Fixed
                        </option>
                      </select>
                    </div>
                  </div>

                  <!--Fixed or Percentage-->
                  <div class= "col-sm-6 col-md-6">
                    <div class= "form-line">
                      <h5 class="card-inside-title">Percentage / Fixed</h5>
                      {{ Form::text('txtPriceChange',null,[
                        'id'=> 'txtPriceChange',
                        'class' => 'form-control text-center',
                        'autocomplete' => 'off',
                        'max' => '3',
                        'required' => 'required',
                        'data-parsley-type' => 'number',
                        ])
                      }}
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="modal-footer m-t--30">
                <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSavePrice" ><i class="mdi-content-save"></i><span> SAVE</span></button>
              </div>
              {{Form::close()}}
            </div>
          </div>
        </div>
        {{-- modalPrice end :(  --}}
        {{-- mofalFLoor start --}}
        <div class="modal fade" id="modalFloor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-green">
             {{ Form::open([
              'id' => 'frmFloor', 'class' => 'form-horizontal'
              ])
            }}

            <div class="modal-header">
              <h1  class="modal-title align-center p-b-15">ADD FLOOR<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div class="form-group p-l-30">
                <div class="form-line">
                  <h5 class="card-inside-title">Building</h5>
                  {{ Form::text('txtFBuilDesc',null,[
                    'id'=> 'txtFBuilDesc',
                    'class' => 'form-control text-center',
                    'data-rule' => 'quantity',
                    'readonly' => ''
                    ])
                  }}
                </div>
              </div>
              <div class="form-group p-l-30">
                <div class="form-line">
                  <h5 class="card-inside-title">Floor Number</h5>
                  {{ Form::text('txtFNum',null,[
                    'id'=> 'txtFNum',
                    'class' => 'form-control text-center',
                    'data-rule' => 'quantity',
                    'readonly' => ''
                    ])
                  }}
                </div>
              </div>
              <div class="form-group p-l-30">
                <div class="form-line">
                  <h5 class="card-inside-title">Number of Units</h5>
                  {{ Form::number('txtUNum',null,[
                    'id'=> 'txtUNum',
                    'class' => 'form-control text-center max-digits-2',
                    'data-rule' => 'quantity',
                    'autocomplete' => 'off',
                    'min' => '1',
                    'max' => '99',
                    'required' => 'required',
                    ])
                  }}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveFloor" ><i class="mdi-content-save"></i><span> SAVE</span></button>
              {{ Form::hidden('comBuilding',null,[
                'id' => 'comBuilding'
                ])
              }}
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
      {{-- modalFLoor end --}}
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
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-col-green">
            {{ Form::open([
              'id' => 'myForm', 'class' => 'form-horizontal'
              ])
            }}
            <div class="modal-header">
              <h1 id='label' class="modal-title align-center p-b-15">NEW BUILDING<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div class="form-group p-l-30 p-b-10">
                <div class="col-sm-6 col-md-6">
                  <div class="form-line">
                    <h5 class="card-inside-title">Building Type</h5>
                    <select required id="comBuilType" name="comBuilType" class="form-control show-tick align-center">
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="form-line">
                    <h5 class="card-inside-title">Building Name</h5>
                    {{ Form::text('txtBuilDesc',null,[
                      'id'=> 'txtBuilDesc',
                      'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                      'class' => 'form-control text-center',
                      'autocomplete' => 'off',
                      'minlegth' => '3',
                      'maxlength' => '20',
                      'required' => 'required',
                      ])
                    }}
                  </div>
                </div>
              </div>

              <div class="form-group p-l-30 p-b-10">
                <div class="col-sm-12">
                  <div class="form-line">
                    <h5 class="card-inside-title">Number of Floors</h5>
                    {{ Form::number('txtBFNum',1,[
                      'id'=> 'txtBFNum',
                      'class' => 'form-control text-center max-digits-2',
                      'autocomplete' => 'off',
                      'min' => '1',
                      'max' => '99',
                      'required' => 'required',
                      ])
                    }}
                  </div>
                </div>
              </div>

              <div class="form-group p-l-30 p-b-10">
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Address No.</h5>
                    {{ Form::text('txtSNum',null,[
                      'id'=> 'txtSNum',
                      'class' => 'form-control text-center max-digits-4',
                      'autocomplete' => 'off',
                      'minlength' => '1',
                      'maxlength' => '4',
                      'required' => 'required',
                      ])
                    }}
                  </div>
                </div>
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Street</h5>
                    {{ Form::text('txtStreet',null,[
                      'id'=> 'txtStreet',
                      'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                      'class' => 'form-control text-center',
                      'autocomplete' => 'off',
                      'minlength' => '3',
                      'maxlength' => '20',
                      'required' => 'required',
                      ])
                    }}
                  </div>
                </div>
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Town / Barangay</h5>
                    {{ Form::text('txtDistrict',null,[
                      'id'=> 'txtDistrict',
                      'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                      'class' => 'form-control text-center',
                      'autocomplete' => 'off',
                      'minlength' => '3',
                      'maxlength' => '20',
                      'required' => 'required',
                      ])
                    }}

                  </div>
                </div>
              </div>
              <div class="form-group p-l-30">
                <div class="col-sm-6 col-md-6">
                 <div class="form-line">
                   <h5 class="card-inside-title">Province</h5>
                   <select required name="comProvince" id="comProvince" class="form-control show-tick align-center">
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
           {{ Form::hidden(null,null,[
            'id'=> 'myId'
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
