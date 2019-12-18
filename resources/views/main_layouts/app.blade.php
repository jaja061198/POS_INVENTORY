

<html>
<head>
<title>Oculus</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
<link href="{!! asset('css/main.css') !!}" rel="stylesheet">
<link href="{!! asset('css/sb-admin.css') !!}" rel="stylesheet">
<link href="{!! asset('css/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{!! asset('css/myStyle.css') !!}"/>
<script src="{{URL::asset('/vendor/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.min.css') }}">
</head>

<body>


<div id="wrapper" >

	@include('main_layouts.header')

	<div id="page-wrapper" style="background-color: transparent;">
		@yield('content')
	</div>
</div>

@include('main_layouts.footer')

</body>
</html>