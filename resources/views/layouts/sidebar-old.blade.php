<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('storage/smk-65.jpg') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                @if(Auth::check())
                <li class='sidebar-title'>Menu Utama</li>
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endif

                @if(Auth::check() && Auth::user()->level === 'admin') 
                <li class="sidebar-item has-sub {{ request()->routeIs('siswa.*') || request()->routeIs('kandidat.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i data-feather="database" width="20"></i>
                        <span>Data Master</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('siswa.*') || request()->routeIs('kandidat.*') ? 'active' : '' }}">
                        <li class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                            <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">Siswa</a>
                        </li>
                        <li >
                            <a href="{{ route('kandidat.index') }}" class="{{ request()->routeIs('kandidat.*') ? 'active' : '' }}">Kandidat</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Auth::check() && Auth::user()->level === 'siswa') 
                <li class="sidebar-item {{ request()->routeIs('voting.*') ? 'active' : '' }}">
                    <a href="{{ route('voting.index') }}" class="sidebar-link">
                        <i data-feather="send" width="20"></i>
                        <span>Voting</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-item {{ request()->routeIs('hasil.*') ? 'active' : '' }}">
                    <a href="{{ route('hasil.index') }}" class="sidebar-link">
                        <i data-feather="pie-chart" width="20"></i>
                        <span>Hasil</span>
                    </a>
                </li>

                @if(Auth::check())
                <li class='sidebar-title'>Pengaturan</li>
                @if(Auth::user()->level === 'admin')
                <li class="sidebar-item {{ request()->routeIs('waktu.*') ? 'active' : '' }}">
                    <a href="{{ route('waktu.index') }}" class="sidebar-link">
                        <i data-feather="clock" width="20"></i>
                        <span>Jadwal Voting</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item {{ request()->routeIs('setting.*') ? 'active' : '' }}">
                    <a href="{{ route('setting.index') }}" class="sidebar-link">
                        <i data-feather="user" width="20"></i>
                        <span>Profile</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>