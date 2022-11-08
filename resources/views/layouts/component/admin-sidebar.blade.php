<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading  px-1 mt-2 mb-1 text-muted">
            <span>Menu</span>
            
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">
                    <i class="bi bi-bar-chart-fill"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('unit*') ? 'active':'' }}" href="{{ route('unit.index') }}">
                    <i class="bi bi-hdd-rack-fill"></i>
                    unit
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('loket*') ? 'active':'' }}" href="{{ route('loket.index') }}">
                    <i class="bi bi-hdd-rack-fill"></i>
                    Loket
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('setting.index') }}">
                    <i class="bi bi-camera-video-fill"></i>
                    Setting
                </a>
            </li>
            
        </ul>

    </div>
</nav>
