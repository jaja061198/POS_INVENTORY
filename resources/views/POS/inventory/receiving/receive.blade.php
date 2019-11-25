@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-plane"></i> Receiving</h5>
</div>

@include('main_layouts.messages')

{{ Form::open(array('route' => 'post.receive')) }}

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">

			<div class="panel-body">
				<table class="table table-bordered">
					<tr>
						<td colspan="100%" style="font-size:11px;" align="right"><i style="font-weight: bold;">Transaction Header</i></td>
					</tr>
					<tr >
						<td style="text-transform: uppercase;font-weight: bold;"><font style="color:red;">*</font> Receiving Code</td>
						<td>
							<input type="text" class="form-control" name="rr_code" placeholder="Receiving Code" required readonly value="{{ $RR_CODE }}">
						</td>
						
						<td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;">*</font> Date Received</td>
						<td>
							<input type="date" class="form-control" name="rr_date" placeholder="Transaction Code" required>
						</td>
					</tr>

					<tr>
						<td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;">*</font> Remarks</td>
						<td colspan="100%">
							<textarea class="form-control" resize=none name="remarks" placeholder="Remarks"></textarea>
						</td>
					</tr>
				</table>
			</div>
			
		</div>
	</div>
</div>

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
					<td style="width: 150px;">Quantity</td>
					<td style="width: 40px;">Action</td>
				</tr>

				<tbody>
					
				</tbody>
				<tr>
					<td colspan="100%" align="right">
						<button type="button" class="btn btn-primary" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-plus"></i></button>

						<button type="submit" class="btn btn-success" id="addRow" data-toggle="tooltip" data-placement="top" title="Add Row"><i class="fa fa-save"></i></button>
					</td>
				</tr>
			</table>
			 	
		</div>

	</div>
</div>

{{ Form::close() }}
</div>
@include('POS.inventory.receiving.scripts.receiving_scripts')
@include('POS.inventory.receiving.receiving_modal')

@endsection