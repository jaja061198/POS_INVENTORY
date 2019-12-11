<script>

	$('#close_add_modal').click(function(){
		$('#add_brand_code').val('');
		$('#add_brand_desc').val('');
		$('#add_brand_code').css('border-color','#D1D3E2');
		$('#add_code_msg').css('visibility','hidden');
		$('#add_brnd_btn').removeAttr('disabled');
	});

	$('#close_edit_modal').click(function(){
		$('#edit_brand_code').val('');
		$('#get_code').val('');
		$('#edit_brand_desc').val('');
		$('#edit_brand_code').css('border-color','#D1D3E2');
		$('#edit_code_msg').css('visibility','hidden');
		$('#edit_brnd_btn').removeAttr('disabled');
	});

	function validateCode(code)
	{
		$.ajax({
			type: "GET",
			url : "{{ route('validate.brand.code') }}",
			cache: false,
			data: {code:code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#add_brand_code').css('border-color','red');
					$('#add_code_msg').css('visibility','visible');
					$('#add_code_msg').text("*Brand Code Already Exist !");
					$('#add_brnd_btn').attr('disabled','true');
				}
				else
				{
					$('#add_brand_code').css('border-color','#D1D3E2');
					$('#add_code_msg').css('visibility','hidden');
					$('#add_brnd_btn').removeAttr('disabled');
				}
			}
		});
	}

	function validateCodeEdit(code)
	{
		var old_code = $('#get_code').val();
		$.ajax({
			type: "GET",
			url : "{{ route('validate.brand.code.edit') }}",
			cache: false,
			data: {code:code,old_code:old_code},
			success : function(data)
			{
				if (data.counter > 0)
				{
					$('#edit_brand_code').css('border-color','red');
					$('#edit_code_msg').css('visibility','visible');
					$('#edit_code_msg').text("*Brand Code Already Exist !");
					$('#edit_brnd_btn').attr('disabled','true');
				}
				else
				{
					$('#edit_brand_code').css('border-color','#D1D3E2');
					$('#edit_code_msg').css('visibility','hidden');
					$('#edit_brnd_btn').removeAttr('disabled');
				}
			}
		});
	}

	function editModal(btn)
	{
		var value = $(btn).attr('data-attr');
		$.ajax({
			type : "GET",
			url : "{{ route('edit.brand') }}",
			cache : false,
			data : {code:value},
			success : function(data)
			{
				$('#edit_brand_code').val(data.BRAND_CODE);
				$('#get_code').val(data.BRAND_CODE);
				$('#edit_brand_desc').val(data.BRAND_DESC);
			}
		});
		
		// $('#editModal').modal('toggle');
		// $('#editModal').modal('show');
	}

	function deleteModal(btn)
	{	
		var value = $(btn).attr('data-attr');
		$(".modal-body #code_display").html(value);
		$("#code").val(value);
		// $('#deleteModal').modal('toggle');
		// $('#deleteModal').modal('show');
	}
</script>