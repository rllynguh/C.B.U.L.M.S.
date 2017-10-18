@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Contracts</a></li>
  <li><a href="{{route("contractList.showPDC",$id)}}"> Ledger</a></li>
</ol>
@endsection
@section('content')
<!--MODAL-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-col-green">
      {{ Form::open([
        'id' => 'myForm', 'class' => 'form-horizontal'
      ])
    }}
    <div class="modal-header">
      <h1 id="label" class="modal-title align-center p-b-15">UPDATE PDC DETAILS<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
    </div>

    <div class="modal-body">
      <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="col-sm-6 col-md-6 col-xs-6">

         <div class="form-group p-l-30">
          <div class="form-line">
            {{ Form::label('for_date', 'Date Applicable', [
              'class' => 'control-label'
            ]) 
          }}
          {{Form::text('for_date',null,[
            'id'=> 'for_date',
            'class' => 'form-control align-center',
            'readonly' => '' 
          ])
        }}
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-xs-6">
   <div class="form-group p-l-30">
    <div class="form-line">
      {{ Form::label('code', 'Code', [
        'class' => 'control-label'
      ]) 
    }}
    {{Form::text('code',null,[
      'id'=> 'code',
      'class' => 'form-control align-center',
      'autocomplete' => 'off',
      'minlength' => '3',
      'maxlength' => '35',
      'required' => 'required',
      'placeholder' => '0-10-01-0' 
    ])
  }}
</div>
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12">

  <div class="col-sm-6 col-md-6 col-xs-6">
    <div class="form-line">
      {{ Form::label('bank', 'Bank', [
        'class' => 'control-label'
      ]) 
    }}
    <div class="form-group ">
      {{ Form::select('bank',$banks, null, [
        'id' => 'bank',
        'required' => 'required',
        'class' => 'form-control form-line align'])
      }}
    </div>
  </div>
</div>
<div class="col-sm-6 col-md-6 col-xs-6">
 <div class="form-group p-l-30">
  <div class="form-line">
    {{ Form::label('amount', 'Amount', [
      'class' => 'control-label'
    ]) 
  }}
  {{Form::text('amount',null,[
    'id'=> 'amount',
    'class' => 'form-control align-center',
    'readonly' => '',
  ])
}}
</div>
</div>
</div>
<div class="col-sm-12">
  <div class="form-group p-l-30">
    <div class="form-line">
      {{ Form::label('signatory', 'Signatory', [
        'class' => 'control-label'
      ]) 
    }}
    {{Form::text('signatory',null,[
      'id'=> 'signatory',
      'class' => 'form-control align-center',
      'required' => '',
      'minlength' => '10',
      'maxlength' => '60'
    ])
  }}
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> SAVE</span></button>
  <input type="hidden" id="myId" >
</div>
{{Form::close()}}
</div>

</div>
</div>
<!--MODAL-->

<!--MODAL-->
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-col-green">
      <div class="modal-header">
        <h1 id="label" class="modal-title align-center p-b-15">PDC DETAILS<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
      </div>

      <div class="modal-body">
        Bank: <span id='dispBank'></span><br>
        Code: <span id='dispPDC'></span><br>
        Signatory: <span id='dispSignatory'></span><br>
        Amount: <span id='dispAmount'></span><br>
        Date Applicable: <span id='dispFor_date'></span><br> <br>

        Billing Header: <span id='dispBilling'></span><br>
        Collection Header: <span id='dispPayment'></span><br>
        Listed below are the items covered by this payment: <br><br>

        <div class="body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="align-center">Details</th>
                <th class="align-center">Price</th>
              </tr>
            </thead>
            <tbody id='myList'>

            </tbody>
          </table>
        </div>


      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
<!--MODAL-->
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">CODE</th>
        <th class="align-center">STATUS</th>
        <th class="align-center">DATE APPLICABLE</th>
        <th class="align-center">BANK</th>
        <th class="align-center">AMOUNT</th>
        <th class="align-center">SIGNATORY</th>
        <th class="align-center">ACTION</th>

      </tr>
    </thead>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/contractListShowPDCAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('contractList.getPDCData',$id)!!}" ;
  var url="{{route('contractList.index')}}";
</script>
@endsection
