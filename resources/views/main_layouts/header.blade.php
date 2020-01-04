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


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom: 0; background-image: linear-gradient(to right, #2678B3 , #0C4873); position: fixed; left: 0px; right: 0px; top: 0px; ">

      <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">Oculus <span style='font-size:11px;'></span> </a>
            </div>

            <ul class="nav navbar-right top-nav">
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->fname." ".Auth::user()->lname }}
                        <i class="fa fa-user"></i> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        {{-- <li>
                            <a href="settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li> --}}
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav side-nav">
                    
                    
                    
                    <li @if(Request::route()->getName() == 'home') class="active" @endif>
                        <a href="{{ route('home') }}">
                        <span class="fa fa-bar-chart" style="font-size: 18px;"></span> Dashboard</a>
                    </li>

                    {{-- <li><a href=""><span class="fa fa-flag" style="font-size: 21px;"></span> My Requests</a></li>
                    <li>
                        <a href="/equipment">
                        <span class="fa fa-plug" style="font-size:18px;"></span> Equipment</a>
                    </li>

                    <li><a href='javascript:;' data-toggle='collapse' data-target='#services'>
                        <span class="glyphicon glyphicon-book" style="font-size: 18px;"></span> Tickets <i class='fa fa-fw fa-caret-down'></i></a>
                        <ul id='services' class='collapse'>
                        <li><a href="}">Create Ticket</a></li>
                        <li><a href="">All Tickets</a></li>
                        </ul>
                    </li> --}}

                    @foreach ($window_type as $window_type => $window_element)



                        @foreach (Navigation::getNavigations($window_type) as $key => $element)

                            @if ($element['CHILD'] == 1)

                                @if(Helper::getUserAccess($element['NAV_ID'])['VIEW'] == 1)

                                    <li><a href='javascript:;' data-toggle='collapse' data-target='#target{{ $element['NAV_ID'] }}'>

                                        <span class="{{ Icons::getIconClass($element['ICON']) }}" style="font-size: 18px;"></span> {{ $element['NAV_DESCRIPTION'] }}<i class='fa fa-fw fa-caret-down'></i></a>
                                        <ul id='target{{ $element['NAV_ID'] }}' class='collapse'>

                                            @if (!empty(Navigation::getCategory($element['NAV_ID'])))


                                                @foreach(Navigation::getCategory($element['NAV_ID']) as $category_key => $category)


                                                {{-- {{ Navigation::getCategory($element['NAV_ID'])->pluck('ROUTE') }} --}}

                                                    @if ($category['CHILD'] == 0)

                                                            @if(Helper::getUserAccess($category['NAV_ID'])['VIEW'] == 1)

                                                                <li @if(Request::route()->getName() == $category['ROUTE']) class="active" @endif><a href="{{ route($category['ROUTE']) }}">{{ $category['NAV_DESCRIPTION'] }}</a></li>

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


                                    <li><a href="{{ route($element['ROUTE']) }}">{{ $element['NAV_DESCRIPTION'] }}</a></li>


                                @endif

                            @endif

                        @endforeach


                    @endforeach

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>