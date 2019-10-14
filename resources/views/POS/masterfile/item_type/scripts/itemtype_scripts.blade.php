<script>

	$('#close_add_modal').click(function(){
		$('#add_item_type_code').val('');
		$('#add_item_type_desc').val('');
		$('#add_item_type_code').css('border-color','#D1D3E2');
		$('#add_code_msg').css('visibility','hidden');
		$('#add_item_type_btn').removeAttr('disabled');
	});

	$('#close_edit_modal').click(function(){
		$('#edit_item_type_code').val('');
		$('#get_code').val('');
		$('#edit_item_type_desc').val('');
		$('#edit_itemtype_code').css('border-color','#D1D3E2');
		$('#edit_code_msg').css('visibility','hidden');
		$('#edit_item_type_btn').removeAttr('disabled');
	});

	function validateCode(code)
	{
		$.ajax({
			type: "GET",
			url : "{{ route('validate.itemtype.code') }}",
			cache: false,
			data: {code:code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#add_item_type_code').css('border-color','red');
					$('#add_code_msg').css('visibility','visible');
					$('#add_code_msg').text("*Item Type Code Already Exist !");
					$('#add_item_type_btn').attr('disabled','true');
				}
				else
				{
					$('#add_item_type_code').css('border-color','#D1D3E2');
					$('#add_code_msg').css('visibility','hidden');
					$('#add_item_type_btn').removeAttr('disabled');
				}
			}
		});
	}

	function validateCodeEdit(code)
	{
		var old_code = $('#get_code').val();
		$.ajax({
			type: "GET",
			url : "{{ route('validate.itemtype.code.edit') }}",
			cache: false,
			data: {code:code,old_code:old_code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#edit_item_type_code').css('border-color','red');
					$('#edit_code_msg').css('visibility','visible');
					$('#edit_code_msg').text("*Item Type Code Already Exist !");
					$('#edit_item_type_btn').attr('disabled','true');
				}
				else
				{
					$('#edit_item_type_code').css('border-color','#D1D3E2');
					$('#edit_code_msg').css('visibility','hidden');
					$('#edit_item_type_btn').removeAttr('disabled');
				}
			}
		});
	}

	function editModal(btn)
	{
		var value = $(btn).attr('data-attr');
		$.ajax({
			type : "GET",
			url : "{{ route('edit.itemtype') }}",
			cache : false,
			data : {code:value},
			success : function(data)
			{
				$('#edit_item_type_code').val(data.ITEM_TYPE_CODE);
				$('#get_code').val(data.ITEM_TYPE_CODE);
				$('#edit_item_type_desc').val(data.ITEM_TYPE_DESC);
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
</script>