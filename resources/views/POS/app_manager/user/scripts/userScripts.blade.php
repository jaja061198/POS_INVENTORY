<script>

	$('#close_add_modal').click(function(){
		$('#fullname').css('border-color','#D1D3E2')
		$('#username').css('border-color','#D1D3E2')
		$('#password').css('border-color','#D1D3E2')
		$('#user_level').css('border-color','#D1D3E2')
		$('#email').css('border-color','#D1D3E2')
		$('#fname_msg').css('visibility','hidden');
		$('#user_msg').css('visibility','hidden');
		$('#password_msg').css('visibility','hidden');
		$('#email_msg').css('visibility','hidden');
	});

	
	$('#add_user_btn').click(function(){
		
		var fullname = $('#fullname').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var userlevel = $('#user_level').val();
		var email = $('#email').val();

		if(validateDataAdd(fullname, username , password , userlevel , email) == false)
		{
			return false;
		}
		else
		{
			$('#add_user_form').submit();
		}
		// $('#add_user_form').submit();
		// 
		// $.ajax({
		// 	type: "GET".
		// 	url : "",
		// 	cache: false,
		// 	data : {},
		// 	success: function(data)
		// 	{

		// 	}
		// });
		
	});


	function validateEmail(email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  if (!emailReg.test(email)) 
	  {
	  	return false;
	  }
	  else
	  {
	  	return true;
	  }
	}


	function validateDataAdd(fname , username , password , userlevel , email)
	{
		var  counter = 0;


		if(email == '')
		{
			$('#email').css('border-color','red');
			$('#email_msg').css('visibility','visible');
			$('#email_msg').text("*This field is required !");
			counter +=1;
		}
		else
		{

			if (validateEmail(email) == false) 
			{
				$('#email').css('border-color','red');
				$('#email_msg').css('visibility','visible');
				$('#email_msg').text("*This is not a valid email !");
				counter += 1;
			}
			else
			{
				$.ajax({
					type: "GET",
					url : "{{ route('validate.new.email') }}",
					cache: false,
					data: {email:email},
					success : function(data)
					{

						if (data.counter === 0) 
						{
							$('#email').css('border-color','#D1D3E2');
							$('#email_msg').css('visibility','hidden');
						}
						else
						{	
							$('#email').css('border-color','red');
							$('#email_msg').css('visibility','visible');
							$('#email_msg').text("*Email Already Exist!");
							counter +=1;
						}

					}
				});

			}
		}

		if(username == '')
		{
			$('#username').css('border-color','red');
			$('#user_msg').css('visibility','visible');
			$('#user_msg').text("*This field is required !");
			counter +=1;
		}
		else
		{
			
			$.ajax({
				type: "GET",
				url : "{{ route('validate.new.username') }}",
				cache: false,
				data: {username:username},
				success : function(data)
				{

					if (data.counter === 0) 
					{
						$('#username').css('border-color','#D1D3E2');
						$('#user_msg').css('visibility','hidden');
					}
					else
					{	
						$('#username').css('border-color','red');
						$('#user_msg').css('visibility','visible');
						$('#user_msg').text("*Username Already Exist !");
						counter +=1;
					}

				}
			});

		}

		if(fname == '')
		{
			$('#fullname').css('border-color','red');
			$('#fname_msg').css('visibility','visible');
			$('#fname_msg').text("*This field is required !");
			counter +=1;
		}	
		else
		{
			$('#fullname').css('border-color','#D1D3E2');
			$('#fname_msg').css('visibility','hidden');
		}

		

		if(password == '')
		{
			$('#password').css('border-color','red');
			$('#password_msg').css('visibility','visible');
			$('#password_msg').text("*This field is required !");
			counter +=1;
		}
		else
		{
			$('#password').css('border-color','#D1D3E2');
			$('#password_msg').css('visibility','hidden');
		}

		

		if(userlevel == null)
		{
			$('#user_level').css('border-color','red');
			$('#userlvl_msg').css('visibility','visible');
			$('#userlvl_msg').text("*This field is required !");
			counter +=1;
		}
		else
		{
			$('#user_level').css('border-color','#D1D3E2');
			$('#userlvl_msg').css('visibility','hidden');
		}

		if (counter > 0) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function validateAddEmail(email)
	{
		
		$.ajax({
			type: "GET",
			url : "{{ route('validate.new.email') }}",
			cache: false,
			data: {email:email},
			success : function(data)
			{
				if(data.counter > 0	)
				{
					$('#is_existing').val(data.counter);
				}
				else
				{
					$('#is_existing').val(0);
				}

			}
		});
		
	}
</script>