<?php use App\Http\Traits\pos\InvoiceReportTraits;
use App\Helpers\Helper;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="{{URL::asset('/css/bootstrap.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::asset('/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">


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

$data_count = InvoiceReportTraits::countData($brand,$type);

$count = 1; // Counts the number of items

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
						<td style="border-right: 1px solid black;">Top Selling Items Report</td>
						<td style="text-align: right;width: 60px;"><font style="font-weight: bold;font-family: Courier new;">Page No.:</font></td>
						<td style="font-family: Courier new;">&nbsp; {{ $i + 1 }}</td>
					</tr>					
				</table>
				<p style="font-weight: bold;font-size: 13px;padding: 10px;;">Top Selling Items for the month of {{ date('M-Y', strtotime($date_sort)) }}</p>
				</div>


			<table style="width: 770px" style="border-bottom: 1px solid black;">

				<thead>
				<tr style="border:1px solid black;">
					<th style="padding-left: 5px;">ITEM CODE</th>
					<th>ITEM NAME</th>
					<th>BRAND</th>
					<th>ITEM TYPE</th>
					<th>QUANTITY SOLD</th>
				</tr>
				</thead>

				<tbody>
				@php
					$data_list = InvoiceReportTraits::getData($brand, $type , $skip, 50,$date_sort);
				@endphp


					@foreach(InvoiceReportTraits::top_selling($data_list,'COUNT') as $key => $value)
					

					@php
						$items_counter +=1;
					@endphp

					<tr style="font-size: 11px;font-family: calibri;font-weight: bold;">
						<td>{{ $value['ITEM_CODE'] }}</td>
						<td>{{ $value['ITEM_DESC'] }}</td>
						<td>{{ $value['ITEM_BRAND'] }}</td>
						<td>{{ $value['ITEM_TYPE'] }}</td>
						<td>{{ $value['COUNT'] }}</td>
					</tr>

					@endforeach
					

					@if ($items_counter >= 50)
						@php
							$skip +=50;
						@endphp
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