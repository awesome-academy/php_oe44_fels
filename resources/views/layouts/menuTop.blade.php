<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @if(Auth::guard('admin')->check())
        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                        <i class="ti-menu"></i>
                    </a>
                    <div class="mobile-search waves-effect waves-light">
                        <div class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter Keyword">
                                    <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('home')}}">
                        <img class="img-fluid" src="" alt="Theme-Logo" />
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li>
                            <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                        </li>
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                <i class="ti-fullscreen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <a href="{{ route('i18n','vi') }}">VI</a>
                        <a href="{{ route('i18n','en') }}">EN</a>
                        <li class="user-profile header-notification">
                            <a href="#!" class="waves-effect waves-light">
                                <span>{{ Auth::guard('admin')->user()->name }}</span>
                                <i class="ti-angle-down"></i>
                            </a>
                            <ul class="show-notification profile-notification">
                                <li class="waves-effect waves-light">
                                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="ti-layout-sidebar-left"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                    <div class="pcoded-inner-navbar main-menu">
                        <div class="p-15 p-b-0">
                            <form class="form-material">
                                <div class="form-group form-primary">
                                    <input type="text" name="footer-email" class="form-control" required="">
                                    <span class="form-bar"></span>
                                    <label class="float-label"><i class="fa fa-search m-r-10"></i>@lang('search')</label>
                                </div>
                            </form>
                        </div>
                        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">@lang('catalog')</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li>
                                <a href="{{ route('courses.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">@lang('courses')</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lessons.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">@lang('lessons')</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('words.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">@lang('words')</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categories.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">@lang('categories')</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                @else

                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">
                        <div class="navbar-logo">
                            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                                <i class="ti-menu"></i>
                            </a>
                            <div class="mobile-search waves-effect waves-light">
                                <div class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter Keyword">
                                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('home')}}">
                                <img class="img-fluid" src="" alt="Theme-Logo" />
                            </a>
                            <a class="mobile-options waves-effect waves-light">
                                <i class="ti-more"></i>
                            </a>
                        </div>

                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                <li class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <a href="{{ route('i18n','vi') }}">VI</a>
                                <a href="{{ route('i18n','en') }}">EN</a>
                                <li class="user-profile header-notification">
                                    <a href="#!" class="waves-effect waves-light">
                                        @if(Auth::user()->provider_id && strpos(Auth::user()->avatar,'http'))
                                        <img src="{{ Auth::user()->avatar }}" class="img-radius" alt="{{ Auth::user()->name }}">
                                        @else
                                        @php
                                        $pathAvatar = Auth::user()->avatar;
                                        @endphp
                                        <img src='{{asset("$pathAvatar")}}' class="img-radius" alt="{{ Auth::user()->name }}">
                                        @endif
                                        <span>{{ Auth::user()->name }}</span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                        <li class="waves-effect waves-light">
                                            <a href="{{route('user.profile')}}">
                                                <i class="ti-user"></i> @lang('profile')
                                            </a>
                                        </li>
                                        <li class="waves-effect waves-light">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="ti-layout-sidebar-left"></i>Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="">
                                    <div class="main-menu-header">
                                        @if(Auth::user()->provider_id && strpos(Auth::user()->avatar,'http'))
                                        <img class="img-80 img-radius" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                                        @else
                                        @php
                                        $pathAvatar = Auth::user()->avatar;
                                        @endphp
                                        <img class="img-80 img-radius" src='{{asset("$pathAvatar")}}' alt="{{ Auth::user()->name }}">
                                        @endif
                                        <div class="user-details">
                                            <span id="more-details">{{Auth::user()->name}}<i class="fa fa-caret-down"></i></span>
                                        </div>
                                    </div>

                                    <div class="main-menu-content">
                                        <ul>
                                            <li class="more-details">
                                                <a href="{{route('user.profile')}}"><i class="ti-user"></i>@lang('profile')</a>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ti-layout-sidebar-left"></i>@lang('logout')</a>
                                                <form action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="p-15 p-b-0">
                                    <form class="form-material">
                                        <div class="form-group form-primary">
                                            <input type="text" name="footer-email" class="form-control" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label"><i class="fa fa-search m-r-10"></i>@lang('search')</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">@lang('catalog')</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li>
                                        <a href="{{route('home')}}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">@lang('dashboard')</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('other.courses')}}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">@lang('other_courses')</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('words')}}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">@lang('list_word')</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </nav>
                        @endif
