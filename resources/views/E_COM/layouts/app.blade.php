
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Oculus Shop</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <link href="{{URL::asset('/ECOM/styles/bootstrap4/bootstrap.min.css')}}" rel="stylesheet">

    <!-- <link href="{{URL::asset('/ECOM/styles/cart.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/cart_responsive.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/categories.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/categories_responsive.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/checkout.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/checkout_responsive.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/contact.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/contact_responsive.css')}}" rel="stylesheet">

    

    <link href="{{URL::asset('/ECOM/styles/product.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/product_responsive.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/responsive.css')}}" rel="stylesheet"> -->

    <link href="{{URL::asset('/ECOM/plugins/OwlCarousel2-2.2.1/animate.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/main_styles.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/ECOM/styles/responsive.css')}}" rel="stylesheet">

</head>

<body id="page-top">

        <div class="super_container">
         

         @include('E_COM.layouts.navbar')


         @yield('content')

         @include('E_COM.layouts.footer')
            
         </div>

        
</body>

<script src="{{URL::asset('/ECOM/js/jquery-3.2.1.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/styles/bootstrap4/popper.js')}}"></script>

<script src="{{URL::asset('/ECOM/styles/bootstrap4/bootstrap.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/greensock/TweenMax.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/greensock/animation.gsap.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/greensock/ScrollToPlugin.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/OwlCarousel2-2.2.1//owl.carousel.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/Isotope/isotope.pkgd.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/easing/easing.js')}}"></script>

<script src="{{URL::asset('/ECOM/plugins/parallax-js-master/parallax.min.js')}}"></script>

<script src="{{URL::asset('/ECOM/js/custom.js')}}"></script>

</html>
