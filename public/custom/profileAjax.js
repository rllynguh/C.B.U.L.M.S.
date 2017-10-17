$(document).ready(function(){
	$("#btnSubmitChanges").on("click", submitForm);
});
function submitForm(){
	var formData = $("#profileForm").serialize();
	$.ajax({
		url: url,
		type: 'POST',
		data: formData,
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	showSuccessPrompt();
	console.log(formData);
}