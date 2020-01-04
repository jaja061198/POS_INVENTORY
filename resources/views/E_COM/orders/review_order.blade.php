<?php
use App\Helpers\Helper;
?>
@extends('main_layouts.app')

@section('content')
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
  <h5 class="page-header" style="color:blue;"><i class="fa fa-cogs"></i> Order Review {{ $headers['order_no'] }}</h5>
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


            </table>


            <div class="row" style="margin-top: 10px;">
  
                <div class="col-lg-12">

                  <div class="panel panel-default" style=" font-size: 12px;">

                    <table class="table table-bordered" id="tbl_receive">
                      <tr>
                        <td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Transaction Details</i></td>
                      </tr>

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

                              <a href="" class="btn btn-success">Approve <i class="fa fa-check"></i></a>
                              {{-- <button type="submit" class="btn btn-success" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row">Approve <i class="fa fa-check"></i></button> --}}

                              <button type="submit" class="btn btn-danger" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row">Reject <i class="fa fa-times"></i></button>
                            </td>
                          </tr>

                    </table>
                      
                  </div>

                </div>
              </div>




       </div>

    </div>

  </div>
</div>

@endsection
