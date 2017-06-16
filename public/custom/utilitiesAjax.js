$(document).ready(function()
{
	setdata();

	function successPrompt(){
		title="Utlities has been updated!";
		$.notify(title, "success",
		{
			timer:1000
		});
	}
	$('#btnSave').on('click',function(e)
	{
		if($('#myForm').parsley().isValid())
		{
			$.ajaxSetup(
			{
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})
			e.preventDefault(); 
			var my_url = url;
			var type="POST";
			var formData = $('#myForm').serialize();
			console.log(formData);
			$.ajax({
				type: type,
				url: my_url,
				data: formData,
				dataType: 'json',
				success: function (data) {
					console.log(data);
					setdata();
					successPrompt();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		}
	}
	);
	function setdata()
	{
		$.get(dataurl, function (data) 
		{
			console.log(data);
			$("#txtCUSA").val(data.cusa_rate);
			$("#txtEWT").val(data.ewt_rate);
			$("#txtSec").val(data.security_deposit_rate);
			$("#txtVet").val(data.vetting_fee);
			$("#txtEsca").val(data.escalation_rate);
			$("#txtVAT").val(data.vat_rate);
		}) 
	}
});