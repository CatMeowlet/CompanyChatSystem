<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::guard('web')->check())
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="ml-2">{{ __('Friend Request')}} </span> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="navbarDropdown">
                        @foreach ( Auth::user()->friends1 as $friends1 )
                        <li>
                            <img src="{{ url('assets/images/avatar/'.  $friends1->user1->profile->avatar ) }} "
                                alt="profile picture" width="50" height="50">
                            <div style="display:inline-block">
                                {{ $friends1->user1->name }}
                            </div>
                            <div class="btn-menu" data-dataid="{{ $friends1->user1->id }}">
                                <a href="#" class="btn btn-success btn-sm add" id="btn-accept">Accept</a>
                                <a href="#" class="btn btn-danger btn-sm add" id="btn-cancel">Cancel</a>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        style="display: inline;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="position:relative;padding-left:50px;">
                        <img src="{{url('assets/images/avatar/'. $auth_profile->avatar)}}"
                            style="display:inline;width:32px;height:32px;left:10px;border-radius:50%;">
                        <span class="ml-2">{{ $auth_details->name }} </span> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{route('user.profile')}}" class="dropdown-item">Profile</a>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endif

                @if(Auth::guard('admin')->check())
                <li class="nav-item dropdown">
                    <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('admin')->user()->name }} (ADMIN) <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                        <a href="{{route('admin.home')}}" class="dropdown-item">Dashboard</a>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                            Logout
                        </a>
                        <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
