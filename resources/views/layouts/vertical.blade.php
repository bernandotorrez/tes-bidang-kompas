<nav class="hk-nav hk-nav-light">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">

            <div class="nav-header">
                    @php
                        if(Auth::user()['level'] == 'Adm') {
                            $level = 'Admin';
                        } else if(Auth::user()['level'] == 'Rpt') {
                            $level = 'Reporter';
                        } else {
                            $level = 'Editor';
                        }
                    @endphp
                    <span> {{ $level }} Menu</span>
                    <span> {{ Auth::user()['level'] }}</span>
            </div>

            @if(Auth::user()['level'] == 'Rpt')
            <ul class="navbar-nav flex-column">
                <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home.index') }}" >
                        <span class="feather-icon"><i data-feather="home"></i></span>
                        <span class="nav-link-text">Home</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('reporter/post-article')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('post-article.index') }}" >
                        <span class="feather-icon"><i data-feather="edit"></i></span>
                        <span class="nav-link-text">Write Article</span>
                    </a>
                </li>
            </ul>
            @elseif(Auth::user()['level'] == 'Edt')
            <ul class="navbar-nav flex-column">
                <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home.index') }}" >
                        <span class="feather-icon"><i data-feather="home"></i></span>
                        <span class="nav-link-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="documentation.html" >
                        <span class="feather-icon"><i data-feather="edit"></i></span>
                        <span class="nav-link-text">Publish Article</span>
                    </a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav flex-column">
                <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home.index') }}" >
                        <span class="feather-icon"><i data-feather="home"></i></span>
                        <span class="nav-link-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="documentation.html" >
                        <span class="feather-icon"><i data-feather="edit"></i></span>
                        <span class="nav-link-text">Create User</span>
                    </a>
                </li>
            </ul>
            @endif
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
