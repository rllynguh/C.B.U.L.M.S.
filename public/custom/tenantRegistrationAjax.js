var room = 1;
function fields() {

  room++;
  var objTo = document.getElementById('fields')
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
  divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"><input type="text" class="form-control" id="floor" name="floor[]" value="" placeholder="Floor"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><select class="form-control" id="type" name="type[]"></select></div></div></div><div class="col-sm-3 nopadding"><div class="form-group"><input type="text" class="form-control" id="size" name="size[]" value="" placeholder="Size"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><input type="text" class="form-control" id="remarks" name="remarks[]" value="" placeholder="Remarks"></div><div class="input-group-btn"><button class="btn btn-success" type="button"  onclick="fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button></div></div><div class="clear"></div>';

  objTo.appendChild(divtest)
}
function remove_fields(rid) {
  $('.removeclass'+rid).remove();
}