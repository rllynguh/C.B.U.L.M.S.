@extends('layout.coreLayout')
@section('content')
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      <h2 class="align-center">MARKET RATES</h2>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <!--MODAL-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-col-green">
            <form id="myForm" class="form-horizontal" data-parsley-validate>
              <div class="modal-header">
                <h1 class="modal-title align-center p-b-15">UPDATE MARKET RATE<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="form-line">
                   {{ Form::number('txtRate',null,[
                    'id'=> 'txtRate',
                    'autocomplete' => 'off',
                    'min' => '400',
                    'max' => '2000',
                    'class' => 'form-control text-center',
                    'required' => 'required',
                    'placeholder' => 'rate/sqm/month',
                    'step' => '0.01'
                    ])
                  }}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i> SAVE</button>
              {{ Form::hidden('_token',null,[
                'value'=> csrf_token(),
                ])
              }}
              {{ Form::hidden('myId',null,[
                'id'=> 'myId'
                ])
              }}
            </div>
          </form>
        </div>

      </div>
    </div>
    <!--MODAL-->

    <div class="card">
      <div class="header align-center">
        <h2>
          LIST OF MARKET RATES
        </h2>
      </div>
      <div class="body">
        <table class="table table-hover dataTable" id="myTable">
          <thead>
            <tr>
              <th class="align-center">CITY</th>
              <th class="align-center">DATE UPDATED</th>
              <th class="align-center">RATE</th>
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
{!!Html::script("custom/marketRateAjax.js")!!}
<script type="text/javascript">
  var dataurl="{{route("marketrates.getData")}}";
  var url="{{route("marketrates.index")}}";
</script>
@endsection
