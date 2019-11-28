@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-users"></i> Worst Selling Items Report</h5>
</div>

@include('main_layouts.messages')	

<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">
			{{ Form::open(array('route' => 'post.index.worst.selling', 'target' => '_blank')) }}
			<div class="form-group">
	            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> BRAND FILTER: </label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
	            <select class="form-control" id="user_level" name="brand" required>
	              <option value="" selected disabled>Select Brand</option>
	              <option value="_ALL">ALL</option>
	              @foreach ($brand as $element)
	              	<option value="{{ $element['BRAND_CODE'] }}">{{ $element['BRAND_DESC'] }}</option>
	              @endforeach
	            </select>

	            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> ITEM TYPE FILTER: </label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
	            <select class="form-control" id="user_level" name="type" required>
	              <option value="" selected disabled>Select Item Type</option>
	              <option value="_ALL">ALL</option>
	              @foreach ($type as $element)
	              	<option value="{{ $element['ITEM_TYPE_CODE'] }}">{{ $element['ITEM_TYPE_DESC'] }}</option>
	              @endforeach
	            </select>

		
	            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> For the month of: </label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
	            <input type="month" class="form-control" name="month_range" required>
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