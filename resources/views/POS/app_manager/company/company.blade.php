
@extends('layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-cog"></i> Company</h5>
</div>

@include('layouts.messages')	
<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">

			{{ Form::open(array('route' => array('company.update'))) }}
			
			   <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputEmail4">Company Name</label>
			      <input type="text" class="form-control" placeholder="Company Name" required value="{{ $company['COMPANY_NAME'] }}" name="company" required>
			      <input type="hidden" name="get_id" value="{{ $company['id'] }}">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputPassword4">Address</label>
			      <input type="text" class="form-control" placeholder="Address" required value="{{ $company['ADDRESS'] }}" name="address" required>
			    </div>
			  </div>

			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputEmail4">Zip Code</label>
			      <input type="text" class="form-control" placeholder="Zip Code" value="{{ $company['ZIP_CODE'] }}" name="zip">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputPassword4">Tin No.</label>
			      <input type="text" class="form-control" placeholder="Tin No." value="{{ $company['TIN_NO'] }}" name="tin">
			    </div>
			  </div>

			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputCity">Phone No</label>
			      <input type="text" class="form-control" placeholder="Phone No." value="{{ $company['PHONE_NO'] }}" name="phone">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="inputCity">Fax</label>
			      <input type="text" class="form-control" placeholder="Fax" value="{{ $company['FAX'] }}" name="fax">
			    </div>
			    
			  </div>

			  <div class="form-row">

			  	<div class="form-group col-md-6">
			      <label for="inputCity">Website</label>
			      <input type="text" class="form-control" placeholder="Website" value="{{ $company['WEBSITE'] }}" name="website">
			    </div>

			  	<div class="form-group col-md-6">
			      <label for="inputZip">Logo</label>
			      <input type="file" class="form-control-file" name="logo">
			    </div>
			    
			  </div>

			  <div class="form-row">
			  	<div class="form-group col-lg-12" align="right">
			    	<input type="submit" class="btn btn-primary" value="Save" style="width: 140px;">
			    </div>
			  </div>

			{{ Form::close() }}
			 	
		</div>

	</div>
</div>
</div>
@endsection