@extends('E_COM.layouts.app')

@section('content')



<div class="home">
	<div class="home_slider_container">
		
		<!-- Home Slider -->
		<div class="owl-carousel owl-theme home_slider">
			
			<!-- Slider Item -->
			<div class="owl-item home_slider_item">
				<div class="home_slider_background" style="background-image:url(/ECOM/images/home_slider_1.jpg)"></div>
				<div class="home_slider_content_container">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
									<div class="home_slider_title">A new Online Shop experience.</div>
									<div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</div>
									<div class="button button_light home_button"><a href="#">Shop Now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="owl-item home_slider_item">
				<div class="home_slider_background" style="background-image:url(/ECOM/images/home_slider_1.jpg)"></div>
				<div class="home_slider_content_container">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
									<div class="home_slider_title">A new Online Shop experience.</div>
									<div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</div>
									<div class="button button_light home_button"><a href="#">Shop Now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="owl-item home_slider_item">
				<div class="home_slider_background" style="background-image:url(/ECOM/images/home_slider_1.jpg)"></div>
				<div class="home_slider_content_container">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
									<div class="home_slider_title">A new Online Shop experience.</div>
									<div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</div>
									<div class="button button_light home_button"><a href="#">Shop Now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Home Slider Dots -->
		
		<div class="home_slider_dots_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_slider_dots">
							<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
								<li class="home_slider_custom_dot active">01•</li>

								<li class="home_slider_custom_dot">02•</li>

								<li class="home_slider_custom_dot">03•</li>
							</ul>
						</div>
					</div>
				</div>
			</div>	
		</div>

	</div>

</div>


<!-- Ads -->

	<div class="avds">
		<div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
			<div class="avds_small">
				<div class="avds_background" style="background-image:url(/ECOM/images/avds_small.jpg)"></div>
				<div class="avds_small_inner">
					<div class="avds_discount_container">
						<img src="/ECOM/images/discount.png" alt="">
						<div>
							<div class="avds_discount">
								<div>20<span>%</span></div>
								<div>Discount</div>
							</div>
						</div>
					</div>
					<div class="avds_small_content">
						<div class="avds_title">Smart Phones</div>
						<div class="avds_link"><a href="categories.html">See More</a></div>
					</div>
				</div>
			</div>
			<div class="avds_large">
				<div class="avds_background" style="background-image:url(/ECOM/images/avds_large.jpg)"></div>
				<div class="avds_large_container">
					<div class="avds_large_content">
						<div class="avds_title">Professional Cameras</div>
						<div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viver ra velit venenatis fermentum luctus.</div>
						<div class="avds_link avds_link_large"><a href="categories.html">See More</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

@include('E_COM.pages.products')

@endsection