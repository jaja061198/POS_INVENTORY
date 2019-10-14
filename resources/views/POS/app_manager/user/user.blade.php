@extends('layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-users"></i> Users</h5>
</div>

@include('layouts.messages')	
<div class="form-row">
	<div class="form-group col-lg-12" align="right">
		<button type="button" class="btn btn-success" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-plus"></i> Add User</button>
	</div>
</div>
<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">

			<table class="table table-bordered" id="userTable">
				<thead>
					<tr>
						<td>Username</td>
						<td>Name</td>
						<td>Level</td>
						<td style="width: 230px;">Action</td>
					</tr>
				</thead>
			</table>
			 	
		</div>

	</div>
</div>
</div>
@include('POS.app_manager.user.addUserModal')
@include('POS.app_manager.user.editUserModal')
@include('POS.app_manager.user.scripts.userScripts')

<script>

function editUser(btn)
{
 var fullname = $(btn).attr('data-attr1');
 var username = $(btn).attr('data-attr2');
 var password = $(btn).attr('data-attr3');
 var email = $(btn).attr('data-attr4');
 var level = $(btn).attr('data-attr5');
 $("#edit_fullname").val(fullname);
 $("#edit_username").val(username);
 $("#edit_password").val(password);
 $("#edit_email").val(email);
 $("#edit_user_level").val(level);
}
$(document).ready( function () {
	$('#userTable').DataTable({
		processing: true,
		serverside: true,
		language: {
			processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
		},

		ajax : {
			"url" : "{{ route('serverside.users') }}",
			"dataType" : "json",
			"type" : "post",
			"data" : {"_token":"<?= csrf_token() ?>"}
		},

		columns : [
			{"data":'username'},
	        {"data":'name'},
	        {"data":'level'},
	        {"data":'action',
	         "orderable" : false,
	        },
		]
	});
});
</script>
@endsection