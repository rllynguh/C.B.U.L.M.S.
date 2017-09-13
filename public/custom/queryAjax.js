
$(document).ready(function()
{ 
  //datatables


  $(this).on('click', '#registrationQuery',function(e)
  { 
    e.preventDefault();
    $('#modalQuery').modal('show');
  });
});