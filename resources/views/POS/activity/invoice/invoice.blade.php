@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-cart-arrow-down"></i> Invoice</h5>
</div>

@include('main_layouts.messages')


<div class="row">

	<div class="panel panel-default col-lg-12">
		<div class="panel">

           <table class="table table-bordered">

             <tr>
               <td>
                 <i class="fa fa-pencil-square fa-fw"></i> INVOICE FORM
               </td>
             </tr>

          </table>
        </div>
	
		{{ Form::open(array('route' => 'invoice.store', 'id' => 'invoice_form')) }}
		<div class="row">

	          <div class="col-lg-9">

	          	<h6 style="font-weight: bold;">Items</h6>
	          	
	          	<table class="table table-bordered" id="tbl_receive">
					<tr style="text-align: center;text-transform: uppercase;font-weight: bold;font-size: 10px;">
						<td style="width: 200px;">Item Code</td>
						<td style="width: 200px;">Item Name</td>
						<td style="width: 80px;">Quantity</td>
						<td>Unit Cost</td>
						<td>Discount</td>
						<td>Total Cost</td>
						<td style="width: 40px;">Action</td>
					</tr>

					<tbody>
						
					</tbody>
					<tr>
						<td colspan="100%" align="right">
							<button type="button" class="btn btn-primary" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-plus"></i></button>
						</td>
					</tr>
				</table>


				<h6 style="font-weight: bold;">Services</h6>


				<table class="table table-bordered" id="tbl_receive">
					<tr style="text-align: center;text-transform: uppercase;font-weight: bold;font-size: 10px;">
						<td style="width: 200px;">Service Code</td>
						<td style="width: 200px;">Service Name</td>
						<td>Service Cost</td>
						<td>Total Cost</td>
						<td style="width: 40px;">Action</td>
					</tr>

					<tbody>
						
					</tbody>
					<tr>
						<td colspan="100%" align="right">
							<button type="button" class="btn btn-primary" id="addRow2" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-plus"></i></button>
						</td>
					</tr>
				</table>
				 	
	          </div>

	          <div class=" col-lg-3">
	          		<table class="table table-bordered" id="tbl_receive">
						<tr>
							<td>Customer</td>
							<td><input type="text" class="form-control" placeholder="Customer" name="customer" required></td>
						</tr>

						<tr>
							<td>Total</td>
							<td><input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="0.00" readonly required></td>
						</tr>

						<tr>
							<td>Total Item Discount</td>
							<td><input type="text" class="form-control" id="total_discount"  name="total_discount" placeholder="0.00" readonly></td>
						</tr>

						<tr>
							<td>Additional Discount</td>
							<td><input type="text" class="form-control" onchange="calculateAdditionalDiscount()" id="additional_discount" name="additional_discount" value="0.00" onclick="clickme(this)" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');"></td>
						</tr>

						<tr>
							<td>Total Amount</td>
							<td><input type="text" id="total_amount2" name="total_amount2" class="form-control" placeholder="0.00" readonly></td>
						</tr>

						<tr>
							<td>Service Amount</td>
							<td><input type="text" id="service_amount" name="service_amount" class="form-control" placeholder="0.00" readonly></td>
						</tr>

						<tr>
							<td>Pay Amount</td>
							<td><input type="text" class="form-control" id="pay_amount" name="pay_amount" onchange="calculateChange()" value="0.00" onclick="clickme(this)" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');" required></td>
						</tr>

						<tr>
							<td>Change</td>
							<td><input type="text" id="change" name="change" class="form-control" placeholder="0.00" readonly></td>
						</tr>


						<tr>
							<td colspan="100%" align="right">

								<a class="btn btn-danger" id="clear" data-toggle="tooltip" data-placement="top" title="Clear" href="{{ route('invoice.index') }}"><i class="fa fa-trash"></i></a>

								<button type="submit" class="btn btn-success" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-save"></i></button>
								
							</td>
						</tr>

					</table>
	          </div>

        </div>
		{{ Form::close() }}
	</div>

</div>
</div>
@include('POS.activity.invoice.invoice_modal')
@include('POS.activity.invoice.invoice_scripts')

@endsection