<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin')</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{asset('contents/backend')}}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('contents/backend')}}/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('contents/backend')}}/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('contents/backend')}}/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('contents/backend')}}/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('contents/backend')}}/css/themes/all-themes.css" rel="stylesheet" />
    <link href="{{asset('contents/backend')}}/toastr/toastr.min.css" rel="stylesheet" />
    @stack('css')
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{url('admin/dashboard')}}">Admin Pannel</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i
                                class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('storage/profile/'.Auth::user()->image)}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                @if(Auth::user()->id == 1)
                                <a href="{{url('admin/settings')}}"><i class="material-icons">person</i>Profile</a>
                                @else
                                <a href="{{url('author/settings')}}"><i class="material-icons">person</i>Profile</a>
                                @endif
                            </li>
                            <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="material-icons">exit_to_app</i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Main Navigation</li>
                    {{-- admin is here --}}

                    @if(Request::is('admin*'))

                    <li class="{{Request::is('admin/dashboard')? 'active':''}}">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{Request::is('admin/tags*')? 'active':''}}">
                        <a href="{{route('admin.tags.index')}}">
                            <i class="material-icons">label</i>
                            <span>Tags</span>
                        </a>
                    </li>

                    <li class="{{Request::is('admin/categories*')? 'active':''}}">
                        <a href="{{route('admin.categories.index')}}">
                            <i class="material-icons">apps</i>
                            <span>Categories</span>
                        </a>
                    </li>
                    
                    <li class="{{Request::is('admin/posts*')? 'active':''}}">
                        <a href="{{route('admin.posts.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>

                    <li class="{{Request::is('admin/post/pending')? 'active':''}}">
                        <a href="{{route('admin.post.pending')}}">
                            <i class="material-icons">library_books</i>
                            <span>Pending Post</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/subscriber')? 'active':''}}">
                        <a href="{{route('admin.subscriber.index')}}">
                            <i class="material-icons">subscriptions</i>
                            <span>Subscriber</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/favorite/post')? 'active':''}}">
                        <a href="{{route('admin.favorite.post')}}">
                            <i class="material-icons">favorite</i>
                            <span>Favorite Posts</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/comments')? 'active':''}}">
                        <a href="{{route('admin.comments.index')}}">
                            <i class="material-icons">comment</i>
                            <span>Comments</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/authors')? 'active':''}}">
                        <a href="{{route('admin.authors.index')}}">
                            <i class="material-icons">accessibility</i>
                            <span>Authors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}">
                            <i class="material-icons">web</i>
                            <span>Vist Website</span>
                        </a>
                    </li>
                    <li class="header">Settings</li>
                    <li class="{{Request::is('admin/settings')? 'active':''}}">
                        <a href="{{route('admin.settings')}}">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">exit_to_app</i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endif


                    {{-- author is here --}}
                    @if(Request::is('author*'))

                    <li class="{{Request::is('author/dashboard')? 'active':''}}">
                        <a href="{{route('author.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/posts*')? 'active':''}}">
                        <a href="{{route('author.posts.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>
                    <li class="{{Request::is('favorite/post')? 'active':''}}">
                        <a href="{{route('author.favorite.post')}}">
                            <i class="material-icons">favorite</i>
                            <span>Favorite Posts</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/comments')? 'active':''}}">
                        <a href="{{route('author.comments.index')}}">
                            <i class="material-icons">comment</i>
                            <span>Comments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/')}}">
                            <i class="material-icons">web</i>
                            <span>Vist Website</span>
                        </a>
                    </li>
                    <li class="header">Settings</li>
                    <li class="{{Request::is('author/settings')? 'active':''}}">
                        <a href="{{route('author.settings')}}">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">exit_to_app</i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                    @endif

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        @yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="{{asset('contents/backend')}}/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/bootstrap/js/bootstrap.js"></script>
    {{-- <script src="{{asset('contents/backend')}}/plugins/bootstrap-select/js/bootstrap-select.js"></script> --}}
    <script src="{{asset('contents/backend')}}/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="{{asset('contents/backend')}}/plugins/node-waves/waves.js"></script>
    <script src="{{asset('contents/backend')}}/js/admin.js"></script>
    <script src="{{asset('contents/backend')}}/js/demo.js"></script>
    <script src="{{asset('contents/backend')}}/toastr/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{$error}}','Error',{
                    closeButton:true,
                    progressBar:true,
                });
            @endforeach
        @endif

    </script>
    @stack('js')
</body>

</html>
