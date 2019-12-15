@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> New Orders</h5>
</div>

@include('main_layouts.messages')  


<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

    <div class="panel panel-default" style=" font-size: 12px;">

      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td>Order No</td>
            <td>Date Ordered</td>
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

          @foreach ($items as $element)
           <tr>
             <td>{{ $element['order_no'] }}</td>
             <td >{{ $element['date_ordered'] }}</td>
             <td>
               <a  class="btn btn-primary btn-xs" href="{{ route('new.orders.review',['id' => str_replace("#","w",$element['order_no'])]) }}" style="color:white;" ><i class="fa fa-search" ></i></a>
                {{-- <a class="btn btn-danger btn-xs" data-attr="{{ $element['ITEM_TYPE_CODE'] }}" onclick="deleteModal(this)" style="color:white;" data-target="#deleteModal" data-toggle="modal"><i class="fa fa-trash"></i></a> --}}
             </td>
           </tr>
          @endforeach
      </table>
        
    </div>

  </div>
</div>

@endsection
