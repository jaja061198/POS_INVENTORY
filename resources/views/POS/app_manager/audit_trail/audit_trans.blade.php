@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-history"></i> Audit Trail</h5>
</div>

@include('main_layouts.messages')	
      
<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		{{-- <div class="panel panel-default" style=" font-size: 12px;"> --}}
			{{ Form::open(array('route' => 'post.trail', 'target' => '_blank')) }}
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> USER FILTER: </label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
	            <select class="form-control" id="user_level" name="user" required>
	              <option value="_ALL" selected>Select All</option>
	              @foreach($users as $key => $value)
	              	<option value="{{ $value['id'] }}">{{ $value['username'] }} - {{ $value['name'] }}</option>
	              @endforeach
	            </select>	

	            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> ACTION TYPE FILTER: </label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
	            <select class="form-control" id="user_level" name="type" required>
	              <option value="_ALL" selected>Select All</option>
	              <option value="ADD">Insert</option>
	              <option value="ED">Update</option>
	              <option value="DEL">Delete</option>
	              <option value="REC">Receive</option>
	              <option value="INV">Invoice</option>
	              <option value="APRVOR">Approve Order</option>
	              <option value="CNCOR">Cancel Order</option>
	              <option value="APRVPY">Approve Payment</option>
	              <option value="REJPYM">Reject Payment</option>
	            </select>
				<br>
	            <button type="submit" id="add_user_btn" class="btn btn-primary">Retrieve</button>
	        </div>
			{{ Form::close() }}
		{{-- </div> --}}

	</div>
</div>
</div>

@endsection