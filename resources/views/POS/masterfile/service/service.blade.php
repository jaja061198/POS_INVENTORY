@php
  use App\Helpers\Helper;
@endphp
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Services</h5>
</div>

@include('main_layouts.messages')  
<div class="form-row">
  <div class="form-group col-lg-12" align="right">
    <button type="button" class="btn btn-success" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-plus"></i> Add Service</button>
  </div>
</div>
<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td>Service Code</td>
            <td>Service Description</td>
            <td>Standard Cost</td>
            <td style="width: 120px;">Action</td>
          </tr>
        </thead>

        <tbody>
          
        

          @foreach ($datas as $element)
           <tr>
             <td>{{ $element['SERVICE_CODE'] }}</td>
             <td >{{ $element['SERVICE_DESC'] }}</td>
             <td >{{ Helper::numberFormat($element['STANDARD_COST']) }}</td>

             <td>
               <a  class="btn btn-primary btn-xs" onclick="editModal(this)" data-attr="{{ $element['SERVICE_CODE'] }}" style="color:white;" data-target="#editModal" data-toggle="modal"><i class="fa fa-edit" ></i></a>
                <a class="btn btn-danger btn-xs" data-attr="{{ $element['SERVICE_CODE'] }}" onclick="deleteModal(this)" style="color:white;"  data-target="#deleteModal" data-toggle="modal"><i class="fa fa-trash"></i></a>
             </td>
           </tr>
          @endforeach
      </table>

    </tbody>
        

  </div>
</div>
@include('POS.masterfile.service.add_service_modal')
@include('POS.masterfile.service.edit_service_modal')
@include('POS.masterfile.service.delete_service_modal')
@include('POS.masterfile.service.scripts.service_scripts')

<script>
$(document).ready( function () {
    $('#userTable').DataTable();
} );
</script>

@endsection
