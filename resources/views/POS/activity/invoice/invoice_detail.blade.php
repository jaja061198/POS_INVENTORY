@extends('layouts.app')

@section('content')

@php 
	use App\Helpers\Helper;
@endphp
<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-cart-arrow-down"></i> Invoice</h5>
</div>

@include('layouts.messages')


<div class="row">

	<div class="panel panel-default col-lg-12">
		<div class="panel">

           <table class="table table-bordered">

             <tr>
               <td>
                 <i class="fa fa-pencil-square fa-fw"></i> <label style="font-weight: bold;">INVOICE DETAILS OF {{ $header['INVOICE_NO'] }}</label>
               </td>
             </tr>

          </table>
        </div>
	
		<div class="row">

	          <div class="col-lg-9">
	          	
	          	<table class="table table-bordered" id="tbl_receive">
					<tr style="text-align: center;text-transform: uppercase;font-weight: bold;font-size: 10px;">
						<td style="width: 200px;">Item Code</td>
						<td style="width: 200px;">Item Name</td>
						<td style="width: 80px;">Quantity</td>
						<td>Unit Cost</td>
						<td>Discount</td>
						<td>Total Cost</td>
					</tr>

					<tbody>
						@foreach($details as $key => $value)
							<tr>
								<td>{{ $value['ITEM_CODE'] }}</td>
								<td>{{ $value['ITEM_CODE'] }}</td>
								<td>{{ $value['QUANTITY'] }}</td>
								<td>{{ Helper::numberFormat($value['PRICE']) }}</td>
								<td>{{ Helper::numberFormat( $value['DISCOUNT']) }}</td>
								<td>{{ Helper::numberFormat($value['TOTAL_PRICE']) }}</td>
						@endforeach
					</tbody>

				</table>
				 	
	          </div>

	          <div class=" col-lg-3">
	          		<table class="table table-bordered" id="tbl_receive">
						<tr>
							<td>Customer</td>
							<td><input type="text" class="form-control" placeholder="Customer" name="customer" readonly value="{{ $header['CUSTOMER'] }}"></td>
						</tr>

						<tr>
							<td>Total</td>
							<td><input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="0.00" readonly value="{{ Helper::numberFormat($header['GRAND_TOTAL']) }}"></td>
						</tr>

						<tr>
							<td>Total Item Discount</td>
							<td><input type="text" class="form-control" id="total_discount"  name="total_discount" placeholder="0.00" readonly value="{{ Helper::numberFormat($header['DISCOUNT']) }}"></td>
						</tr>

						<tr>
							<td>Additional Discount</td>
							<td><input type="text" class="form-control" onchange="calculateAdditionalDiscount()" id="additional_discount" name="additional_discount" value="0.00" onclick="clickme(this)" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');" readonly value="{{ Helper::numberFormat($header['ADDITIONAL_DISC']) }}"></td>
						</tr>

						<tr>
							<td>Total Amount</td>
							<td><input type="text" id="total_amount2" name="total_amount2" class="form-control" placeholder="0.00" readonly value="{{ Helper::numberFormat($header['GRAND_TOTAL2']) }}"></td>
						</tr>

						<tr>
							<td>Pay Amount</td>
							<td><input type="text" class="form-control" id="pay_amount" name="pay_amount" onchange="calculateChange()" onclick="clickme(this)" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');" readonly value="{{ Helper::numberFormat($header['CASH_AMOUNT']) }}"></td>
						</tr>

						<tr>
							<td>Change</td>
							<td><input type="text" id="change" name="change" class="form-control" placeholder="0.00" readonly value="{{ Helper::numberFormat($header['CHANGE']) }}"></td>
						</tr>


						<tr>
							<td colspan="100%" align="right">

								<button type="submit" class="btn btn-success" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-print"></i> Print</button>
								
							</td>
						</tr>

					</table>
	          </div>

        </div>

	</div>

</div>
</div>

@endsection