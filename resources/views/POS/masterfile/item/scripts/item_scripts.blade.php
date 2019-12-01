@php
  use App\Helpers\Helper;
@endphp
<script>

	$('#close_add_modal').click(function(){
		$('#add_item_code').val('');
		$('#add_item_desc').val('');
		$('#add_item_type').val('');
		$('#add_item_brand').val('');
		$('#add_min_level').val('0');
		$('#add_max_level').val('0');
		$('#add_item_cost').val('0');
		$('#add_item_price').val('0');
		$('#add_item_code').css('border-color','#D1D3E2');
		$('#add_code_msg').css('visibility','hidden');
		$('#add_item_btn').removeAttr('disabled');
		$('#blah').attr('src','#');
	});

	$('#close_edit_modal').click(function(){
		$('#edit_item_code').val('');
		$('#get_code').val('');
		$('#edit_item_type').val('');
		$('#edit_item_brand').val('');
		$('#edit_min_level').val('0');
		$('#edit_max_level').val('0');
		$('#edit_quantity').val('0');
		$('#edit_item_cost').val('0.00');
		$('#edit_item_price').val('0.00');
		$('#edit_item_desc').val('');
		$('#edit_item_code').css('border-color','#D1D3E2');
		$('#edit_code_msg').css('visibility','hidden');
		$('#edit_item_btn').removeAttr('disabled');
		$('#edit_preview').attr('src','#');
	});

	function validateCode(code)
	{
		$.ajax({
			type: "GET",
			url : "{{ route('validate.item.code') }}",
			cache: false,
			data: {code:code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#add_item_code').css('border-color','red');
					$('#add_code_msg').css('visibility','visible');
					$('#add_code_msg').text("*Item Type Code Already Exist !");
					$('#add_item_btn').attr('disabled','true');
				}
				else
				{
					$('#add_item_code').css('border-color','#D1D3E2');
					$('#add_code_msg').css('visibility','hidden');
					$('#add_item_btn').removeAttr('disabled');
				}
			}
		});
	}

	function validateCodeEdit(code)
	{
		var old_code = $('#get_code').val();
		$.ajax({
			type: "GET",
			url : "{{ route('validate.item.code.edit') }}",
			cache: false,
			data: {code:code,old_code:old_code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#edit_item_code').css('border-color','red');
					$('#edit_code_msg').css('visibility','visible');
					$('#edit_code_msg').text("*Item Type Code Already Exist !");
					$('#edit_item_btn').attr('disabled','true');
				}
				else
				{
					$('#edit_item_code').css('border-color','#D1D3E2');
					$('#edit_code_msg').css('visibility','hidden');
					$('#edit_item_btn').removeAttr('disabled');
				}
			}
		});
	}

	function editModal(btn)
	{
		var value = $(btn).attr('data-attr');
		$.ajax({
			type : "GET",
			url : "{{ route('edit.item') }}",
			cache : false,
			data : {code:value},
			success : function(data)
			{
				$('#edit_item_code').val(data.ITEM_CODE);
				$('#get_code').val(data.ITEM_CODE);
				$('#edit_item_desc').val(data.ITEM_DESC);
				$('#edit_item_cost').val(data.STANDARD_COST);
				$('#edit_item_price').val(data.STANDARD_PRICE);
				$('#edit_item_brand').val(data.ITEM_BRAND);
				$('#edit_item_type').val(data.ITEM_TYPE);
				$('#edit_min_level').val(data.MIN_LEVEL);
				$('#edit_max_level').val(data.MAX_LEVEL);
				$('#edit_quantity').val(data.QUANTITY);
				$('#edit_preview').attr('src','/'+data.IMAGE);
				$('#edit_item_desc2').val(data.DESCRIPTION);
			}
		});
		
		$('#editModal').modal('toggle');
		$('#editModal').modal('show');
	}

	function deleteModal(btn)
	{	
		var value = $(btn).attr('data-attr');
		$(".modal-body #code_display").html(value);
		$("#code").val(value);
		$('#deleteModal').modal('toggle');
		$('#deleteModal').modal('show');
	}


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


//for image preview on add

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$("#add_item_image").change(function(){
    readURL(this);
});

function readURLEDIT(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#edit_preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
$("#edit_item_img").change(function(){
    readURLEDIT(this);
});

</script>