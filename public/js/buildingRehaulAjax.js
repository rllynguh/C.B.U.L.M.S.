$(document).ready(function()
{
    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    var load = 'buildings';
    var link = [];
    var _url = url;
    var table;
    getBuildingType();
    getProvince();
    manageData();
    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 30000 );
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
    });
    /* manage data list */
    function manageData() {
        var _data = [];
        if(load === 'buildings'){
            _url = url;
            table = $('#myTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: _url,
            columns: [
            {data: 'code', name: 'code', title: 'Building Code',class: 'align-center'},
            {data: 'building_name', name: 'building_name', title: 'Building Name',class: 'align-center'},
            {data: 'city_name', name: 'city_name', title: 'City',class: 'align-center'},
            {data: 'is_active', name: 'is_active', title: 'Status',class: 'align-center', searchable: false},
            {data: 'action', name: 'action', title: 'Actions',class: 'align-center', orderable: false, searchable: false}
            ]
            });
        }else if(load === 'floors'){
            _url = url + "/floors/" + link[0];
            table = $('#myTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: _url,
            columns: [
            {data: 'number', name: 'number', title: 'Floor #',class: 'align-center'},
            {data: 'num_of_unit', name: 'num_of_unit', title: 'Number of units',class: 'align-center'},
            {data: 'is_active', name: 'status', title: 'Status',class: 'align-center',searchable:false},
            {data: 'action', name: 'action', title: 'Actions',class: 'align-center', orderable: false, searchable: false}
            ]
            });
            
        }else if(load === 'units'){
            _url = url + '/units/' + link[1];
            console.log(_url);
            table = $('#myTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: _url,
            columns: [
            {data: 'code', name: 'code', title: 'Unit ID',class: 'align-center'},
            {data: 'type', name: 'type', title: 'Unit Type',class: 'align-center'},
            {data: 'size', name: 'size', title: 'Area',class: 'align-center'},
            {data: 'price', name: 'price', title: 'Rates',class: 'align-center'},
            {data: 'is_active', name: 'status',searchable:false, title: 'Status',class: 'align-center'},
            {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions',class: 'align-center'}
            ]
            });

            //$("thead").html('<th class="align-center">Unit ID</th><th class="align-center">Unit Type</th><th class="align-center">Area</th><th class="align-center">Rate</th><th class="align-center">Status</th><th class="align-center">Action</th>'); 
        }
        
       
    };

    /* Get Page Data
    Old Code, might need it again if shit doesn't work
    */
    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: _url,
            data: {page:page}
        }).done(function(data){
            manageRow(data[0].data);
        });
    }

    /* Add new Item table row
    Old Code, might need it again if shit doesn't work
     */
    function manageRow(data) {
        var rows = '';
        $.each( data, function( key, value ) {
            if(load === 'buildings'){
                var status = 'inactive';
                if(key.status = 1){
                    status = 'active';
                }
                rows = rows + '<tr>';
                rows = rows + '<td>'+value.code+'</td>';
                rows = rows + '<td>' + value.building_name + '</td>';
                //rows = rows + '<td> <a class = "buildingLink" href="#" data-id = "' + value.id + '">' 
                //+value.building_name+'</a></td>';
                rows = rows + '<td>'+value.city_name+'</td>';
                rows = rows + '<td>'+status+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<button data-target="#show-units" class="btn btn-primary show-floors" data-id = "' + value.id  +'">Show floors</button> ';
                rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
                rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            }else if(load === 'floors'){
                var status = 'inactive';
                if(key.status = 1){
                    status = 'active';
                }
                rows = rows + '<tr>';
                rows = rows + '<td>'+value.number+'</td>';
                rows = rows + '<td>'+value.num_of_unit+'</td>';
                rows = rows + '<td>'+status+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<button data-target="#show-units" class="btn btn-primary show-units" data-id = "' + value.id  +'">Show units</button> ';
                rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
                rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            }else if(load === 'units'){
                var status = 'inactive';
                if(key.status = 1){
                    status = 'active';
                }
                var type = 'Raw'
                if(value.type = 1){
                    type = 'Shell';
                }
                rows = rows + '<tr>';
                rows = rows + '<td>'+value.unit_code+'</td>';
                rows = rows + '<td>'+type+'</td>';
                rows = rows + '<td>'+value.size+'</td>';
                rows = rows + '<td>'+value.price+'</td>';
                rows = rows + '<td>'+status+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
                rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            }
        });
        $("tbody").html(rows);
    };
    /* Create new Item */
    $("#btnBuildingSave").click(function(e){
        $("#btnBuildingSave").attr('disabled','disabled');
          setTimeout(function(){
            $("#btnBuildingSave").removeAttr('disabled');
          }, 1000);
        e.preventDefault();
        var formData = $("#buildingCreateForm").serialize(); 
        var form_action = $("#buildingCreateModal").find("form").attr("action");
        $.ajax({
            type:'POST',
            url: form_action,
            data:formData,
        }).done(function(data){
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
        });

    });
    /* Show floors */
    $("body").on("click",".show-floors",function(){
        load = "floors";
        link[0] = $(this).attr("data-id")
        console.log(link[0] + "," +load );
        table.destroy();
        $('#myTable').empty();
        manageData();
    });
      /* Show Units */
    $("body").on("click",".show-units",function(){
        load = "units";
        link[1] = $(this).attr("data-id")
        console.log(link[1] + "," +load );
        table.destroy();
        $('#myTable').empty();
        manageData();
    });
    /* Remove Item */
    $("body").on("click",".remove-item",function(){
        var id = $(this).parent("td").data('id');
        var c_obj = $(this).parents("tr");
        $.ajax({
            dataType: 'json',
            type:'delete',
            url: url + '/' + id,
        }).done(function(data){
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
        });
    });

    /* Edit Item */
    $("body").on("click",".edit-item",function(){
        var id = $(this).parent("td").data('id');
        var title = $(this).parent("td").prev("td").prev("td").text();
        var description = $(this).parent("td").prev("td").text();
        $("#edit-item").find("input[name='title']").val(title);
        $("#edit-item").find("textarea[name='description']").val(description);
        $("#edit-item").find("form").attr("action",url + '/' + id);
    });

    /* Updated new Item */
    $(".crud-submit-edit").click(function(e){
        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
        var title = $("#edit-item").find("input[name='title']").val();
        var description = $("#edit-item").find("textarea[name='description']").val();
        $.ajax({
            dataType: 'json',
            type:'PUT',
            url: form_action,
            data:{title:title, description:description}
        }).done(function(data){
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
        });
    });

});
function getBuildingType()
{
 $.get(urlbtype, function (data) {
  $('#building_type').children('option').remove();
  $.each(data,function(index,value)
  {
    $('#building_type').append($('<option>', {value:value.id, text:value.description}));
  });
});
}


function getProvince()
{
  $.get(urlprov, function (data) {
    $('#building_province').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#building_province').append($('<option>', {value:value.id, text:value.description}));
    });
    getCity();
  });
}


//for querying list of city
function getCity()
{
  $.get('/custom/getCity/' + $("#building_province").val(), function (data) {
    $('#building_city').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#building_city').append($('<option>', {value:value.id, text:value.description}));
    });
  });
}

//for querying city when user selects province
$("#building_province").change(function(data){
  getCity();
});
/*
 $.ajax({
            dataType: 'json',
            url: _url,
            data: {page:page}
        }).done(function(data){

            total_page = data.last_page;
            current_page = data.current_page;

            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: current_page,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    if(is_ajax_fire != 0){
                      getPageData();
                    }
                }
            });

            manageRow(data.data);
            is_ajax_fire = 1;
        });
        */