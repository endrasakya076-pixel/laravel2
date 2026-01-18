        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Spesimen<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $menuDashboard ?? '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAudit ?? '' }}">
                <a class="nav-link" href="{{ route('audit-log') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Audit Log</span></a>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuUser ?? '' }}">
                <a class="nav-link" href="{{ route('user') }}">
                    <i class="fas fa-user"></i>
                    <span>Data User</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item {{ $menuTugas ?? '' }}">
                <a class="nav-link" href="{{ route('tugas') }}">
                    <i class="fas fa-tasks"></i>
                    <span>Data Spesimen</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->