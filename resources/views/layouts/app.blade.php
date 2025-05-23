<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Antar.In | {{ $title }}</title>

    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
            <div class="sidebar-brand-icon">
                <!-- <img src="{{ asset('sbadmin2/img/logo.png') }}" alt="Logo" width="100"> -->
            </div>
            <div class="sidebar-brand-text mx-3">AntarIn</div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item {{ $activeDashboard ?? '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        @if(auth()->user()->role === 'Admin')
            <div class="sidebar-heading">Menu Admin</div>

            <li class="nav-item {{ $activeUser ?? '' }}">
                <a class="nav-link" href="{{ route('user') }}">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="nav-item {{ $activeDriver ?? '' }}">
                <a class="nav-link" href="{{ route('driver.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Driver</span>
                </a>
            </li>

            <li class="nav-item {{ $activeAbsensi ?? '' }}">
                <a class="nav-link" href="{{ route('admin.absensi.index') }}">
                    <i class="fas fa-user-check"></i>
                    <span>Absensi</span>
                </a>
            </li>

            <li class="nav-item {{ $activeOrder ?? '' }}">
                <a class="nav-link" href="{{ route('order.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Kirim Order</span>
                </a>
            </li>

            <li class="nav-item {{ $activeGaji ?? '' }}">
                <a class="nav-link" href="{{ route('admin.gaji_driver') }}">
                    <i class="fas fa-money-check-alt"></i>
                    <span>Gaji Driver</span>
                </a>
            </li>

            <li class="nav-item {{ $activePendapatan ?? '' }}">
                <a class="nav-link" href="{{ route('admin.pendapatan') }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Pendapatan Aplikasi</span>
                </a>
            </li>
            

            <li class="nav-item {{ $activeHistory ?? '' }}">
                <a class="nav-link" href="{{ route('admin.deliveries.history') }}">
                    <i class="fas fa-history"></i>
                    <span>History</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->role === 'Driver')
            <div class="sidebar-heading">Menu Driver</div>

            <li class="nav-item {{ $activeOrder ?? '' }}">
                <a class="nav-link" href="{{ route('order.index') }}">
                    <i class="fas fa-truck-loading"></i>
                    <span>Orderan Masuk</span>
                </a>
            </li>

            <li class="nav-item {{ $activePendapatanDriver ?? '' }}">
                <a class="nav-link" href="{{ route('driver.pendapatan') }}">
                    <i class="fas fa-money-check-alt"></i>
                    <span>Pendapatan Driver</span>
                </a>
            </li>
        @endif

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->username }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('sbadmin2/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <div class="badge badge-success justify-content-center d-flex">{{ auth()->user()->role }}</div>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">

                    @yield('content')

                </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Antar.In 2025</span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('sbadmin2/js/demo/datatables-demo.js') }}"></script>

    {{-- Sweetalert --}}
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    @session('success')
        <script>
            Swal.fire({
            title: "Suksess",
            text: "{{ session('success') }}",
            icon: "success"
        });
        </script>
    @endsession
    @session('error')
        <script>
            Swal.fire({
            title: "Gagal",
            text: "{{ session('error') }}",
            icon: "error"
        });
        </script>
    @endsession
</body>

</html>
