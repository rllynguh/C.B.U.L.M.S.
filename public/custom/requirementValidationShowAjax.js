$(document).ready(function()
{ 
	xhrPool=[];
	$.ajaxSetup(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})

	$(this).on('click', '#btnChoose',function(e)
	{ 
		$('#modalChoose').modal('show');
	});

	$(this).on('click', '.btnDecide' ,function(e)
	{
		e.preventDefault(); 
		$('#decision').val($(this).val());
		$.ajax({
			beforeSend: function (jqXHR, settings) {
				xhrPool.push(jqXHR);
			},
			type: "POST",
			url: url,
			data: $("#frmRequirement").serialize(),
			success: function (data) {
				$('#modalChoose').modal('hide');
			},
			error: function (data) {
				console.log('Error:', data.responseText);
			}
		});
	}); 
});