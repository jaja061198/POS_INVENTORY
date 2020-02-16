<?php
use App\Helpers\Helper;
?>
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Order Review {{ $headers['order_no'] }} <small style="text-transform: uppercase;">(
    @if($headers->status == 0)
        <a href="#" style="color:red;">PENDING</a>
    @endif

    @if($headers->status == 1)
        <a href="#" style="color:red;">Cancelled</a>
    @endif

    @if($headers->status == 2)
        <a href="#" style="color:red;">Waiting for Payment</a>
    @endif

    @if($headers->status == 3)
        <a href="#" style="color:red;">For Payment Review</a>
    @endif

    @if($headers->status == 4)
        <a href="#" style="color:red;">For Store Pick up</a>
    @endif

    @if($headers->status == 5)
        <a href="#" style="color:red;">To Receive</a>
    @endif

    @if($headers->status == 6)
        <a href="#" style="color:red;">To Ship</a>
    @endif

    @if($headers->status == 7)
        <a href="#" style="color:red;">Completed</a>
    @endif
  )</small>
  </h5>
</div>

@include('main_layouts.messages')  


<div class="row" style="margin-top: 10px;">
  
  <div class="col-lg-12">

    <div class="panel panel-default" style=" font-size: 12px;">

        <div class="panel-body">
            <table class="table table-bordered">
              <tr>
                <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Order Header</i></td>
              </tr>
              <tr >
                <td style="text-transform: uppercase;font-weight: bold;"><font style="color:red;"></font> Order No</td>
                <td>
                  <input type="text" class="form-control" name="order_no" placeholder="Order No" required readonly value="{{ $headers['order_no'] }}">
                </td>
                
                <td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;"></font> Date Ordered</td>
                <td>
                  <input type="date" class="form-control" name="rr_date" placeholder="Transaction Code" required value="{{ $headers['date_ordered'] }}" readonly>
                </td>
              </tr>

              <tr>
                <td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;"></font> Name of customer</td>
                <td colspan="100%">
                  <input type="text" class="form-control" name="cust" placeholder="Customer" required value="{{ Helper::getUserInfo($headers['user'])->name }}" readonly=>
                </td>
              </tr>


              @if($headers['type'] == 1)

                 <tr >
                  <td style="text-transform: uppercase;font-weight: bold;"><font style="color:red;"></font> Area</td>
                  <td>
                    <input type="text" class="form-control" name="order_no" placeholder="Area" required readonly value="{{ Helper::getShippingInfo($code = null)->area }}">
                  </td>
                  
                  <td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;"></font> Zip</td>
                  <td>
                    <input type="text" class="form-control" name="rr_date" placeholder="Zip Code" required value="{{ $headers['zip'] }}" readonly>
                  </td>
                </tr>


                <tr>
                  <td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;"></font> Address</td>
                  <td colspan="100%">
                    <input type="text" class="form-control" name="cust" placeholder="Address" required value="{{ $headers['address'] }}" readonly=>
                  </td>
                </tr>

              @endif

            </table>


            <div class="row" style="margin-top: 10px;">
  
                <div class="col-lg-12">

                  <div class="panel panel-default" style=" font-size: 12px;">

                    <table class="table table-bordered" id="tbl_receive">
                      

                      <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
                        <td style="width: 390px;">Item Code</td>
                        <td>Item Name</td>
                        <td style="width: 200px;">Quantity Ordered</td>
                        <td>Ordered Price(per pcs)</td>
                        {{-- <td style="width: 40px;">Action</td> --}}
                      </tr>

                      <tbody>
                          @foreach($details as $key => $value)

                            <tr>
                              <td>{{ $value['item_code'] }}</td>

                              <td>{{ Helper::getIteminfo($value['item_code'])->ITEM_DESC }}</td>

                              <td>{{ $value['quantity'] }}</td>

                              <td>{{ Helper::numberFormat($value['item_price']) }}</td>
                            </tr>

                          @endforeach
                      </tbody>




                        <tr>
                            <td colspan="100%" align="right">

                              @if($headers['status'] == '0')
                              <a onclick="approveOrder()" href="{{ route('approve.reject.order',['id' => str_replace("#","w",$headers['order_no']),'action' => 'approve']) }}" class="btn btn-success">Approve <i class="fa fa-check"></i></a>
                              @endif

                              @if($headers['status'] == '0' || $headers['status'] == '2')
                              {{-- <button type="submit" class="btn btn-success" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row">Approve <i class="fa fa-check"></i></button> --}}
                              <a onclick="cancelOrder()" href="{{ route('approve.reject.order',['id' => str_replace("#","w",$headers['order_no']),'action' => 'reject']) }}" class="btn btn-danger">Cancel Order <i class="fa fa-times"></i></a>
                              @endif
                            </td>
                          </tr>

                    </table>
                      
                  </div>

                </div>


                <div class="col-lg-12">
                    <table class="table table-bordered" >
                      <tr>
                        <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Order Logs</i></td>
                      </tr>
                        
                        <tr style="font-weight: bold;text-transform: uppercase;">
                          <td>Action</td>
                          <td>Date Performed</td>
                        </tr>
                        
                        <tbody>
                          
                          @foreach($logs as $key => $value)
                            <tr>
                                <td>{{ $value['action'] }}</td>

                                <td>{{ $value['date_performed'] }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>

                @if($headers['status'] == '3' || $headers['status'] == '6')
                <div class="col-lg-12">
                    <table class="table table-bordered" >
                      <tr>
                        <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Payment Information</i></td>
                      </tr>
                        
                        <tr style="font-weight: bold;text-transform: uppercase;">
                          <td>Details</td>
                          <td>Action</td>
                        </tr>
                        
                        <tbody>
                            <tr>
                              <td>
                                {{ $headers['image'] }}
                              </td>

                              <td style="width: 30%">
                                <a target="_blank" href="{{ route('payment.download',['id' => str_replace("#","w",$headers['order_no'])]) }}" class="btn btn-primary">Review <i class="fa fa-search"></i></a>

                                @if($headers['status'] == '3')

                                <a onclick="approvePayment()" href="{{ route('approve.reject.payment',['id' => str_replace("#","w",$headers['order_no']),'action' => 'approve']) }}" class="btn btn-success">Approve & Invoice <i class="fa fa-check"></i></a>

                                <a onclick="cancelPayment()" href="{{ route('approve.reject.payment',['id' => str_replace("#","w",$headers['order_no']),'action' => 'reject']) }}" class="btn btn-danger">Reject <i class="fa fa-times"></i></a>

                                @endif
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif


                @if( $headers['status'] == '6')
                <div class="col-lg-12">
                    <table class="table table-bordered" >
                      <tr>
                        <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Mark as for receiving</i></td>
                      </tr>
                        
                        <tr style="font-weight: bold;text-transform: uppercase;">
                          <td></td>
                          <td>Action</td>
                        </tr>
                        
                        <tbody>
                            <tr>
                              <td>
                                Mark as for receiving.
                              </td>

                              <td style="width: 30%">
                                <a href="{{ route('change.status.order',['id' => str_replace("#","w",$headers['order_no']), 'action' => '5']) }}" class="btn btn-warning" onclick="approveShip()">Mark as for receiving <i class="fa fa-truck"></i></a>

                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                 @if( $headers['status'] == '5')
                <div class="col-lg-12">
                    <table class="table table-bordered" >
                      <tr>
                        <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Mark as Complete</i></td>
                      </tr>
                        
                        <tr style="font-weight: bold;text-transform: uppercase;">
                          <td></td>
                          <td>Action</td>
                        </tr>
                        
                        <tbody>
                            <tr>
                              <td>
                                Mark as Complete.
                              </td>

                              <td style="width: 30%">
                                <a href="{{ route('change.status.order',['id' => str_replace("#","w",$headers['order_no']), 'action' => '7']) }}" class="btn btn-warning" onclick="approveShip()">Mark as Complete <i class="fa fa-truck"></i></a>

                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif


                @if( $headers['status'] == '4')
                <div class="col-lg-12">
                    <table class="table table-bordered" >
                      <tr>
                        <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Mark as Picked up</i></td>
                      </tr>
                        
                        <tr style="font-weight: bold;text-transform: uppercase;">
                          <td></td>
                          <td>Action</td>
                        </tr>
                        
                        <tbody>
                            <tr>
                              <td>
                                Mark as shipped.
                              </td>

                              <td style="width: 30%">
                                <a href="{{ route('change.status.order',['id' => str_replace("#","w",$headers['order_no']), 'action' => '7']) }}" class="btn btn-warning" onclick="approveShip()">Mark as Picked Up and complete <i class="fa fa-truck"></i></a>

                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif


              </div>
              




       </div>

    </div>

  </div>
</div>


<script>

function approveOrder() {

  var r = confirm("Are you sure you want to approve this order?");
  if (r == true) {

  } else {
    event.preventDefault();
  }
}

function cancelOrder() {
  var txt;
  var r = confirm("Are you sure you want to reject this order?");
  if (r == true) {
    txt = "You pressed OK!";
  } else {
    event.preventDefault();
  }
}

function approvePayment() {

  var r = confirm("Are you sure you want to approve this payment?");
  if (r == true) {

  } else {
    event.preventDefault();
  }
}

function cancelPayment() {
  var txt;
  var r = confirm("Are you sure you want to reject this payment?");
  if (r == true) {
    txt = "You pressed OK!";
  } else {
    event.preventDefault();
  }
}

function approveShip() {

  var r = confirm("Are you sure you want to mark this as for receiving?");
  if (r == true) {

  } else {
    event.preventDefault();
  }
}

</script>

@endsection
