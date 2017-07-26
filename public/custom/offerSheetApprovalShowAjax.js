$(document).ready(function()
{ 
 $.ajaxSetup(
 {
  headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  }
})
 var table = $('#myTable').DataTable({
  responsive: true,
  processing: true,
  serverSide: true,
  ajax: {
    url: dataurl,
    type: "POST"
  },
  columns: [
  {data: 'regi_id'},
  {data: 'offer_id'},
  {data: 'unit_code'},
  {data: 'building_type'},
  {data: 'unit_size'},
  {data: 'unit_type'},
  {data: 'floor'},
  {data: 'action'}
  ]
});
 $(this).on('change', '#checkboxReject',function(e)
 { 

  if($(this).is(":checked")) 
    $(".offer-detail").attr('disabled','disabled');
  else
    $(".offer-detail").removeAttr('disabled','disabled');

}
);
 $(this).on('change', '.offer-detail',function(e)
 { 
  value=false;
       //check if all detail checkbox are checked
       if ($('.offer-detail:checked').length == $('.offer-detail').length) {
         value=true;
       }
       $('#checkboxReject').prop('checked', value);

     }
     );
 $(this).on('change', '.offer-detail',function(e)
 { 
  myId=$(this).val();
  if($(this).is(":checked")) 
    $("#offer"+myId).val('2');
  else
    $("#offer"+myId).val('1');
}
);
});