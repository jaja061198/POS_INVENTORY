@extends('layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Brand</h5>
</div>

@include('layouts.messages')  
<div class="form-row">
  <div class="form-group col-lg-12" align="right">
    <button type="button" class="btn btn-success" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-plus"></i> Add Brand</button>
  </div>
</div>
<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

    <div class="panel panel-default" style=" font-size: 12px;">

      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td>Brand Code</td>
            <td>Brand Description</td>
            <td style="width: 120px;">Action</td>
          </tr>
        </thead>

        <tbody>
          
        </tbody>
        {{-- <tr>
            <td colspan=""></td>
            <td colspan="2" align="right">
              <button type="button" class="btn btn-primary" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-plus"></i></button>
              <button type="submit" class="btn btn-success"  data-toggle="tooltip" data-placement="top" title="Save"><i class="fa fa-save"></i></button>
            </td>
          </tr> --}}

          @foreach ($brand as $element)
           <tr>
             <td>{{ $element['BRAND_CODE'] }}</td>
             <td >{{ $element['BRAND_DESC'] }}</td>
             <td>
               <a  class="btn btn-primary btn-xs" onclick="editModal(this)" data-attr="{{ $element['BRAND_CODE'] }}" style="color:white;"><i class="fa fa-edit" ></i></a>
                <a class="btn btn-danger btn-xs" data-attr="{{ $element['BRAND_CODE'] }}" onclick="deleteModal(this)" style="color:white;"><i class="fa fa-trash"></i></a>
             </td>
           </tr>
          @endforeach
      </table>
        
    </div>

  </div>
  </div>
@include('POS.masterfile.brand.add_brand_modal')
@include('POS.masterfile.brand.edit_brand_modal')
@include('POS.masterfile.brand.delete_brand_modal')
@include('POS.masterfile.brand.scripts.brand_scripts')

@endsection
