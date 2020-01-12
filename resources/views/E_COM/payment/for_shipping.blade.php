@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Orders for shipping and receiving</h5>
</div>

@include('main_layouts.messages')  


<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">



      <table class="table table-bordered" id="userTable">
        <thead>
          <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
            <td>Order No</td>
            <td>Date Ordered</td>
            <td>Status</td>
            <td style="width: 120px;">Action</td>
          </tr>
        </thead>

        <tbody>
          
          @foreach ($items as $element)
           <tr>
             <td>{{ $element['order_no'] }}</td>
             <td >{{ $element['date_ordered'] }}</td>
             <td>@if($element['status'] == '6') FOR SHIPPING @endif @if($element['status'] == '5') FOR RECEIVING @endif</td>
             <td>
               <a  class="btn btn-primary btn-xs" href="{{ route('new.orders.review',['id' => str_replace("#","w",$element['order_no'])]) }}" style="color:white;" ><i class="fa fa-search" ></i></a>
             </td>
           </tr>
          @endforeach

          @if(empty($items))
          <tr>
            <td colspan="100%"><font style="color:red">No records</font></td>
          </tr>
          @endif
        </tbody>
      </table>
        

  </div>
</div>

<script>
$(document).ready( function () {
    $('#userTable').DataTable();
} );
</script>

@endsection
