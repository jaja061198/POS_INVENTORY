@extends('main_layouts.app')

@section('content')

@php
	$user_count = DB::table('users')->count();
  use App\Helpers\Helper;
@endphp
<div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class='fa fa-bar-chart'></span>
                    <span>Dashboard</span>
                </h1>
            </div>

			
        </div>
      </div>
{{-- <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  height: 20%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
.card-green{
	background-color: #42f595;
}

.card-blue{
	background-color: #42ecf5;
}

.card-yellow{
	background-color: #f5ec42;
}

.card-red{
	background-color: #f54542;
}
</style>


<div class="row">
	
	<div class="col-lg-12">
			<div class="card card-green col-md-4" style="margin-left: 10px;">
			  <div class="container">
			    <div><b>Sales for the month:</b></div>
			    <p>PHP {{ Helper::numberFormat(Helper::getMonthlySales()) }}</p> 
			  </div>
			</div>

			<div class="card card-blue col-md-4" style="margin-left: 10px;">
			  <div class="container">
			    <div><b>Sales for today</b></div>	
			    <p>PHP {{ Helper::numberFormat(Helper::getTodaySales()) }}</p> 
			  </div>
			</div>

			<div class="card card-yellow col-md-4" style="margin-left: 10px;">
			  <div class="container">
			   <div><b>Items below minimum level</b></div>
			    <p>{{ Helper::getMinimumItems() }}</p> 
			  </div>
			</div>

	</div>

</div> --}}


    <style>
      body {
        margin: 0;
        padding: 0;
        color: #fff;
        font-family: 'Open Sans', Helvetica, sans-serif;
        box-sizing: border-box;
      }

      /* Assign grid instructions to our parent grid container, mobile-first (hide the sidenav) */
      .grid-container {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 50px 1fr 50px;
        grid-template-areas:
          'header'
          'main'
          'footer';
        height: 100vh;
      }

      /* Give every child element its grid name */
      .header {
        grid-area: header;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        background-color: #648ca6;
      }

      .sidenav {
        display: none; /* Mobile-first */
        grid-area: sidenav;
        background-color: #394263;
      }

      .sidenav__list {
        padding: 0;
        margin-top: 85px;
        list-style-type: none;
      }

      .sidenav__list-item {
        padding: 20px 20px 20px 40px;
        color: #ddd;
      }

      .sidenav__list-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
        cursor: pointer;
      }

      .main {
        grid-area: main;
        background-color: #8fd4d9;
      }

      .main-header {
        display: flex;
        justify-content: space-between;
        margin: 20px;
        padding: 20px;
        height: 150px;
        background-color: #e3e4e6;
        color: slategray;
      }

      .main-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
        grid-auto-rows: 94px;
        grid-gap: 30px;
        margin: 20px;
      }

      .overviewcard {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background-color: #d3d3;
      }

      .main-cards {
        column-count: 1;
        column-gap: 20px;
        margin: 20px;
      }

      .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        background-color: #82bef6;
        margin-bottom: 20px;
        -webkit-column-break-inside: avoid;
        padding: 24px;
        box-sizing: border-box;
      }

      /* Force varying heights to simulate dynamic content */
      .card:first-child {
        height: 485px;
      }

      .card:nth-child(2) {
        height: 200px;
      }

      .card:nth-child(3) {
        height: 265px;
      }

      .footer {
        grid-area: footer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        background-color: #648ca6;
      }

      /* Non-mobile styles, 750px breakpoint */
      @media only screen and (min-width: 46.875em) {
        /* Show the sidenav */
        .grid-container {
          grid-template-columns: 240px 1fr;
          grid-template-areas:
            "sidenav header"
            "sidenav main"
            "sidenav footer";
        }

        .sidenav {
          display: flex;
          flex-direction: column;
        }
      }

      /* Medium screens breakpoint (1050px) */
      @media only screen and (min-width: 65.625em) {
        /* Break out main cards into two columns */
        .main-cards {
          column-count: 2;
        }
      }

      .overview-bg-blue{
      	background-color: #03c2fc;
      }

      .overview-bg-green{
      	background-color: #0ca64c;
      }

      .overview-bg-yellow{
      	background-color: #868c08;
      }

      .overview-bg-red{
      	background-color: #750208;
      }
    </style>

        <div class="main-overview">
          <div class="overviewcard overview-bg-blue" >
            <div class="overviewcard__icon"> <i class="fa fa-money"></i> Sales for this month</div>
            <div class="overviewcard__info">PHP {{ Helper::numberFormat(Helper::getMonthlySales()) }}</div>
          </div>


          <div class="overviewcard overview-bg-green">
            <div class="overviewcard__icon"> <i class="fa fa-money"></i>  Sales for this day</div>
            <div class="overviewcard__info">PHP {{ Helper::numberFormat(Helper::getTodaySales()) }}</div>
          </div>

           <div class="overviewcard overview-bg-yellow">
            <div class="overviewcard__icon"> <i class="fa fa-cog"></i>  Items below minimum level</div>
            <div class="overviewcard__info"> {{ Helper::getMinimumItems() }} <button type="button" class="btn btn-danger" onclick="showModal()" style="border-radius: 40px;"><i class="fa fa-info-circle"></i></button></div>
          </div>

           <div class="overviewcard overview-bg-red">
            <div class="overviewcard__icon"> <i class="fa fa-file"></i>  New Orders from Ecommerce</div>
            <div class="overviewcard__info"> {{ Helper::getneworders() }}  <button type="button" class="btn btn-danger" onclick="showModal2()" style="border-radius: 40px;"><i class="fa fa-info-circle"></i></button></div>
          </div>

      </div>

      <br>
      <div><h1 style="color: black;">Sales graph for the year of {{ date('Y') }}</h1></div>
      <div class="main-overview">
          
          <canvas id="myChart" width="400" height="150"></canvas>
      </div>

@include('home_modals')



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
var ctx = document.getElementById('myChart');
var months = new Array();
var sales = new Array();

var url = "{{url('home/chart')}}";
$(document).ready(function(){
  $.ajax({

    type: "GET",
    url : "{{ route('home.chart') }}",
    cache: false,
    success : function(data)
    {
      console.log(data.sales);
      var ctx = document.getElementById('myChart');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: data.months,
              datasets: [{
                  label: 'Total Sales PHP',
                  data: data.sales,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });

    }

    })

  });

</script>
@endsection
