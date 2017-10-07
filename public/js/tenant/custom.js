$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.get(urlbtype, function(data) {
            $('#testa').children('option').remove();
            $.each(data, function(index, value) {
                $('#testa').append($('<option>', { value: value.id, text: value.description }));
            });

        });
    getBuildingType();
     getFloor();
     getRange();
    $( ".selectMenu" ).selectmenu();
    $( "#newContract" ).on( "click", toggleShowCurrentContracts );
    $( "#existingContract" ).on( "click", toggleShowCurrentContracts );
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });
    $("#btnRequestSubmit").click(function(e) {
         $("#btnRequestSubmit").attr('disabled', 'disabled');
        setTimeout(function() {
            $("#btnRequestSubmit").removeAttr('disabled');
        }, 1000);
        e.preventDefault();
        var formData = $("#requestUnitsForm").serialize();
        $.ajax({
                type: 'POST',
                url: urlSubmit,
                data: formData,
                error:function (data) {
                    console.log('Error:', data.responseText);
                },
                success:function(data) {
                console.log(data);
                //toastr.success('Item Created Successfully.', 'Success Alert', { timeOut: 5000 });
                }
            });
    });
});
var room = 1;
var buil_option="";
var floor_option="";
var range_option="";
function fields() {

  room++;
  var objTo = document.getElementById('fields')
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
  divtest.innerHTML = '<div class="input-group-btn pull-right m-r--5 header-dropdown"><button class="btn btn-danger" type="button"  onclick="remove_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div><div class="col-sm-3 nopadding"> <div class=form-group> <div class=input-group> <label class=control-label>Building Type*</label> <div class=form-line> <select class="form-control form-line" id=builtype name=builtype[]>' + buil_option +'</select> </div> </div> </div> </div> <div class="col-sm-3 nopadding"> <div class=form-group> <label class=control-label>Floor #*</label> <div class=form-line> <select class="form-control form-line" id=floor name=floor[]>'+ floor_option +'</select> </div> </div> </div> <div class="col-sm-3 nopadding"> <div class=form-group> <div class=input-group> <label class=control-label>Unit Type*</label> <div class=form-line> <select class="form-control form-line" id=utype name=utype[]> <option value=0>Raw</option> <option value=1>Shell</option> </select> </div> </div> </div> </div> <div class="col-sm-3 nopadding"> <div class=form-group> <label class=control-label>Size*</label> <div class=form-line> <select class="form-control form-line" id=size name=size[]>'+ range_option +'</select> </div> </div> </div> <div class="col-sm-12 nopadding"> <div class=form-group> <label class=control-label>Remarks*</label> <div class=form-line> <textarea class="form-control form-line" id=remarks name=remarks[] value></textarea> </div> </div> </div>'
  //divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><label class="control-label">Building Type*</label><select class="form-control form-line" id="builtype" name="builtype[]">' + buil_option +'</select></div></div></div>  <div class="col-sm-3 nopadding"><div class="form-group"><label class="control-label">Floor #*</label><select class="form-control form-line" id="floor" name="floor[]">'+ floor_option +'</select></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><label class="control-label">Unit Type*</label><select class="form-control form-line" id="utype" name="utype[]"><option value="0">Raw</option><option value="1">Shell</option></select></div></div></div>  <div class="col-sm-3 nopadding"><div class="form-group"><label class="control-label">Size*</label><select class="form-control form-line" id="size" name="size[]">'+ range_option +'</select></div></div><div class="col-sm-12 nopadding"><div class="form-group"><label class="control-label">Remarks*</label><textarea class="form-control form-line" id="remarks" name="remarks[]" value="" ></textarea></div><div class="input-group-btn"><button class="btn btn-danger" type="button"  onclick="remove_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div><div class="clear"></div>';
  objTo.appendChild(divtest);
}
function remove_fields(rid) {
  $('.removeclass'+rid).remove();

}

function toggleShowCurrentContracts(){
    elem = 'test';
    if(document.getElementById(elem).style.display == 'none'){
        document.getElementById(elem).style.display = '';
        $('select option:first-child').attr("selected", "selected");
    }else{
        document.getElementById(elem).style.display = 'none';
    }
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


function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}