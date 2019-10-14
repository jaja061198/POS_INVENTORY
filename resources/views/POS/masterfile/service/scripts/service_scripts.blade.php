@php
  use App\Helpers\Helper;
@endphp
<script>

	$('#close_add_modal').click(function(){
		$('#add_service_code').val('');
		$('#add_service_desc').val('');
		$('#add_service_cost').val('0.00');
		$('#add_service_code').css('border-color','#D1D3E2');
		$('#add_code_msg').css('visibility','hidden');
		$('#add_service_btn').removeAttr('disabled');
	});

	$('#close_edit_modal').click(function(){
		$('#edit_service_code').val('');
		$('#get_code').val('');
		$('#edit_service_cost').val('0.00');
		$('#edit_service_desc').val('');
		$('#edit_serviced_code').css('border-color','#D1D3E2');
		$('#edit_code_msg').css('visibility','hidden');
		$('#edit_service_btn').removeAttr('disabled');
	});

	function validateCode(code)
	{
		$.ajax({
			type: "GET",
			url : "{{ route('validate.service.code') }}",
			cache: false,
			data: {code:code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#add_service_code').css('border-color','red');
					$('#add_code_msg').css('visibility','visible');
					$('#add_code_msg').text("*Item Type Code Already Exist !");
					$('#add_service_btn').attr('disabled','true');
				}
				else
				{
					$('#add_service_code').css('border-color','#D1D3E2');
					$('#add_code_msg').css('visibility','hidden');
					$('#add_service_btn').removeAttr('disabled');
				}
			}
		});
	}

	function validateCodeEdit(code)
	{
		var old_code = $('#get_code').val();
		$.ajax({
			type: "GET",
			url : "{{ route('validate.service.code.edit') }}",
			cache: false,
			data: {code:code,old_code:old_code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#edit_service_code').css('border-color','red');
					$('#edit_code_msg').css('visibility','visible');
					$('#edit_code_msg').text("*Item Type Code Already Exist !");
					$('#edit_service_btn').attr('disabled','true');
				}
				else
				{
					$('#edit_service_code').css('border-color','#D1D3E2');
					$('#edit_code_msg').css('visibility','hidden');
					$('#edit_service_btn').removeAttr('disabled');
				}
			}
		});
	}

	function editModal(btn)
	{
		var value = $(btn).attr('data-attr');
		$.ajax({
			type : "GET",
			url : "{{ route('edit.service') }}",
			cache : false,
			data : {code:value},
			success : function(data)
			{
				$('#edit_service_code').val(data.SERVICE_CODE);
				$('#get_code').val(data.SERVICE_CODE);
				$('#edit_service_desc').val(data.SERVICE_DESC);
				$('#edit_service_cost').val(data.STANDARD_COST);
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
</script>