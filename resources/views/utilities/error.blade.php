<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div class="container-fluid">
		<img src="/images/loading.gif" class="img-responsive align-center " alt="Image">
	</div>
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>
<!-- 
/*
var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
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
             Get Page Data
    Old Code, might need it again if shit doesn't work
    
    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: _url,
            data: {page:page}
        }).done(function(data){
            manageRow(data[0].data);
        });
    }

    Add new Item table row
    Old Code, might need it again if shit doesn't work
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
        */