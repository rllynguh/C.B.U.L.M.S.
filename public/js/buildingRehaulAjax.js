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
        }


    };


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
    });

    /* Old code*/
    $(".crud-submit-edit").click(function(e) {
        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
        var title = $("#edit-item").find("input[name='title']").val();
        var description = $("#edit-item").find("textarea[name='description']").val();
        $.ajax({
            dataType: 'json',
            type: 'PUT',
            url: form_action,
            data: { title: title, description: description }
        }).done(function(data) {
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', { timeOut: 5000 });
        });
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
        $('#navBuilding').html( '<a class="breadcrumb-item" href="#">Buildings</a>' );
        if($(this).attr("id")==='btnShowBuilding'){
            load = "building";
        }else if($(this).attr("id")==='btnShowFloor'){
            load = "floor";
            link[0] = $(this).attr("data-id");
            console.log("access: building "+ link[0]);
            $('#navBuilding').append( '<span class="breadcrumb-item active" id = "btnShowFloor" data-id = "'+$(this).attr("data-id")+'">Floors</span>' );
        }else if($(this).attr("id")==='btnShowUnit'){
            load = "unit";
            link[1] = $(this).attr("data-id");
            console.log("access: floor "+ link[1]);
            $('#navBuilding').append( '<a span class="breadcrumb-item" id = "btnShowFloor" href ="#" data-id = "'+load[0]+'">Floors</span>' );
            $('#navBuilding').append( '<span class="breadcrumb-item active">Units</span>' );
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
});
