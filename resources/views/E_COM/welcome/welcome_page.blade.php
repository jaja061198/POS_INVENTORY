@php
  use App\Helpers\Helper;
@endphp
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Welcome Page Setup</h5>
</div>

@include('main_layouts.messages')  

@include('E_COM.welcome.welcome_page_style')
<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

      {{ Form::open(array('route' => 'update.welcome.ecom.index', 'files' => true)) }}
      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Welcome greeting</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <textarea name="welcome" id="" cols="5" rows="2" class="form-control" style="resize:none;" required>{{ $items['welcome_greet'] }}</textarea>
            <input type="hidden" name="get_id" value="{{ $items['id'] }}">
      </div>

      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Welcome Message</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <textarea name="welcome_msg" id="" cols="5" rows="4" class="form-control" style="resize:none;" required>{{ $items['welcome_msg'] }}</textarea>
      </div>
      
      <div class="form-group">
        <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Image on right:</label>  <small style="color:red;" id="user_msg"><i></i> (leave as empty if no changes)</small>
        <input type="file" class="form-control" id="add_item_image" name="add_item_image">
      </div>

      <div class="form-group">
        <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Image Preview:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
        <img id="blah" name="add_item_img" src="{{ URL::asset($items['img']) }}" alt="your image" style="height: 80px;width: 80px;background-color: grey;">
      </div>


      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="submit" id="add_item_btn" class="btn btn-primary btn-lg">Save</button>
      </div>     
      {{ Form::close() }}
  </div>
</div>


<script>
$("#add_item_image").change(function(){
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
