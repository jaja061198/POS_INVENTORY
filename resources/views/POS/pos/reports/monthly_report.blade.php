@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-users"></i> Monthly Sales Report</h5>
</div>

@include('main_layouts.messages')	

<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">
			{{ Form::open(array('route' => 'post.monthly.sales', 'target' => '_blank')) }}
			<div class="form-group">

		
	           	<label for="recipient-name" class="col-form-label"><i style="color:red;"></i> For the Month of: </label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
	            <input type="month" class="form-control" name="date_sort" required>
				<input type="hidden" value="TOP" name="sort">
				<br>
	            <button type="submit" id="add_user_btn" class="btn btn-primary">Generate</button>
	        </div>
			{{ Form::close() }}
		</div>

	</div>
</div>
</div>
@endsection