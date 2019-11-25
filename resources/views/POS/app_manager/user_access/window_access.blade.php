@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-asterisk"></i> Window Access <small style="color:grey;">( {{ $user['name'] }} )</small></h5>
</div>

@include('main_layouts.messages')	

<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		{{ Form::open(array('route' => array('update.window.access'))) }}
		<div class="form-group">
			<table class="table table-bordered table-striped" style="">
				<tr>
					<td style="padding:0px;">
						<select id="TYPE_LIST" class="form-control" onchange="getParentList(this.value)">
							<option value="" disabled selected>Select Window</option>
							@if($user->user_level == 3 || $user->user_level == 0)
							<option value="A">Activity</option>
							@endif

							@if($user->user_level == 1 || $user->user_level == 0)
							<option value="R">Reports</option>
							@endif

							@if($user->user_level == 1 || $user->user_level == 0)
								<option value="TM">Table and Maintenance</option>
							@endif

							@if($user->user_level == 0 || $user->user_level == 1)
								<option value="AM">Application Manager</option>
							@endif

							@if($user->user_level == 0)
								<option value="SC">System Control</option>
							@endif

						</select>
						<input type="hidden" value="{{ $user['id'] }}" id="user_id" name="user_id">
					</td>

					<td style="padding:0px;">
						<button type="button" class="form-control btn btn-success" style="width: 40px;"><i class="fa fa-check"></i></button>
						<button type="button" class="form-control btn btn-danger" style="width: 40px;"><i class="fa fa-times"></i></button>
						<button type="submit" class="form-control btn btn-primary" style="width: 40px;"><i class="fa fa-save"></i></button>
						<a href="{{ route('index.users') }}" class="form-control btn btn-warning" style="width: 40px;"><i class="fa fa-history"></i></a>
					</td>
				</tr>
			</table>
		</div>

		<div class="panel panel-default" style=" font-size: 12px;">

			<table class="table table-bordered" id="userTable">
				<thead>
					<tr style="text-transform: uppercase;">
						<td>Parent Name</td>
						<td>VIEW</td>
						<td>ADD</td>
						<td>PRINT</td>
						<td>SPCL ACCESS</td>
					</tr>
				</thead>
			</table>
			 	
		</div>

		{{ Form::close() }}

	</div>
</div>
</div>

<script>
	function getParentList(WINDOW)
	{
		var window_code = WINDOW;
		var user = document.getElementById('user_id').value;

		$.ajax({
			type : "GET",
			url : "{{ route('get.window.parent') }}",
			data : {window_code:window_code,user_id:user},
			cache: false,
			success: function(data)
			{
				$('#userTable').empty();
				$('#userTable').html(data);
			}
		});
	}
</script>

@endsection