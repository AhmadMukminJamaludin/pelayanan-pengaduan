<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('welcome.daftar-aduan') }}">Daftar Aduan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('welcome.profile') }}">Profile</a></li>
        @auth
            <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Home</a></li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><strong>Login</strong></a></li>
            @if (Route::has('register'))
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><strong>Register</strong></a></li>
            @endif
        @endauth
    </ul>
</div>
