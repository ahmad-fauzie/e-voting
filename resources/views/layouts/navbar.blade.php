<nav class="navbar navbar-expand-lg" style="background-color: #B2B2B2;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="{{ asset('storage/smk-65.jpg') }}" width="50" class="rounded-circle"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          @if(Auth::check() && Auth::user()->level === 'admin') 
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}" href="{{route('siswa.index')}}">Siswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('kandidat.*') ? 'active' : '' }}" href="{{route('kandidat.index')}}">Kandidat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('waktu.*') ? 'active' : '' }}" href="{{route('waktu.index')}}">Waktu</a>
          </li>
          @endif
          @if(Auth::check() && Auth::user()->level === 'siswa')
          {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('kandidat.*') ? 'active' : '' }}" href="{{route('kandidat.info')}}">Kandidat</a>
          </li>  --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('voting.*') ? 'active' : '' }}" href="{{route('voting.index')}}">Voting</a>
          </li>
          @endif
          @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('setting.*') ? 'active' : '' }}" href="{{route('setting.index')}}">Setting</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('hasil.*') ? 'active' : '' }}" href="{{route('hasil.index')}}">Hasil</a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li> --}}
        </ul>
        {{-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
        @if(Auth::check())
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
          </li>
        </ul>
        @endif
      </div>
    </div>
  </nav>