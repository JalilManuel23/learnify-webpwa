<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Learnify </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url ('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Administración</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Listas de Acceso (ACL)
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
   {{--  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Roles -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('roles') }}">
            <i class="fas fa-fw fa-user-secret"></i>
            <span>Roles</span></a>
    </li>

    <!-- Nav Item - Usuarios -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('usuarios')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span></a>
    </li>

    <!-- Nav Item - Estudiantes -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('estudiantes')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Estudiantes</span></a>
    </li>

    <!-- Nav Item - Cursos -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('')}}">
            <i class="fas fa-fw fa-play"></i>
            <span>Cursos</span></a>
    </li>

    <!-- Nav Item - Categorías -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Categorías</span></a>
    </li>

    <!-- Nav Item - Examen -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('')}}">
            <i class="fas fa-fw fa-book"></i>
            <span>Examen</span></a>
    </li>

    <!-- Nav Item - Instructores -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Instructores</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->