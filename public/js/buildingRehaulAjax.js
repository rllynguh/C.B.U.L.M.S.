$(document).ready(function() {
    var load = 'building';
    var link = [];
    var _url = url;
    var table;
    getBuildingType();
    getProvince();
    manageData();
    setInterval(function() {
        table.ajax.reload(null, false); // user paging is not reset on reload
    }, 30000);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    /* Create new Item */
    $("#btnBuildingSubmit").click(function(e) {
        if ($('#buildingCreateForm').parsley().isValid()) {
            $("#btnBuildingSubmit").attr('disabled', 'disabled');
            setTimeout(function() {
                $("#btnBuildingSubmit").removeAttr('disabled');
            }, 1000);
            e.preventDefault();
            var formData = $("#buildingCreateForm").serialize();
            var form_action;
            var type;
            if ($(this).text() === 'Save') {
                type = 'POST';
                form_action = url;
            } else if ($(this).text() === 'Edit') {
                type = 'PUT';
                form_action = url + '/' + $('#myId').val();
            }
            $.ajax({
                type: type,
                url: form_action,
                data: formData,
            }).done(function(data) {
                $(".modal").modal('hide');
                toastr.success('Item Created Successfully.', 'Success Alert', { timeOut: 5000 });
            });
        }


    });
    // Create button clicked
    $("#btnShowCreate").click(function(e) {
        $("#btnBuildingSubmit").html('Save');
    });
    /* Show building edit form */
    $("body").on("click", ".btnEdit", function() {
        if ($(this).attr("data-target") === '#buildingCreateModal') {
            $("#btnBuildingSubmit").html('Edit');
            var myId = $(this).data('id');
            console.log(myId);
            $.get(url + '/' + myId + '/edit', function(data) {
                $('#btnBuildingSubmit').val('Edit');
                //changeLabel();
                if (parseInt(data.current) == 0)
                    value = "1";
                else
                    value = data.current;
                $("#building_num_of_floors").attr("min", value);
                $("#building_type").attr("disabled", "");
                $('#myId').val(data.id);
                var exists = false;
                $('#building_type').each(function() {
                    if (this.value == data.building_type_id) {
                        exists = true;
                        return false;
                    }
                });
                if (!exists) {
                    $('#building_type').append($('<option>', { value: data.building_type_id, text: data.building_type_description }));
                    $('#building_type').val(data.building_type_id);
                }
                $('#building_type').val(data.building_type_id);
                $('#building_name').val(data.description);
                $('#building_num_of_floors').val(data.num_of_floor);
                $('#building_address').val(data.address_number);
                $('#building_street').val(data.street);
                $('#building_district').val(data.district);
                $('#building_city').val(data.city_id);
                $('#building_province').val(data.province_id);
            })
        }else if($(this).attr("data-target") === '#floorCreateModal'){
            var myId = $(this).val();
            getBuilding();
            $.get(url + '/' + myId + '/edit', function (data) {
              value="";
              if(parseInt(data.current)<1)
                {value="1";
            }
            else
              {value=data.current;}
            var exists = false;
            $('#comBuilding').each(function(){
              if (this.value == data.building_id) {
                exists = true;
                return false;
              }
            });
            if(!exists)
            { 
              $('#comBuilding').append($('<option>', {value: data.building_id, text: data.description}));
              $('#comBuilding').val(data.building_id);
            }
            $("#comBuilding").attr("disabled","");
            $('#myId').val(data.id);
            $('#comBuilding').val(data.building_id);
            $('#txtFNum').val(data.number);
            $('#txtUNum').val(data.num_of_unit);
            $("#txtUNum").attr("min",value);
            $('#myModal').modal('show');
          }) 
        }else if($(this).attr("data-target") === '#floorCreateModal'){

        }

    });

    /* Remove Item */
    $("body").on("click", ".remove-item", function() {
        var id = $(this).parent("td").data('id');
        var c_obj = $(this).parents("tr");
        $.ajax({
            dataType: 'json',
            type: 'delete',
            url: url + '/' + id,
        }).done(function(data) {
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', { timeOut: 5000 });
            getPageData();
        });
    });

    /*  When navigation button is clicked */

    $(".body").on("click", ".btnChangeTable", function() {
        var click_id = $(this).attr("id")
        $('#navBuilding').html('<a class="breadcrumb-item" href="#">Buildings</a>');
        if ( click_id === 'btnShowBuilding') {
            load = "building";
            $("#header").html("<h3>List of buildings</h3>");
            $('#btnShowCreate').attr('data-target', '#buildingCreateModal');
        } else if (click_id  === 'btnShowFloor') {
            load = "floor";
            $("#header").html("<h3>List of Floors</h3>");
            link[0] = $(this).attr("data-id");
            $('#btnShowCreate').attr('data-target', '#floorCreateModal');
            console.log("access: building " + link[0]);
            $('#navBuilding').append('<span class="breadcrumb-item active" id = "btnShowFloor" data-id = "' + $(this).attr("data-id") + '">Floors</span>');
        } else if (click_id  === 'btnShowUnit') {
            load = "unit";
            $("#header").html("<h3>List of Units</h3>");
            link[1] = $(this).attr("data-id");
            console.log("access: floor " + link[1]);
            $('#btnShowCreate').attr('data-target', '#unitCreateModal');
            $('#navBuilding').append('<a span class="breadcrumb-item" id = "btnShowFloor" href ="#" data-id = "' + load[0] + '">Floors</span>');
            $('#navBuilding').append('<span class="breadcrumb-item active">Units</span>');
        }else if(click_id === 'btnShowParkArea'){
            load = "parkArea";
            $("#header").html("<h3>List of Park Areas</h3>");
            link[2] = $(this).attr("data-id");
            $('#btnShowCreate').attr('data-target', '#parkAreaCreateModal');
            $('#navBuilding').append('<span class="breadcrumb-item active">Park Area</span>');
        }
        table.destroy();
        $('#myTable').empty();
        manageData();
    });

    /*
        Pointless things that are just there to load data
    */


    function getBuildingType() {
        $.get(urlbtype, function(data) {
            $('#building_type').children('option').remove();
            $.each(data, function(index, value) {
                $('#building_type').append($('<option>', { value: value.id, text: value.description }));
            });
        });
    }

    function getProvince() {
        $.get(urlprov, function(data) {
            $('#building_province').children('option').remove();
            $.each(data, function(index, value) {
                $('#building_province').append($('<option>', { value: value.id, text: value.description }));
            });
            getCity();
        });
    }


    //for querying list of city
    function getCity() {
        $.get('/custom/getCity/' + $("#building_province").val(), function(data) {
            $('#building_city').children('option').remove();
            $.each(data, function(index, value) {
                $('#building_city').append($('<option>', { value: value.id, text: value.description }));
            });
        });
    }

    //for querying city when user selects province
    $("#building_province").change(function(data) {
        getCity();
    });
     function getBuilding()
      {
        $.get(url + '/get/building', function (data) {
          selected=$("#comBuilding").val();
          $('#comBuilding').children('option').remove();
          $.each(data,function(index,value)
          {
            $('#comBuilding').append($('<option>', {value:value.id, text:value.description}));
          });
          $("#comBuilding").val(selected);
          if( !$('#comBuilding').has('option').length > 0  && $("#btnSave").val()=="Save" ) 
          { 
            $.notify("No building available", "warn");
            $("#myModal").modal("hide");
          }
          getLatest();
        });
  }


  /*
          table.MakeCellsEditable({
        "onUpdate": myCallbackFunction
    });
function  myCallbackFunction(updatedCell, updatedRow, oldValue) {
        console.log("The new value for the cell is: " + updatedCell.data());
        console.log("The values for each cell in that row are: " + updatedRow.data());
    }
*/
    /* manage data list */
    function manageData() {
        var _data = [];
        if (load === 'building') {
            _url = url;
            table = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: _url,
                columns: [
                    { data: 'code', name: 'code', title: 'Building Code', class: 'align-center' },
                    { data: 'building_name', name: 'building_name', title: 'Building Name', class: 'align-center' },
                    { data: 'city_name', name: 'city_name', title: 'City', class: 'align-center' },
                    { data: 'is_active', name: 'is_active', title: 'Status', class: 'align-center', searchable: false },
                    { data: 'action', name: 'action', title: 'Actions', class: 'align-center', orderable: false, searchable: false }
                ]
            });
        } else if (load === 'floor') {
            _url = url + "/floors/" + link[0];
            table = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: _url,
                columns: [
                    { data: 'number', name: 'number', title: 'Floor #', class: 'align-center' },
                    { data: 'num_of_unit', name: 'num_of_unit', title: 'Number of units', class: 'align-center' },
                    { data: 'is_active', name: 'status', title: 'Status', class: 'align-center', searchable: false },
                    { data: 'action', name: 'action', title: 'Actions', class: 'align-center', orderable: false, searchable: false }
                ]
            });

        } else if (load === 'unit') {
            _url = url + '/units/' + link[1];
            console.log(_url);
            table = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: _url,
                columns: [
                    { data: 'code', name: 'code', title: 'Unit ID', class: 'align-center' },
                    { data: 'type', name: 'type', title: 'Unit Type', class: 'align-center' },
                    { data: 'size', name: 'size', title: 'Area', class: 'align-center' },
                    { data: 'price', name: 'price', title: 'Rates', class: 'align-center' },
                    { data: 'is_active', name: 'status', searchable: false, title: 'Status', class: 'align-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions', class: 'align-center' }
                ]
            });

            //$("thead").html('<th class="align-center">Unit ID</th><th class="align-center">Unit Type</th><th class="align-center">Area</th><th class="align-center">Rate</th><th class="align-center">Status</th><th class="align-center">Action</th>'); 
        } else if (load === 'parkArea'){
            _url = url + '/parkAreas/' + link[2];
            console.log(_url);
            table = $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: _url,
                columns: [
                {data: 'building_description', name: 'building_description', title: 'Building Code', class: 'align-center'},
                {data: 'description', name: 'description', title: 'Unit ID', class: 'align-center'},
                {data: 'number', name: 'number'},
                {data: 'size', name: 'size'},
                {data: 'num_of_space', name: 'num_of_space'},
                {data: 'is_active', name: 'is_active', searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }
        
    };

});