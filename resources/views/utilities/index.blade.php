@extends('layout.coreLayout')
@section('content')
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      <h2 class="align-center">UTILITIES</h2>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header align-center">
          <h2>
            UPDATE UTILITIES
          </h2>
        </div>
        <div class="body">
          <form id="myForm" class="form-horizontal"  data-parsley-validate>
            <div class="form-group p-l-30">
              <h5 data-toggle="tooltip" data-placement="top" title="Used to cover damage to the property(Months).">
                Security Deposit(Months)
              </h5>
              
              <div class="form-line">
                <input autocomplete="off" min="1" max="12" required  id="txtSec" name="txtSec" type="number" class="form-control text-center " data-parsley-pattern="^[0-9]+$" data-parsley-type="number"  placeholder="months">
              </div>
            </div>
            <div class="form-group p-l-30">
              <h5 data-toggle="tooltip" data-placement="top" title="Used to cover damage to the property(Months).">
                Reservation Fee(Months)
              </h5>
              
              <div class="form-line">
                <input autocomplete="off" min="1" max="12" required  id="txtRes" name="txtRes" type="number" class="form-control text-center " data-parsley-pattern="^[0-9]+$" data-parsley-type="number"  placeholder="months">
              </div>
            </div>
            <div class="form-group p-l-30">
              <h5 data-toggle="tooltip" data-placement="top" title="Used to cover damage to the property(Months).">
                Advance Rent(Months)
              </h5>
              
              <div class="form-line">
                <input autocomplete="off" min="1" max="12" required  id="txtAdvance" name="txtAdvance" type="number" class="form-control text-center " data-parsley-pattern="^[0-9]+$" data-parsley-type="number"  placeholder="months">
              </div>
            </div>
            <div class="form-group p-l-30">
              <h5 data-toggle="tooltip" data-placement="top" title="Used to cover damage to the property(Months).">
                Fitout Deposit(Months)
              </h5>
              
              <div class="form-line">
                <input autocomplete="off" min="1" max="12" required  id="txtFit" name="txtFit" type="number" class="form-control text-center " data-parsley-pattern="^[0-9]+$" data-parsley-type="number"  placeholder="months">
              </div>
            </div>
            <div class="form-group p-l-30 p-t-30">
              <h5 data-toggle="tooltip" data-placement="top" title="(%)" >
                Value Added Tax(%)
              </h5>
              <div class="form-line">
                <input autocomplete="off" required=""  id="txtVAT" name="txtVAT" class="form-control align-center" required  data-parsley-type="number" placeholder="%" >
              </div>
            </div>
            <div class="form-group p-l-30 p-t-30">
              <h5 data-toggle="tooltip" data-placement="top" title="(%)">
                Expanded Witholding Tax(%)
              </h5>
              <div class="form-line">
                <input autocomplete="off" required=""  id="txtEWT" name="txtEWT" class="form-control align-center" required  data-parsley-type="number" placeholder="%" >
              </div>
            </div>
            <div class="form-group p-l-30 p-t-30">
              <h5 data-toggle="tooltip" data-placement="top" title="(%)">
                Escalation Rate(%)
              </h5>
              <div class="form-line">
                <input autocomplete="off" required=""  id="txtEsca" name="txtEsca" class="form-control align-center" required  data-parsley-type="number" placeholder="%" >
              </div>
            </div>
            <div class="form-group p-l-30 p-t-30">
             <h5 data-toggle="tooltip" data-placement="top" title="(amount/sqm)">
               Vetting Fee(rate/sqm)
             </h5>
             <div class="form-line">
               <input autocomplete="off" required=""  id="txtVet" name="txtVet" class="form-control align-center" required  data-parsley-type="number" placeholder="%" >
             </div>
             <div class="form-group p-l-10 p-t-30">
              <h5 data-toggle="tooltip" data-placement="top" title="(amount/sqm)">
                Common User Service Area rate(rate/sqm)
              </h5>
              <div class="form-line"> 
                <input autocomplete="off" required=""  id="txtCUSA" name="txtCUSA" class=" form-control align-center" required  data-parsley-type="number" placeholder="%" >
              </div>
            </div>
            <button type="submit" class="btn btn-lg m-t-30 bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton">Update</span></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/utilitiesAjax.js")!!}
{!!Html::script("js/pages/forms/form-wizard.js")!!}
<script type="text/javascript">
  url="{!!route("utilities.index")!!}";
  dataurl="{!!route("utilities.getData")!!}";
</script>
@endsection
