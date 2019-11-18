@extends('layouts.app')

@section('content')

<div id="page-wrapper">
<div class="row" style="margin-top:-12px;">
	<h5 class="page-header" style="color:blue;"><i class="fa fa-users"></i> Sliders</h5>
</div>

@include('layouts.messages')	
<div class="form-row">

</div>
<div class="row" style="margin-top: 10px;">
	
	<div class="col-lg-12">

		<div class="panel panel-default" style=" font-size: 12px;">

			<table class="table table-bordered" id="userTable">

				<thead>
					<tr>
						<td>Slider id</td>
						<td>Slider Title</td>
						<td>Slider Description</td>
						<td>Action</td>
						{{-- <td>With Button</td>
						<td>Is Active</td>
						<td style="width: 230px;">Action</td> --}}
					</tr>
				</thead>

			</table>
			 	
		</div>

	</div>

 </div>

</div>


<script>
 $(function() {
       $('#userTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{ route('get.slider') }}',
       columns: [
                { data: 'SLIDER_ID', name: 'SLIDER_ID' },
                { data: 'SLIDER_TITLE', name: 'SLIDER_TITLE' },
                { data: 'SLIDER_DESC', name: 'SLIDER_DESC' },
                { data: 'action' , name : 'action' , orderable : false , searchable : false }
             ]
    });
 });
 </script>

@endsection