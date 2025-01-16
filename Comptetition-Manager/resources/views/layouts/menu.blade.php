<header>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Versenykezelő alkalmazás</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Versenykezelő</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                        <!--Home Page -->
                        <li class="nav-item">
                            <a class="nav-link {{Request::path() == '/' ? 'active' : '' }}" aria-current="page"
                                href="{{route("home")}}">Kezdőoldal</a>
                        </li>

                        <!-- Competitions -->
                        <li class="nav-item">
                            <a class="nav-link {{Request::path() == '/competitions/show' ? 'active' : '' }}" aria-current="page"
                                href="{{route("competitions.show")}}">Versenyek</a>
                        </li>

                        <!-- Pages available only for Admins -->
                        @if(Auth::check() && auth()->user()->user_type == "Admin")

                            <!--The dropdown -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">

                                <!--Competitions Page -->
                                <li class="nav-item">
                                    <a class="dropdown-item {{Request::path() == '/competitions/create' ? 'active' : '' }}"
                                        href="{{route("competitions.create")}}">Versenyek</a>
                                </li>

                                <!--Rounds Page -->
                                <li class="nav-item">
                                    <a class="dropdown-item {{Request::path() == '/rounds/create' ? 'active' : '' }}"
                                        href="{{route("rounds.create")}}">Fordulók</a>
                                </li>

                                <!--Competitors Page -->
                                <li class="nav-item">
                                    <a class="dropdown-item {{Request::path() == '/competitors/create' ? 'active' : '' }}"
                                        href="{{route("competitors.create")}}">Versenyzők</a>
                                </li>
                            </ul>
                        @endif

                        <!-- Pages related to users -->
                        <li class="nav-item dropdown">

                            <!--The dropdown -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">


                                @guest
                                    <!-- Guests-->
                                    <li><a class="dropdown-item {{Request::path() == '/login' ? 'active' : '' }}"
                                            href="{{route("login")}}">Bejelentkezés</a></li>
                                    <li><a class="dropdown-item {{Request::path() == '/register' ? 'active' : '' }}"
                                            href="{{route("register")}}">Regisztráció</a></li>

                                @else
                                    <!-- Logged in users-->
                                    <li><a class="dropdown-item" href="{{route("user.show", Auth::id())}}">Adataim</a></li>
                                    <li><a class="dropdown-item" href="{{route("home")}}">Versenyeim</a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
                                        <form id="logout-form" action="{{ route('logout.post') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>