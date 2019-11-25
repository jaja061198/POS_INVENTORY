@extends('main_layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-download"></i> Receiving List</h5>
</div>

@include('main_layouts.messages')	

<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">

			<table class="table table-bordered" id="userTable">
				<thead>
					<tr style="text-align: center;font-weight: bold;">
						<td>RECEIVING CODE</td>
						<td>RECEIVING DATE</td>
						<td style="width: 40px;">Action</td>
					</tr>
				</thead>

				<tbody>
					@foreach($details as $key => $value)

						<tr>
							<td>{{ $value['RR_CODE'] }}</td>
							<td>{{ $value['RR_DATE'] }}</td>
							<td><a href="{{ url('inventory/receiving/show/'.$value['RR_CODE']) }}" style="font-size: 12px;" data-toggle="tooltip" data-placement="top" title="View" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			 	
		</div>

	</div>
</div>
</div>
@endsection