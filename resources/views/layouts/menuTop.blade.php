<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @if(Auth::guard('admin')->check())
        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a class="mobile-menu waves-effect waves-light" id="mobile-collapse">
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
                    <a href="{{route('admin.home')}}">
                        <h3 class="img-fluid pl-3 pt-3 pb-1">FELS</h3>
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
                        <li>
                            <div class="mt-1 text-white">
                                <label class="label label-inverse-default" id="time"></label>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="user-profile">
                            <a href="#!" class="waves-effect waves-light">
                                <span>{{ Auth::guard('admin')->user()->name }}</span>
                            </a>
                        </li>
                        <li class="user-profile text-danger">
                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        <li class="user-profile">
                            <a class="text-success" href="{{ route('i18n','vi') }}">VI</a>
                        </li>
                        <li class="user-profile">
                            <a class="text-success" href="{{ route('i18n','en') }}">EN</a>
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
                                <a href="{{ route('admin.home') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">@lang('home')</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="header-notification" id="notification-header">
                                <a href="{{ route('notifications') }}" class="waves-effect waves-light">
                                    <span class="pcoded-micon">
                                        <i class="ti-bell"></i>
                                        <b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">@lang('notification')
                                        @if (($num_notify_unread = App\Models\Notification::where([['is_read', 0], ['role', 'ADM']])->count()) != 0)
                                        <label id="ping" data-count="{{ $num_notify_unread }}" class="badge label-danger notif-count label">{{ $num_notify_unread }}</label>
                                        @else
                                        <label id="ping" data-count="{{ $num_notify_unread }}" class="notif-count label">{{ $num_notify_unread }}</label>
                                        @endif
                                    </span>
                                </a>
                            </li>
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
                                <h3 class="img-fluid pl-3 pt-3 pb-1">FELS</h3>
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
                                <li class="header-notification" id="notification-head">
                                    <a href="#!" class="waves-effect waves-light">
                                        <i class="ti-bell"></i>
                                        <span id="bing" class="badge bg-c-red"></span>
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <h6>@lang('notification')</h6>
                                            <span id="count-notify-user" data-count="{{App\Models\Notification::where('role', Auth::user()->id)->count()}}" class="float-right label label-danger">{{App\Models\Notification::where('role', Auth::user()->id)->count()}}</span>
                                        </li>
                                        <li>
                                            <ul id="accor" class="show-notification">
                                                @foreach(App\Models\Notification::where('role', Auth::user()->id)->get() as $item)
                                                <li  class="waves-effect waves-light">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">Bot</h5>
                                                            <p class="notification-msg">{{ $item->content}}.</p>
                                                            <span class="notification-time">{{$item->created_at}}</span>
                                                        </div>
                                                        <button>del</button>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                                <li class="user-profile header-notification">
                                    <a id="id_user" class="d-none"> {{Auth::user()->id}} </a>
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