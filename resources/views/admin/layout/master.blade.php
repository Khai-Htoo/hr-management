<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css"
        integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- sortable --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">Hr Managnement</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class=" text-center" style=" margin-left : 600px">
            <h3 class=" text-white ">@yield('title')</h3>
        </div>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">

            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" class=" mx-2">
                            @csrf
                            <button class=" btn btn-sm btn-outline-danger w-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link @yield('profile')">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Profile
                        </a>
                        {{-- @can('view_profile') --}}
                        <a class="nav-link @yield('userList')" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            User List
                        </a>
                        {{-- @endcan --}}
                        {{-- @can('department_view') --}}
                        <a class="nav-link @yield('department')" href="{{ route('department.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-city"></i></div>
                            Department
                        </a>
                        {{-- @endcan --}}

                        <a class="nav-link @yield('project')" href="{{ route('project.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                            Project
                        </a>

                        <a class="nav-link @yield('myProject')" href="{{ route('myProject.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                            My Project
                        </a>

                        <a class="nav-link @yield('role')" href="{{ route('role.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            User Role
                        </a>
                        <a class="nav-link @yield('permission')" href="{{ route('permission.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            User Permission
                        </a>
                        <a class="nav-link @yield('company')" href="{{ route('companySetting.show', 1) }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-building"></i></div>
                            Company Setting
                        </a>
                        <a class="nav-link @yield('check')" href="{{ route('attendance.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                            Check In/Out
                        </a>
                        <a class="nav-link @yield('scan')" href="{{ route('scan') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-qrcode"></i></div>
                            Attendance Scan
                        </a>
                        <a class="nav-link @yield('overview')" href="{{ route('attendance-overview') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users-viewfinder"></i></div>
                            Attendance Overview
                        </a>
                        <a class="nav-link @yield('salary')" href="{{ route('salary.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill"></i></div>
                            Salary
                        </a>
                        <a class="nav-link @yield('payroll')" href="{{ route('payroll-overview') }}">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-amazon-pay"></i></div>
                            Payroll
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->email }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

            <main>
                @yield('content')
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" --}}
    {{-- crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/scan/qr-scanner.umd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"
        integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/webauthn/webauthn.js') }}"></script>
    <!-- Latest Sortable -->
    <script src="http://SortableJS.github.io/Sortable/Sortable.js"></script>
    @yield('script')
    <script>
        $(document).ready(function() {

            let token = document.head.querySelector('meta[name="csrf-token"]')

            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X_CSRF-TOKEN': token.content
                    }
                })
            }

            $.extend(true, $.fn.dataTable.defaults, {
                mark: true
            });
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                })
            @endif

            @if (session('fail'))
                const Toast = Swal.mixin({
                    // toast: true,
                    position: 'top-center',
                })

                Toast.fire({
                    icon: 'error',
                    title: '{{ session('fail') }}'
                })
            @endif

            $(document).ready(function() {
                $('.select2').select2();
            });


        })
    </script>
</body>

</html>
