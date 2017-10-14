@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
    </div>
    
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header align-center">
          <h2 id="header">
            LIST OF DELINQUENT TENANT 
          </h2>
          <div class="form-group">
            <div class="col-sm-4">
              <label>Status</label>                              
              <div class="form-line">
                {{-- {{Form::select('status',array('0' => 'Pending', '1' => 'Active', '2' => 'Rejected'),null,['id'=>'status','class'=>'form-control align-center'])}} --}}
              </div>
            </div>
            <div class="col-sm-4">
              <label>Business</label>                
              <div class="form-line">
                {{-- {{Form::select('business',$business,null,['id'=>'business','class'=>'form-control align-center'])}} --}}
              </div>
            </div>
            <div class="col-sm-4">
              <label>Location</label>                
              <div class="form-line">
                {{-- {{Form::select('city',$city,null,['id'=>'city','class'=>'form-control align-center'])}} --}}
              </div>
            </div>
          </div>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">CONTRACT</th>
                <th class="align-center">TENANT</th>
                <th class="align-center">BUSINESS</th>
                <th class="align-center">UNIT REQUESTED</th>
                <th class="align-center">PAYMENT GAP</th>
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
{!!Html::script("custom/delinquentQueryAjax.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.flash.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/jszip.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/pdfmake.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/vfs_fonts.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.html5.min.js")!!}
{!!Html::script("plugins/jquery-datatable/extensions/export/buttons.print.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('delinquentQuery.getData')!!}" ;
</script>
@endsection
