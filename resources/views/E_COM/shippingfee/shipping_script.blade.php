<script>


function deleteRow(btn){

    $('#deleteModal').modal('show');
    var refcode = $(btn).attr('data-id');
    var refcode2 = $(btn).attr('data-id2');
    $(".modal-body #del_name").html(refcode);
    $(".modal-body #del_name2").html(refcode2);
    $(".modal-footer #del_id").val(refcode);
    $(".modal-footer #del_id2").val(refcode2);

}


var numRows = 0;
  
$('#addRow').click(function(){


  numRows2 = $("#tbl_nav #trList").length; // COUNTS THE NUMBER OF ROWS IN THE TABLE
  numRows+=1;
  $row = $('<tr id="trList">'

    +'<td style="padding:0px;" align="center"><label style="color:blue;font-size:10px;">New Data</label></td>'

    +'<td style="padding:0px;"><input type="text" name="area_add[]" placeholder="Area" class="form-control" required></td>'

    +'<td style="padding:0px;"><input type="text" name="price_add[]" value="0.00" placeholder="0.00" id="price_add'+numRows+'" class="form-control" required onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');"></td>'
 
    +'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow3(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times fa-1x"></i></button></td>' 
    +'</tr>'
  );

  $('#userTable').append($row);

});


function deleteRow3(btn) {
  var row3 = btn.parentNode.parentNode;
  row3.parentNode.removeChild(row3);
}


//CURRENCY FORMAT
//


function clickme(_val){
  removezero(_val);
  getAmount(_val);
}

//GET VALUE CONVERT TO FLOAT WITHOUT COMMA
function _p(_val){
  //  return parseFloat(removeComma(document.getElementById(e).value));
  return parseFloat(removeComma(document.getElementById(_val).value));
}

//GET VALUE ONLY
function _t(id){
    return document.getElementById(id).value;
}

//SET VALUE
function _v(id, _val){
    return document.getElementById(id).value = _val;
}

//PUT COMMA WITH DECIMAL
function _f(_val){
  return PutComma((_val).toFixed(2))
}

function removezero(_val){
  var id = $(_val).attr('id');
  if($(_val).val() == "0.00"){
    $('#'+id).val('');
  }else{
    var input1 = $('#'+id).val().replace(/[^0-9.]/g, '');
    var input2 = Number(input1);
    var input3 = input2.toFixed(2);
    $('#'+id).val(input3);
  }
}

function blurme(_val){
  var id = $(_val).attr('id');
  var input1 = $('#'+id).val().replace(/\,/g,'');
  var input2 = Number(input1);
  var input3 = PutComma(input2.toFixed(2));
  var number = input3.split('.');
  var num1 = number[0].replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  var num2 = number[1];
  $('#'+id).val(num1+'.'+num2);
}


function getAmount(_val){
  var id = $(_val).attr('id');
  var valid = $('#'+id).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  if(valid.indexOf('.') !== -1)
  {
    var number = valid.split('.');
    if(number[1].length > 1 && number[1].keyCode != 46 && number[1].keyCode != 8)
    {
      var input = $('#'+id).val().replace(/[^0-9.,]/g, '');
      $('#'+id).val(input);
      var input2 = $('#'+id).val().replace(/\,/g,'');
      var input3 = Number(input2);
      var input4 = input3.toFixed(2);
    }else{
      $('#'+id).val(valid);
    }
  }else{
    $('#'+id).val(valid);
  };
}

function PutComma(id){
  var wo_comma =  id;
  var split_val = wo_comma.split('.');
  var val1 = split_val[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  var val2 = val1 +'.'+ split_val[1];
  return val2;
}

function removeComma(value){
  return (value.indexOf(',') > 0) ? value.replace(/\,/g,'') : value;
}
</script>