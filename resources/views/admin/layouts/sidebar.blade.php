<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Profile</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
       <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.profiles.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Profile</span></a>

    
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.descriptions.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Descriptions</span></a>

    
    </li>

    <!-- Divider -->


</ul>

<style>
    /* Warna dasar sidebar */
    .sidebar {
        background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        transition: all 0.3s ease-in-out;
    }

    /* Teks sidebar */
    .sidebar .nav-link, .sidebar .sidebar-brand-text {
        color: #ffffff;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    /* Efek hover untuk link */
    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
        border-radius: 5px;
    }

    /* Efek ikon */
    .sidebar .nav-link i {
        transition: transform 0.3s ease;
    }

    .sidebar .nav-link:hover i {
        transform: rotate(20deg);
    }

    /* Sidebar aktif */
    .nav-item.active .nav-link {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        border-radius: 5px;
    }

    /* Garis pemisah */
    .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Branding sidebar */
    .sidebar-brand {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        margin: 10px;
        padding: 10px;
    }

    .sidebar-brand:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.2);
    }

    /* Sidebar - efek mode terang */
    body.light-mode .sidebar {
        background: #f8f9fc;
        color: #000;
    }

    body.light-mode .sidebar .nav-link, 
    body.light-mode .sidebar .sidebar-brand-text {
        color: #000;
    }

    body.light-mode .sidebar .nav-link:hover {
        background-color: #e2e6ea;
    }
</style>

<script>
    document.getElementById('toggle-theme').addEventListener('click', function () {
        document.body.classList.toggle('light-mode');
    });
</script>