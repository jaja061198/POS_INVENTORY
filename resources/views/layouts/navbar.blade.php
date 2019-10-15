@php
  use App\Helpers\Helper;
  use App\Models\app_manager\Navigation;
  use App\Models\app_manager\Icons;
@endphp


@if(Auth::user()->user_level == 0)

  @php
    $window_type = ['A' => 'Activity','R' => 'Reports', 'TM'  => 'Masterfile', 'AM'  => 'Application Manager' , 'SC' => 'System Control'];
  @endphp

@endif

@if(Auth::user()->user_level == 1)

  @php
    $window_type = ['R' => 'Reports', 'TM'  => 'Masterfile', 'AM'  => 'Application Manager'];
  @endphp

@endif


@if(Auth::user()->user_level == 3)

  @php
    $window_type = ['A' => 'Activity'];
  @endphp

@endif

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color: blue;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}" style="color:white;font-weight: bold;">{{ Helper::GetCompanyInfo()->COMPANY_NAME }}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw"></i>  Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                           </form>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="{{ route('home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                       @foreach ($window_type as $window_type => $window_element)

                            @foreach (Navigation::getNavigations($window_type) as $key => $element)
                              
                              @if ($element['CHILD'] == 1)

                                @if(Helper::getUserAccess($element['NAV_ID'])['VIEW'] == 1)

                                          <li>
                                                  <a href="#"><i class="{{ Icons::getIconClass($element['ICON']) }}"></i> {{ $element['NAV_DESCRIPTION'] }}<span class="fa arrow"></span></a>
                                                  <ul class="nav nav-second-level">

                                                       @if (!empty(Navigation::getCategory($element['NAV_ID'])))
                                                  
                                                           @foreach(Navigation::getCategory($element['NAV_ID']) as $category_key => $category)

                                                               @if ($category['CHILD'] == 0)
                                                                      @if(Helper::getUserAccess($category['NAV_ID'])['VIEW'] == 1)

                                                                        <li style="margin-left: 12px;">
                                                                           <a href="{{ route($category['ROUTE']) }}"> <i class="{{ Icons::getIconClass($category['ICON']) }}"></i> {{ $category['NAV_DESCRIPTION'] }}</a>
                                                                        </li>

                                                                      @endif

                                                               @endif

                                                           @endforeach

                                                        @endif

                                                  </ul>
                                          </li>


                                  @endif

                              @endif

                              @if ($element['CHILD'] == 0)

                                @if(Helper::getUserAccess($element['NAV_ID'])['VIEW'] == 1)
                                    <li>
                                     <a href="{{ route($element['ROUTE']) }}"> <i class="{{ Icons::getIconClass($element['ICON']) }}"></i> {{ $element['NAV_DESCRIPTION'] }}</a>
                                  </li>
                                  @endif
                              @endif

                          @endforeach

                        @endforeach
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>