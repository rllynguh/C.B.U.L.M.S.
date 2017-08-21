    @extends('layout.coreLayout')
    @section('scripts')
    {!! Html::script("custom/floorAjax.js") !!}
    <script type="text/javascript">
     var dataurl="{{route("floors.getData")}}";
     url="{{route("floors.index")}}";
     urlunit="{{route("units.index")}}";
     urlprice="{{route("floors.storePrice")}}";
   </script>
   @endsection
   @section('content')
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
        {{-- modalprice open :) --}}
        <div class="modal fade" id="modalPrice" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-green">
              {{ Form::open([
                'id' => 'frmPrice', 'class' => 'form-horizontal'
                ])
              }}
              {{ Form::hidden('floor_id',null,[
                'id' => 'floor_id'
                ])
              }}
              <div class="modal-header">
                <h1  class="modal-title align-center p-b-15">PRICING<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
              </div>

              <div class="modal-body">
                <div id='info'>

                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group p-l-30">
                    <h5 class="card-inside-title">Set price for all the units on this floor to:</h5>
                    <div class="form-line m-b-30">
                      {{ Form::number('txtAllPrice',null,[
                        'id'=> 'txtAllPrice',
                        'class' => 'form-control text-center',
                        'autocomplete' => 'off',
                        'required' => 'required',
                        'min' => '100',
                        'max' => '1000',
                        ])
                      }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSavePrice" ><i class="mdi-content-save"></i><span> SAVE</span></button>
              </div>
              {{Form::close()}}
            </div>
          </div>
        </div>

        {{-- modalPrice end :(  --}}
        {{-- modalFLoor start --}}

        <div class="modal fade" id="modalUnit" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-col-green">
              {{ Form::open([
                'id' => 'frmUnit', 'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'
                ])
              }}

              <div class="modal-header">
                <h1  class="modal-title align-center p-b-15">ADD UNIT<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
              </div>

              <div class="modal-body">
                <!--Upload Picture-->
                <div class="form-group p-l-30">
                  <h5 class="card-inside-title">Upload Picture</h5>
                  <input required="" type="file" id="picture" name="picture">

                  <div class="form-line">
                    <h5 class="card-inside-title">Building</h5>
                    {{ Form::text('txtFBuilDesc',null,[
                      'id'=> 'txtFBuilDesc',
                      'readonly' => '',
                      'class' => 'form-control text-center',
                      'required' => 'required',
                      ])
                    }}
                  </div>

                </div> <!--modal body-->

                <div class="form-group p-l-10">
                  <div class="form-line">
                    <h5 class="card-inside-title">Floor</h5>
                    {{ Form::text('txtUFNum',null,[
                      'id'=> 'txtUFNum',
                      'readonly' => '',
                      'class' => 'form-control text-center',
                      'required' => 'required',
                      ])
                    }}
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
                   {{ Form::text('txtUUNum',null,[
                    'id'=> 'txtUUNum',
                    'readonly' => '',
                    'class' => 'form-control text-center',
                    'required' => 'required',
                    ])
                  }}
                </div>
              </div>
              <div class="form-group ">
                <div class="col-md-12 col-sm-12">
                  <div class="form-line">
                    <h5 class="card-inside-title">Area</h5>
                    {{ Form::number('txtArea',null,[
                      'id'=> 'txtArea',
                      'data-parsley-type' => "number",
                      'min' => '1',
                      'max' => '9999',
                      'class' => 'form-control text-center',
                      'required' => 'required',
                      'placeholder' => 'sqm',
                      'step' => "0.01"
                      ])
                    }}
                  </div>
                </div>
              </div>
              <div class="form-group ">
                <div class="col-md-12 col-sm-12">
                  <div class="form-line">
                    <h5 class="card-inside-title">Price</h5>
                    {{ Form::number('txtPrice',null,[
                      'id'=> 'txtPrice',
                      'data-parsley-type' => "number",
                      'min' => '100',
                      'max' => '1000',
                      'class' => 'form-control text-center',
                      'required' => 'required',
                      'placeholder' => 'P 100',
                      'step' => "0.01"
                      ])
                    }}
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer m-t--30">
              <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveUnit" ><i class="mdi-content-save"></i><span> SAVE</span></button>
              {{ Form::hidden('comFloor',null,[
                'id'=> 'comFloor',
                ])
              }}
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
      {{-- modalFLoor end --}}
      <!--MODAL-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-col-green">
            {{ Form::open([
              'id' => 'myForm', 'class' => 'form-horizontal'
              ])
            }}
            <div class="modal-header">
              <h1 id="label" class="modal-title align-center p-b-15">NEW FLOOR<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div class="form-group p-l-30 p-b-10">
                <div class="form-line">
                  <h5 class="card-inside-title">Building Name</h5>
                  <select required id="comBuilding" name="comBuilding" class="form-control show-tick align-center">
                  </select>
                </div>
              </div>
              <div class="form-group p-l-30 p-b-10">
                <div class="form-line">
                  <h5 class="card-inside-title">Floor Number</h5>
                  {{ Form::number('txtFNum',null,[
                    'id'=> 'txtFNum',
                    'readonly' => '',
                    'class' => 'form-control text-center',
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
                    'class' => 'form-control text-center max-digits-2',
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
                <th class="align-center">Building</th>
                <th class="align-center">Floor</th>
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
