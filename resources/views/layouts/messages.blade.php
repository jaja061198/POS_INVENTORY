<br>
@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>Success!</strong> {{ Session::get('success') }}.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif

@if (Session::has('failed'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>Failed!</strong> {{ Session::get('failed') }}.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif