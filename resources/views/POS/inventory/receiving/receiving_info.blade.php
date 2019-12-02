@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-plane"></i> Receiving</h5>
</div>

@include('main_layouts.messages')


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
							<input type="text" class="form-control" name="rr_code" placeholder="Receiving Code" required readonly value="{{ $data['RR_CODE'] }}">
						</td>
						
						<td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;">*</font> Date Received</td>
						<td>
							<input type="date" class="form-control" name="rr_date" placeholder="Transaction Code" required readonly value="{{ $data['RR_DATE'] }}">
						</td>
					</tr>

					<tr>
						<td style="width: 170px;text-transform: uppercase;font-weight: bold;"><font style="color:red;">*</font> Remarks</td>
						<td colspan="100%">
							<textarea class="form-control" resize=none name="remarks" placeholder="Remarks" readonly value="{{ $data['REMARKS']}}"></textarea>
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
				</tr>

				<tbody>
					@foreach ($data->getDetails as $element)
						<tr>
							<td>
								{{ $element['ITEM_CODE'] }}
							</td>

							<td>
								{{ $element['ITEM_CODE'] }}
							</td>

							<td>
								{{ $element['QUANTITY'] }}
							</td>
						</tr>
					@endforeach
				</tbody>
				
			</table>
			 	
		</div>

	</div>
	
</div>

</div>

@endsection