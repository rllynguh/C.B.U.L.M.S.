

<!-- Building Create Modal  -->
<div class="modal fade" id="buildingCreateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-col-green">
            {{ Form::open([
              'id' => 'buildingCreateForm', 'class' => 'form-horizontal', 'action' => 'maintenanceBuildingController@store'
              ])
            }} 
            <div class="modal-header">
              <h1 id='label' class="modal-title align-center p-b-15">NEW BUILDING<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div class="form-group p-l-30 p-b-10">
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Building Type</h5>
                    <select required id="building_type" name="building_type" class="form-control show-tick">
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Building Name</h5>
                    {{ Form::text('building_name',null,[
                      'id'=> 'building_name',
                      'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                      'class' => 'form-control',
                      'autocomplete' => 'off',
                      'minlegth' => '3',
                      'maxlength' => '20',
                      'required' => 'required',
                      ])
                    }}
                  </div>
                </div>
              
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Number of Floors</h5>
                    {{ Form::number('building_num_of_floors',1,[
                      'id'=> 'building_num_of_floors',
                      'minlenght' => '1',
                      'maxlenght' => '99',
                      'class' => 'form-control max-digits-2',
                      'autocomplete' => 'off',
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
                    {{ Form::text('building_address',null,[
                      'id'=> 'building_address',
                      'class' => 'form-control max-digits-4',
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
                    {{ Form::text('building_street',null,[
                      'id'=> 'building_street',
                      'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                      'class' => 'form-control',
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
                    {{ Form::text('bulding_district',null,[
                      'id'=> 'building_district',
                      'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                      'class' => 'form-control',
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
                   <select required name="building_province" id="building_province" class="form-control show-tick">
                   </select>
                 </div>
               </div>
               <div class="form-group p-l-30">
                 <div class="col-sm-6 col-md-6">
                  <div class="form-line">
                    <h5 class="card-inside-title">City</h5>
                    <select required name="building_city" id="building_city" class="form-control show-tick">
                      
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
           <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12 col-sm-12" id="btnBuildingSave" value="add"><i class="mdi-content-save"></i><span id='lblButton'> SAVE</span></button>
           {{ Form::hidden(null,null,[
            'id'=> 'myId'
            ])
          }}
        </div>
        {{Form::close()}}
      </div>
    </div>
  </div>

  <!-- Floor create modal -->
  <div class="modal fade" id="floorCreateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-col-green">
        {{ Form::open([
          'id' => 'floorCreateForm', 'class' => 'form-horizontal'
          ])
        }}
        <div class="modal-header">
          <h1 id="label" class="modal-title p-b-15">NEW FLOOR<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
        </div>
        <div class="modal-body">
          <div class="form-group p-l-30 p-b-10">
            <div class="form-line">
              <h5 class="card-inside-title">Building Name</h5>
              <select required id="comBuilding" name="comBuilding" class="form-control show-tick">
              </select>
            </div>
          </div>
          <div class="form-group p-l-30 p-b-10">
            <div class="form-line">
              <h5 class="card-inside-title">Floor Number</h5>
              {{ Form::number('txtFNum',null,[
                'id'=> 'txtFNum',
                'readonly' => '',
                'class' => 'form-control',
                'required' => 'required',
                ])
              }}
            </div>
          </div>
          <div class="form-group p-l-30">
            <div class="form-line">
              <h5 class="card-inside-title">Number of Units</h5>
              {{ Form::number('txtUNum',1,[
                'id'=> 'txtUNum',
                'autocomplete' => 'off',
                'min' => '1',
                'max' => '99',
                'class' => 'form-control max-digits-2',
                'required' => 'required',
                ])
              }}
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id='lblButton'> SAVE</span></button>
          {{ Form::hidden(null,1,[
            'id' => 'myId'
            ])
          }}
        </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
  <!--MODAL-->

  <!-- Unit create modal -->
  <!--MODAL-->
      <div class="modal fade" id="unitCreateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-col-green">
           {{ Form::open([
            'id' => 'unitCreateForm', 'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
            ])
          }}
          <div class="modal-header">
            <h1 id="label" class="modal-title align-center p-b-15">NEW BUILDING UNIT<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file">
                        Browse…  <input required="" type="file" id="picture" name="picture">
                      </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                  </div>
                  <img id='img-upload' class='img-circle' height="100" width='100' value="{{url('images/units/')}}">
                </div>
              </div>
            </div>
            <div class="form-group p-l-30 p-b-10">
              <div class="col-md-6 col-sm-6">
                <div class="form-line">
                  <h5 class="card-inside-title">Building Name</h5>
                  <select required id="comBuilding" name="comBuilding" class="form-control show-tick">
                  </select>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-line">
                  <h5 class="card-inside-title">Floor</h5>
                  <select required id="comFloor" name="comFloor" class="form-control show-tick">
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group p-l-30 p-b-10">
              <div class="col-md-6 col-sm-6">
                <div class="form-line">
                  <h5 class="card-inside-title">Unit Type</h5>
                  <select required id="comUnitType" name="comUnitType" class="form-control show-tick">
                   <option value="0">Raw</option>
                   <option value="1">Shell</option>
                 </select>
               </div>
             </div>
             <div class="col-md-6 col-sm-6">
               <div class="form-line">
                 <h5 class="card-inside-title">Unit Number</h5>
                 {{ Form::text('txtUNum',null,[
                   'id'=> 'txtUNum',
                   'required' => 'required',
                   'readonly' => '',
                   'class' => 'form-control',
                   ])
                 }}
               </div>
             </div>
           </div>
           <div class="form-group p-l-30 p-b-10">
            <div class="col-md-6 col-sm-6">
              <div class="form-line">
                <h5 class="card-inside-title">Area</h5>
                {{ Form::number('txtArea',null,[
                  'id'=> 'txtArea',
                  'required' => 'required',
                  'min' => '1',
                  'max' => '9999',
                  'data-parsley-type' => 'number',
                  'autocomplete' => 'off',
                  'placeholder' => 'sqm',
                  'step' => '0.01',
                  'class' => 'form-control',
                  ])
                }}
              </div>
            </div>
                    
            <div class="col-md-6 col-sm-6">
              <div class="form-line">
                <h5 class="card-inside-title">Rate per sqm</h5>
                {{ Form::number('txtPrice',null,[
                  'id'=> 'txtPrice',
                  'required' => 'required',
                  'min' => '1000',
                  'max' => '99999',
                  'data-parsley-type' => 'number',
                  'autocomplete' => 'off',
                  'placeholder' => 'P 0.00',
                  'step' => '0.01',
                  'class' => 'form-control',
                  ])
                }}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i> <span id="lblButton"> SAVE</span></button>
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