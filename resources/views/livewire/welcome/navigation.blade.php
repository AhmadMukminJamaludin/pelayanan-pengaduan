<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('welcome.daftar-aduan') }}">Daftar Aduan</a></li>
        @auth
            <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Home</a></li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @if (Route::has('register'))
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endif
        @endauth
    </ul>
</div>
