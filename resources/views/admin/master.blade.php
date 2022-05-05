<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت خدمات فنی</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- jQuery -->
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
          href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/css/adminlte.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
    <!-- Drope Zone -->
    <link rel="stylesheet" href="/admin/css/dropzone.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
          rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/admin/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="/admin/css/custom-style.css">

    <link href="/admin/img/cms-icon.png" rel="shortcut icon">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('admin.section.header')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">پنل مدیریت خدمات فنی</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('panel.index') }}" class="nav-link  {{ Request::is('admin/panel') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    پیشخوان
                                </p>
                            </a>
                        </li>
{{--                        menu-open--}}
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cube"></i>
                                <p>
                                    مدیریت آگهی ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('posts.index') }}" class="nav-link {{ Request::is('admin/posts*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>آگهی های ثبت شده</p>
                                        &nbsp;
                                        &nbsp;
                                        <span class="badge badge-info-red right">{{ \App\Models\Post::where('status', 0)->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسته بندی آگهی</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('workingexperiences.index') }}" class="nav-link {{ Request::is('admin/workingexperiences*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسته بندی تجربه کاری</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cooperations.index') }}" class="nav-link {{ Request::is('admin/cooperations*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسته بندی نوع همکاری</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pmethods.index') }}" class="nav-link {{ Request::is('admin/pmethod*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسته بندی شیوه پرداخت</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('workinghours.index') }}" class="nav-link {{ Request::is('admin/workinghours*') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>دسته بندی ساعت کاری</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    مدیریت کاربران<span
                                        class="badge badge-info right">{{ \App\Models\User::all()->count() }}</span>
                                </p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('transactions.index') }}" class="nav-link {{ Request::is('admin/transactions*') ? 'active' : '' }}">--}}
{{--                                <i class="nav-icon fa fa-dollar"></i>--}}
{{--                                <p>--}}
{{--                                    مدیریت تراکنش ها<span--}}
{{--                                        class="badge badge-danger right">{{ \App\Models\Transaction::where('status', 0)->count() }}</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @yield('container-header')
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
</div>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/admin/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/plugins/fastclick/fastclick.js"></script>
<!-- SweetAlert -->
<script src="/admin/js/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/js/demo.js"></script>
</body>
</html>
