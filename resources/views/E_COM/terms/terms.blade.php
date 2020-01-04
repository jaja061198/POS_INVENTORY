@php
  use App\Helpers\Helper;
@endphp
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Terms & Conditions Setup</h5>
</div>

@include('main_layouts.messages')  

@include('E_COM.welcome.welcome_page_style')
<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

      {{ Form::open(array('route' => 'update.terms.index', 'files' => true)) }}
      <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Title</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <textarea name="description" id="" cols="5" rows="2" class="form-control ckeditor" style="resize:none;" required>{{ $items['description'] }}</textarea>
            <input type="hidden" name="get_id" value="{{ $items['id'] }}">
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
