@php
  use App\Helpers\Helper;
@endphp
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Footer Setup</h5>
</div>

@include('main_layouts.messages')  

<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

      {{ Form::open(array('route' => 'update.footer.index', 'files' => true)) }}
      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Contact Number</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" name="contact" placeholder="Contact #" value="{{ $items['contact'] }}">
            <input type="hidden" name="get_id" value="{{ $items['id'] }}">
      </div>


      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Facebook Link</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" name="facebook" placeholder="Facebook Link" value="{{ $items['facebook'] }}">
      </div>

      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Twitter Link</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" name="twitter" placeholder="Twitter Link" value="{{ $items['twitter'] }}">
      </div>

      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Instagram Link</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" name="instagram" placeholder="Instagram Link" value="{{ $items['instagram'] }}">
      </div>
  
      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Email</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $items['email'] }}">
      </div>

      <div>
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="submit" id="add_item_btn" class="btn btn-primary btn-lg">Save</button>
      </div>     
      {{ Form::close() }}
  </div>
</div>

@endsection
