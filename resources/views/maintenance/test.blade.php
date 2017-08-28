@extends('layout.coreLayout')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.semanticui.min.css">
<style type="text/css" media="screen">
  .breadcrumb-item::after {
  content: "/";
}
</style>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="header align-center">
        <h2>Buildings wooo</h2>
        <nav class="breadcrumb">
          <a class="breadcrumb-item" href="#">Home</a>
          <a class="breadcrumb-item" href="#">Library</a>
          <a class="breadcrumb-item" href="#">Data</a>
          <span class="breadcrumb-item active">Bootstrap</span>
        </nav>
      </div>
      <div class="align-center">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buildingCreateModal">
        Create Item
        </button>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="header align-center">
      <h2>
        LIST OF BUILDINGS
      </h2>
    </div>
    <div class="body">
      <table class="table row-border display compact table-hover dataTable table-striped ui celled" id="myTable">
        <thead>
          <tr>
          </tr>
        </thead>
        <tbody id="body">
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Create Item Modal -->
<div class="modal fade" id="create-itema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <!-- X Button -->
      <button type="button" class="close test" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <!-- X Button -->
      <h4 class="modal-title" id="myModalLabel">Create Item</h4>
    </div>
    <div class="modal-body">
      <form data-toggle="validator" action="{{ route('test.store') }}" method="POST" class = "form-horizontal">
        <div class="form-group">
          {{Form::label('title','Title:',['class' => 'control-label'])}}
          {{Form::text('title',null,['class' => 'form-control','data-error' => 'Please enter title','required' => ''])}}
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          {{Form::label('title','Description:',['class' => 'control-label'])}}
          {{Form::text('description',null,['class' => 'form-control','data-error' => 'Please enter description','required' => ''])}}
          <div class="help-block with-errors"></div>
        </div>
        
      </form>
    </div>
  </div>
</div>
</div>
<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
    </div>
    <div class="modal-body">
      <form data-toggle="validator" action="/item-ajax/14" method="put">
        <div class="form-group">
          <label class="control-label" for="title">Title:</label>
          <input type="text" name="title" class="form-control" data-error="Please enter title." required />
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label class="control-label" for="title">Description:</label>
          <textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
 <!--MODAL-->
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
                    <select required id="comBuilType" name="comBuilType" class="form-control show-tick">
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4">
                  <div class="form-line">
                    <h5 class="card-inside-title">Building Name</h5>
                    {{ Form::text('txtBuildingDesc',null,[
                      'id'=> 'txtBuildingDesc',
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
                    {{ Form::number('txtNumFloors',1,[
                      'id'=> 'txtNumFloors  ',
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
                    {{ Form::text('txtAddressNo',null,[
                      'id'=> 'txtAddressNo',
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
                    {{ Form::text('txtStreet',null,[
                      'id'=> 'txtStreet',
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
                    {{ Form::text('txtDistrict',null,[
                      'id'=> 'txtDistrict',
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
                   <select required name="comProvince" id="comProvince" class="form-control show-tick">
                   </select>
                 </div>
               </div>
               <div class="form-group p-l-30">
                 <div class="col-sm-6 col-md-6">
                  <div class="form-line">
                    <h5 class="card-inside-title">City</h5>
                    <select required name="comCity" id="comCity" class="form-control show-tick">
                      
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
  <!--MODAL-->
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript">
var url = "<?php echo route('test.index')?>";
var dataurl="{{route("buildings.getData")}}";
 urlbtype="{{route("custom.getBuildingType")}}";
      urlprov="{{route("custom.getProvince")}}";
</script>
<script src="/js/buildingRehaulAjax.js"></script>
@endsection