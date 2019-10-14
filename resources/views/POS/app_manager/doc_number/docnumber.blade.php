@extends('layouts.app')

@section('content')


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

@endsection