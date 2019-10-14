@extends('layouts.app')

@section('content')
<div id="page-wrapper">
@php
	$user_count = DB::table('users')->count();
  use App\Helpers\Helper;
@endphp
	<div class="row">

<br>

    <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-money fa-3x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div style="min-height:5em;">Sales for this month</div>
                      </div>
                  </div>
              </div>
                <div class="panel-footer">
                    <span class="pull-left" style="font-weight: bold;">PHP {{ Helper::numberFormat(Helper::getMonthlySales()) }}</span>
                    <div class="clearfix"></div>
                </div>
          </div>
      </div>


      <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-money fa-3x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div style="min-height:5em;">Sales for today</div>
                      </div>
                  </div>
              </div>
                <div class="panel-footer">
                    <span class="pull-left" style="font-weight: bold;">PHP {{ Helper::numberFormat(Helper::getTodaySales()) }}</span>
                    <div class="clearfix"></div>
                </div>
          </div>
      </div>


      <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-list fa-3x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div style="min-height:5em;">Items below minimum level</div>
                      </div>
                  </div>
              </div>
                <div class="panel-footer">
                    <span class="pull-left" style="font-weight: bold;">{{ Helper::getMinimumItems() }}</span>
                    <div class="clearfix"></div>
                </div>
          </div>
      </div>

{{--             <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sales for this month</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">PHP {{ Helper::numberFormat(Helper::getMonthlySales()) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sales for today</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">PHP {{ Helper::numberFormat(Helper::getTodaySales()) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Items below minimum level</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Helper::getMinimumItems() }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dolly-flatbed fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending Payments on E-Commece Order</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Orders from Ecommerce</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dolly-flatbed fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}

	</div> 
</div>   
@endsection
