
var buil_option="";
var floor_option="";
var range_option="";

var room = 1;
function fields() {

  room++;
  var objTo = document.getElementById('fields')
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
  divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><label class="control-label">Building Type*</label><select class="form-control form-line" id="builtype" name="builtype[]">' + buil_option +'</select></div></div></div>  <div class="col-sm-3 nopadding"><div class="form-group"><label class="control-label">Floor #*</label><select class="form-control form-line" id="floor" name="floor[]">'+ floor_option +'</select></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><label class="control-label">Unit Type*</label><select class="form-control form-line" id="utype" name="utype[]"><option value="0">Raw</option><option value="1">Shell</option></select></div></div></div>  <div class="col-sm-3 nopadding"><div class="form-group"><label class="control-label">Size*</label><select class="form-control form-line" id="size" name="size[]">'+ range_option +'</select></div></div><div class="col-sm-12 nopadding"><div class="form-group"><label class="control-label">Remarks*</label><textarea class="form-control form-line" id="remarks" name="remarks[]" value="" ></textarea></div><div class="input-group-btn"><button class="btn btn-danger" type="button"  onclick="remove_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div><div class="clear"></div>';

  objTo.appendChild(divtest);
}
function remove_fields(rid) {
  $('.removeclass'+rid).remove();

}

function getBuildingType()
{
  $.get(buil_type_url, function (data) {
    $.each(data,function(index,value)
    {
      $('#builtype').append($('<option>', {value:value.id, text:value.description}));
      buil_option+=' <option value="' + value.id +'">' + value.description + '</option>';
    });
  });
}


function getFloor()
{
  $.get(floor_url, function (data) {
    $.each(data,function(index,value)
    {
      $('#floor').append($('<option>', {value:value.number, text:value.number}));
      floor_option+=' <option value="' + value.number + '">' + value.number + '</option>';
    });
    console.log(data);
  });
}


function getRange()
{
  $.get(range_url, function (data) {
    $.each(data,function(index,value)
    {
      $('#size').append($('<option>', {value:value.value, text:value.name}));
      range_option+=' <option value="' + value.value +'">' + value.name + '</option>';
    });
  });
}




//for querying list of city
function getTenaCity()
{
  $.get('/custom/getCity/' + $("#tena_province").val(), function (data) {
    console.log(data);
    $('#tena_city').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#tena_city').append($('<option>', {value:value.id, text:value.description}));
    });
  });
}
function getReprCity()
{
  $.get('/custom/getCity/' + $("#repr_province").val(), function (data) {
    console.log(data);
    $('#repr_city').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#repr_city').append($('<option>', {value:value.id, text:value.description}));
    });
  });
}



$(document).ready(function()
{
 getTenaCity();
 getReprCity();
 getBuildingType();
 getFloor();
 getRange();
 $("#tena_province").change(function(data){
  getTenaCity();
});
 $("#repr_province").change(function(data){
  getReprCity();
});
 var form = $('#wizard_with_validation').show();
 form.steps({
  headerTag: 'h3',
  bodyTag: 'fieldset',
  transitionEffect: 'slideLeft',
  onInit: function (event, currentIndex) {
    $.AdminBSB.input.activate();

            //Set tab width
            var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
            var tabCount = $tab.length;
            $tab.css('width', (100 / tabCount) + '%');

            //set button waves effect
            setButtonWavesEffect(event);
          },
          onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) { return true; }

            if (currentIndex < newIndex) {
              form.find('.body:eq(' + newIndex + ') label.error').remove();
              form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
            }

            form.validate().settings.ignore = ':disabled,:hidden';
            return form.valid();
          },
          onStepChanged: function (event, currentIndex, priorIndex) {
            if(currentIndex==4)
            {
              console.log('dad');
              $("#dispCompany").text($('#tenant').val());
              $("#dispBusiness").text($('#busitype').find(":selected").text());
              $("#dispCompAddress").text($('#tena_number').val() + " " + $('#tena_street').val() + " " + $('#tena_street').val() + ", " +
                $('#tena_barangay').val() + " " + $('#tena_city').find(":selected").text() + ", " + $('#tena_province').find(":selected").text());
              $("#dispName").text($('#fname').val() + 
                " " + $('#mname').val() + " " + $('#lname').val());
              $("#dispPosition").text($('#position').find(":selected").text());
              $("#dispCell").text($('#cellno').val());
              $("#dispTel").text($('#telno').val());
              $("#dispEmail").text($('#email').val());
              $("#dispRepAddress").text($('#repr_number').val() +
                " " + $('#repr_street').val() + " " + $('#repr_barangay').val() +
                $('#repr_street').val() + " " + $('#repr_city').find(":selected").text() + ", " + $('#repr_province').find(":selected").text());
              $("#dispRequest").text();
              $("#dispDuration").text($('#duration').val());
              $("#dispRemarks").text($('#header_remarks').val());
            }
            setButtonWavesEffect(event);
          },
          onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ':disabled';
            return form.valid();
          },
          onFinished: function (event, currentIndex) {
            var form = $(this);

            // Submit form input

            form.submit();
          }
        });

 form.validate({
  highlight: function (input) {
    $(input).parents('.form-line').addClass('error');
  },
  unhighlight: function (input) {
    $(input).parents('.form-line').removeClass('error');
  },
  errorPlacement: function (error, element) {
    $(element).parents('.form-group').append(error);
  },
  rules: {
    'confirm': {
      equalTo: '#password'
    }
  }
});
 console.log($('#busitype').find(":selected").text());
})

function setButtonWavesEffect(event) {
  $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
  $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}
