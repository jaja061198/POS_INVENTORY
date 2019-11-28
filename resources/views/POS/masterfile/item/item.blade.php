@php
  use App\Helpers\Helper;
@endphp
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Item</h5>
</div>

@include('main_layouts.messages')  
<div class="form-row">
  <div class="form-group col-lg-12" align="right">
    <button type="button" class="btn btn-success" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-plus"></i> Add Item</button>
  </div>
</div>
<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

    <div class="panel panel-default" style=" font-size: 12px;">

      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td>Item Code</td>
            <td>Item Description</td>
            <td>Standard Cost</td>
            <td>BRAND</td>
            <td>ITEM TYPE</td>
            <td>Quantity</td>
            <td style="width: 120px;">Action</td>
          </tr>
        </thead>

        <tbody>
          
        </tbody>

          @foreach ($datas as $element)
           <tr>
             <td>{{ $element['ITEM_CODE'] }}</td>
             <td >{{ $element['ITEM_DESC'] }}</td>
             <td >{{ Helper::numberFormat($element['STANDARD_COST']) }}</td>
             <td>{{ $element->getBrand['BRAND_DESC'] }}</td>
             <td>{{ $element->getType['ITEM_TYPE_DESC'] }}</td>
              <td>{{ $element['QUANTITY'] }}</td>
             <td>
               <a  class="btn btn-primary btn-xs" onclick="editModal(this)" data-attr="{{ $element['ITEM_CODE'] }}" style="color:white;"  data-target="#editModal" data-toggle="modal"><i class="fa fa-edit" ></i></a>
                <a class="btn btn-danger btn-xs" data-attr="{{ $element['ITEM_CODE'] }}" onclick="deleteModal(this)" data-target="#deleteModal" data-toggle="modal" style="color:white;"><i class="fa fa-trash"></i></a>
             </td>
           </tr>
          @endforeach
      </table>
        
    </div>

  </div>
</div>

@include('POS.masterfile.item.add_item_modal')
@include('POS.masterfile.item.edit_item_modal')
@include('POS.masterfile.item.delete_item_modal')
@include('POS.masterfile.item.scripts.item_scripts')

@endsection
