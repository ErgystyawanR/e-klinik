<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">E-KLINIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">EK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master Data</li>
            <li class="{{ Request::routeIs('obat') ? 'active' : '' }}">
                <a href="{{ route('obat') }}" class="nav-link"><i class="fas fa-tablets"></i><span>Obat</span></a>
            </li>
            <li class="{{ Request::routeIs('signa') ? 'active' : '' }}">
                <a href="{{ route('signa') }}" class="nav-link"><i class="fas fa-info"></i><span>Signa</span></a>
            </li>
            <li class="menu-header">Buat Resep</li>
            <li class="{{ Request::routeIs('racikan') ? 'active' : '' }}">
                <a href="{{ route('racikan') }}" class="nav-link"><i
                        class="fas fa-capsules"></i><span>Racikan</span></a>
            </li>
            <li class="{{ Request::routeIs('nonracikan') ? 'active' : '' }}">
                <a href="{{ route('nonracikan') }}" class="nav-link"><i class="fas fa-tablets"></i><span>Non
                        Racikan</span></a>
            </li>
        </ul>
    </aside>
</div>
