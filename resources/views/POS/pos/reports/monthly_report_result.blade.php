<?php use App\Http\Controllers\pos\SalesReportController;
use App\Helpers\Helper;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="{{URL::asset('/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::asset('/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">


</head>
<body style="background-color: grey;">

<style>

body {
    position: relative;
}
@page { size: auto;  margin: 0mm;margin-top: 5mm; }

@media print {
	html,body {
		height: 100%;
		width: 100%;
	}

	#page_footer {
		margin-bottom: -220px;
	}

	#div_control {
		display:none;
	}
}


</style>
@php



$count = SalesReportController::getMonthlyData($date_sort);

$page_count = 0; 

$page_number = $count / 50; // Divide the number of items to max limit per page

$page_number2 = number_format((float)$page_number, 0, '', ''); 

if( $page_number <= $page_number2 ) { $page_count = round($page_number); } else { $page_count = $page_number2+1; } //+1 if the number has decimal

$item_count = 40; 

$loop_count = 0;

$p_count = 0;

$total = 0; // Total Price

$skip = 0;

@endphp
<div id="div_control" align="center">
	<button id="btn-print" class="btn btn-primary" onclick="preview('print')" style="margin-top:20px;margin-bottom: 20px;"><i class="fa fa-print"></i> PRINT</button>
</div>
@for($i = 0 ;$i < $page_count ; $i++)


@php
	$p_count +=1;
	$items_counter = 0;
@endphp

		<div id="print" style="width: 800px;height: 1100px; margin: auto;background-color: #fff;margin-bottom: 50px;">
			
			<div class="container" style="width: 100%;">

				<div id="page_header" style="margin-top:10px;">
				<table style="width: 100%;" align="center">
					<tr>
						<td style="padding:0px;width: 90px;">

						</td>
						<td style="padding:0px;">
							<font style="left:-2px;font-weight: bold;font-style:arial;font-size: 18px;text-transform: uppercase;position: relative;"><u><i>{{ Helper::GetCompanyInfo()->COMPANY_NAME }}</i></u></font>
							
						</td>
					</tr>
					<tr >
						<td style="padding:0px;"></td>
						<td style="padding:0px;"><font style="font-style: arial;font-size: 11px;position: relative;top:0px;left: -2px;">Address:{{ Helper::GetCompanyInfo()->ADDRESS }}  Tel.No.{{ Helper::GetCompanyInfo()->PHONE_NO }} </font></td>
					</tr>
				</table>
				<br>
				<table align="center" style="width: 100%;border:1px solid black;font-size:13px;margin-top: -15px;" id="page_header2">
					<tr>
						<td style="text-align: right;width: 40px;"><font style="font-weight: bold;">Date:</font></td>
						<td style="border-right: 1px solid black;">&nbsp; {{ date('m-d-Y') }}</td>
						<td style="text-align: left;width: 90px;">&nbsp;<font style="font-weight: bold;">Report Type:</font></td>
						<td style="border-right: 1px solid black;">Daily Sales Report</td>
						<td style="text-align: right;width: 60px;"><font style="font-weight: bold;font-family: Courier new;">Page No.:</font></td>
						<td style="font-family: Courier new;">&nbsp; {{ $i + 1 }}</td>
					</tr>					
				</table>
				<p style="font-weight: bold;font-size: 13px;padding: 10px;;">Sales Report for the Month of {{ date('M-Y', strtotime($date_sort)) }}</p>
				</div>


			<table style="width: 770px" style="border-bottom: 1px solid black;">

				<thead>
				<tr style="border:1px solid black;">
					<th>INVOICE #</th>
					<th>TYPE</th>
					<th style="padding-left: 5px;">ITEM/SERVICE CODE</th>
					<th>ITEM/SERVICE NAME</th>
					<th>QUANTITY SOLD</th>
					<th>TOTAL</th>
				</tr>
				</thead>

				<tbody>
		
					@php
						$data_list = SalesReportController::retrieveMontlyData($date_sort, $skip, 50);
					@endphp}

					@foreach($data_list as $key => $value)


							@php
								$items_counter +=1;
							@endphp

							<tr style="font-size: 11px;font-family: calibri;font-weight: bold;">
								<td>{{ $value['INVOICE'] }}</td>
								<td>{{ $value['TYPE'] }}</td>
								<td>{{ $value['CODE'] }}</td>
								<td>{{ $value['DESC'] }}</td>
								<td>{{ $value['QUANTITY'] }}</td>
								<td style="text-align: right;">{{ Helper::numberFormat($value['TOTAL_PRICE']) }}</td>

								@php
									$total += $value['TOTAL_PRICE'];
								@endphp
							</tr>
							

					@endforeach

				@if ($items_counter >= 50)
					@php
						$skip +=50;
					@endphp
				@endif


				@if ($p_count == $page_count)


				<tr style="font-size: 12px;font-family: calibri;font-weight: bold;border: 1px solid black;background-color: yellow;">
					<td colspan="4"></td>
					<td>Total : </td>
					<td style="text-align: right;">{{ Helper::numberFormat($total) }}</td>
				<tr>


				<tr style="font-size: 12px;font-family: calibri;font-weight: bold;border: 1px solid black;background-color: yellow;">
					<td colspan="4"></td>
					<td>Total Discount: </td>
					<td style="text-align: right;">{{ Helper::numberFormat(SalesReportController::getTotalDiscountMonthly($date_sort)) }}</td>
				<tr>
					
				<tr style="font-size: 12px;font-family: calibri;font-weight: bold;border: 1px solid black;background-color: yellow;">
					<td colspan="4"></td>
					<td>Total Sales: </td>
					<td style="text-align: right;">{{ Helper::numberFormat($total - SalesReportController::getTotalDiscountMonthly($date_sort)) }}</td>
				<tr>

				@endif

				</tbody>
			</table>
			
			</div>
			
		</div>

@endfor


<div id="page_footer">
	<table  style="width:775px;margin-top:-180px;border:1px solid black;" align="center" >
		
		<tr>
			<td  style="padding-left: 5px;border-right: 1px solid black;width: 50%;">
				Prepared By:
				<br>
				<br>
				<b>{{ ucfirst(Auth::user()->name) }}</b>
				<br>	
				<em>(This is system generated - no signature required)</em>
			</td>
		</tr>
	</table>
</div>
<script>
	function preview(meh)
	{	
	    window.print();
	    document.body.innerHTML = restorePage;	
	    window.close();
	}
</script>

</body>
</html>