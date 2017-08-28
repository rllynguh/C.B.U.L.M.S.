@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      REQUIREMENT SUBMISSION
    </div>
    
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      {{-- MODAL SHOW REQUIREMENTS  start--}}
      <div class="modal fade" id="modalShowRequirements" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content modal-col-green">
            <div class="modal-header">
              <h2 class="modal-title align-center p-b-15 p-l-35">List Of Requirments<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
            </div>
            <div class="modal-body align-center">
              <div id='divRequirements'></div>
            </div>
            <div class="modal-footer align-center">
            </div>
          </div>
        </div>
      </div>
      {{-- MODAL SHOW REQUIREMENTS  end--}}


      {{-- MODAL SHOW PENDING REQUIREMENTS  start--}}
      <div class="modal fade" id="modalShowPendingRequirements" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content modal-col-green">
            {{ Form::open([
              'id' => 'frmSubmitRequirements', 'class' => 'form-horizontal',
              'enctype' => 'multipart/form-data'
              ])
            }}
            {{ Form::hidden('regi_id',null,[
              'id' => 'regi_id'
              ])
            }}
            <div class="modal-header">
              <h2 class="modal-title align-center p-b-15 p-l-35">List Of Pending Requirments<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
            </div>
            <div class="modal-body align-center">
              <div id='divPendingRequirements'>

              </div>
            </div>
            <div class="modal-footer align-center">
             <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveRequirements" value="add"><i class="mdi-content-save"></i>SAVE</button>
           </div>
           {{Form::close()}}
         </div>
       </div>
     </div>
     {{-- MODAL SHOW PENDING REQUIREMENTS  end--}}

     <div class="card">
      <div class="header align-center">
        <h2>
          LIST OF PENDING REQUIREMENT 
        </h2>
      </div>
      <div class="body">
        <table class="table table-hover dataTable" id="myTable">
          <thead>
            <tr>
              <th class="align-center">REGISTRATION CODE</th>
              <th class="align-center">Lessor</th>
              <th class="align-center">Unit requested</th>
              <th class="align-center">Pending Requirements</th>
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
{!!Html::script("custom/requirementSubmissionAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('requirementSubmission.getData')!!}" ;
  var url="{!!route('requirementSubmission.index')!!}" ;
</script>
@endsection
