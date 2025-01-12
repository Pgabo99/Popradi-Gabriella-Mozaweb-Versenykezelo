<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield("title", "Versenykezelő")</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <header>
    <nav class="navbar navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Versenykezelő alkalmazás</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
          aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
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
              <li class="nav-item">
                <a class="nav-link {{Request::path() == '/' ? 'active' : '' }}" aria-current="page"
                  href="{{route("home")}}">Kezdőoldal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{Request::path() == '/competitions' ? 'active' : '' }}"
                  href="{{route("login")}}">Versenyek</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Profil
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  @guest

            <li><a class="dropdown-item {{Request::path() == '/login' ? 'active' : '' }}"
              href="{{route("login")}}">Bejelentkezés</a></li>
            <li><a class="dropdown-item {{Request::path() == '/register' ? 'active' : '' }}"
              href="{{route("register")}}">Regisztráció</a></li>

          @else
        <li><a class="dropdown-item" href="{{route("user.show", Auth::id())}}">Adataim</a></li>
        <li><a class="dropdown-item" href="{{route("home")}}">Versenyeim</a></li>

        <li>
        <hr class="dropdown-divider">
        </li>
        <li>
        <a class="dropdown-item" href="#"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
        <form id="logout-form" action="{{ route('logout.post') }}" method="POST" style="display: none;">
          @csrf
        </form>
        </li>
      @endguest
                </ul>
              </li>
            </ul>
            <!--  <form class="d-flex mt-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button>
            </form> -->
          </div>
        </div>
      </div>
    </nav>
  </header>
  @yield("content")
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>