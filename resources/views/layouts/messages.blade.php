<br>
@if (Session::has('success'))
	<div class="alert alert-success alert-dismissable" style="padding: 8px 15px 8px 15px; font-size: 12px;">
        <i class="fa fa-check-circle"></i> <b>Success : </b> {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;">×</button>
    </div>
@endif

@if (Session::has('failed'))
	<div class="alert alert-danger alert-dismissable" style="padding: 8px 15px 8px 15px; font-size: 12px;">
        <i class="fa fa-exclamation-circle"></i> <b>Failed : </b> {{ Session::get('failed') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;">×</button>
    </div>
@endif