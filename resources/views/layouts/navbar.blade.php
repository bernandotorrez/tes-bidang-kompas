<nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
    <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
    <a class="navbar-brand" href="dashboard1.html">
        <img class="brand-img d-inline-block" width="50px" height="50px" src="{{ asset('dist/img/kompas.png') }}" alt="brand" />
    </a>
    <ul class="navbar-nav hk-navbar-content">
        <li class="nav-item dropdown dropdown-authentication">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            <img src="{{ asset('dist/img/avatar12.jpg') }}" alt="user" class="avatar-img rounded-circle">
                        </div>
                        <span class="badge badge-success badge-indicator"></span>
                    </div>
                    <div class="media-body">
                        <span>{{ Auth::user()['name'] }}<i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <a class="dropdown-item" href="{{ route('login.logout') }}"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
            </div>
        </li>
    </ul>
</nav>
