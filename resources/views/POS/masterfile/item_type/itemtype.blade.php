@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Item Type</h5>
</div>

@include('main_layouts.messages')  
<div class="form-row">
  <div class="form-group col-lg-12" align="right">
    <button type="button" class="btn btn-success" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-plus"></i> Add Item Type</button>
  </div>
</div>
<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

    <div class="panel panel-default" style=" font-size: 12px;">

      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td>Item Type Code</td>
            <td>Item Type Description</td>
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

          @foreach ($datas as $element)
           <tr>
             <td>{{ $element['ITEM_TYPE_CODE'] }}</td>
             <td >{{ $element['ITEM_TYPE_DESC'] }}</td>
             <td>
               <a  class="btn btn-primary btn-xs" onclick="editModal(this)" data-attr="{{ $element['ITEM_TYPE_CODE'] }}" style="color:white;" data-target="#editModal" data-toggle="modal"><i class="fa fa-edit" ></i></a>
                <a class="btn btn-danger btn-xs" data-attr="{{ $element['ITEM_TYPE_CODE'] }}" onclick="deleteModal(this)" style="color:white;" data-target="#deleteModal" data-toggle="modal"><i class="fa fa-trash"></i></a>
             </td>
           </tr>
          @endforeach
      </table>
        
    </div>

  </div>
</div>
@include('POS.masterfile.item_type.add_itemtype_modal')
@include('POS.masterfile.item_type.edit_itemtype_modal')
@include('POS.masterfile.item_type.delete_itemtype_modal')
@include('POS.masterfile.item_type.scripts.itemtype_scripts')

@endsection
