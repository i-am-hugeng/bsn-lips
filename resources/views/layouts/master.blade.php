<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LIPS | Admin Area</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}">

    <!-- Font Family -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- JQuery UI -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- DataTables -->
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte')}}/dist/css/skins/_all-skins.min.css">
  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <!-- Custom CSS. -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Auto Logout -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{asset('js/autologout.js')}}"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">lips<b>BSN</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="total permintaan">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-info">{{$permintaan_all}}</span>
            </a>
            {{-- <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset('adminlte')}}./dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul> --}}
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="terkirim">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success">{{$terkirim}}</span>
            </a>
            {{-- <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul> --}}
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="belum terkirim">
              <i class="fa fa-hourglass-start"></i>
              <span class="label label-warning">{{$belum_terkirim}}</span>
            </a>
            {{-- <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul> --}}
          </li>
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="gagal proses">
              <i class="fa fa-ban"></i>
              <span class="label label-danger">{{$gagal_proses}}</span>
            </a>
            {{-- <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul> --}}
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('logo/ms-icon-150x150.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('logo/ms-icon-150x150.png')}}" class="img-circle" alt="User Image">

                <p>
                    {{ Auth::user()->name }}
                  <small>Permintaan Standar Internal BSN</small>
                </p>
              </li>
              <!-- Menu Body -->
              {{-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> --}}
                <!-- /.row -->
              {{-- </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          {{-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> --}}
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('logo/ms-icon-150x150.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li  class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{url('admin/dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li  class="{{ Request::is('admin/permintaan*') ? 'active' : '' }}">
            <a href="{{url('admin/permintaan')}}">
                <i class="fa fa-bolt"></i> <span>Permintaan</span>
            </a>
        </li>
        {{-- <li  class="{{ Request::is('admin/reporting*') ? 'active' : '' }}">
            <a href="{{url('admin/reporting')}}">
                <i class="fa fa-pie-chart"></i> <span>Reporting</span>
            </a>
        </li> --}}
        <li class="treeview {{ Request::is('admin/standar/*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-book"></i> <span>Standar</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('admin/standar/sni') ? 'active' : '' }}"><a href="{{url('admin/standar/sni')}}"><i class="{{ Request::is('admin/standar/sni') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> SNI</a></li>
              <li class="{{ Request::is('admin/standar/astm') ? 'active' : '' }}"><a href="{{url('admin/standar/astm')}}"><i class="{{ Request::is('admin/standar/astm') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> ASTM</a></li>
              <li class="{{ Request::is('admin/standar/iec') ? 'active' : '' }}"><a href="{{url('admin/standar/iec')}}"><i class="{{ Request::is('admin/standar/iec') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> IEC</a></li>
              <li class="{{ Request::is('admin/standar/iso') ? 'active' : '' }}"><a href="{{url('admin/standar/iso')}}"><i class="{{ Request::is('admin/standar/iso') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> ISO</a></li>
              <li class="{{ Request::is('admin/standar/lainnya') ? 'active' : '' }}"><a href="{{url('admin/standar/lainnya')}}"><i class="{{ Request::is('admin/standar/lainnya') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Lainnya</a></li>
            </ul>
        </li>
        <li class="treeview {{ Request::is('admin/unit-kerja/*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-bank"></i> <span>Unit Kerja</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('admin/unit-kerja/sestama') ? 'active' : '' }}"><a href="{{url('admin/unit-kerja/sestama')}}"><i class="{{ Request::is('admin/unit-kerja/sestama') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Sestama</a></li>
              <li class="{{ Request::is('admin/unit-kerja/pengembangan') ? 'active' : '' }}"><a href="{{url('admin/unit-kerja/pengembangan')}}"><i class="{{ Request::is('admin/unit-kerja/pengembangan') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Pengembangan</a></li>
              <li class="{{ Request::is('admin/unit-kerja/penerapan') ? 'active' : '' }}"><a href="{{url('admin/unit-kerja/penerapan')}}"><i class="{{ Request::is('admin/unit-kerja/penerapan') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Penerapan</a></li>
              <li class="{{ Request::is('admin/unit-kerja/akreditasi') ? 'active' : '' }}"><a href="{{url('admin/unit-kerja/akreditasi')}}"><i class="{{ Request::is('admin/unit-kerja/akreditasi') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Akreditasi</a></li>
              <li class="{{ Request::is('admin/unit-kerja/snsu') ? 'active' : '' }}"><a href="{{url('admin/unit-kerja/snsu')}}"><i class="{{ Request::is('admin/unit-kerja/snsu') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> SNSU</a></li>
              <li class="{{ Request::is('admin/unit-kerja/klt') ? 'active' : '' }}"><a href="{{url('admin/unit-kerja/klt')}}"><i class="{{ Request::is('admin/unit-kerja/klt') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> KLT</a></li>
            </ul>
        </li>
        <li  class="{{ Request::is('admin/dokumen-tidak-tersedia*') ? 'active' : '' }}">
            <a href="{{url('admin/dokumen-tidak-tersedia')}}">
                <i class="fa fa-ban"></i> <span>Dokumen Tidak Tersedia</span>
            </a>
        </li>
        @if (Auth::user()->id != '1')
        <li class="treeview">
            <a href="#" title="Hak akses khusus Super Admin">
              <i class="fa fa-folder-open"></i> <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-times"></i>
              </span>
            </a>
            {{-- <ul class="disabled treeview-menu">
                <li class="disabled"><a href="#"><i class="{{ Request::is('admin/data-master/data-pengelola') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Data Pengelola</a></li>
                <li class="disabled"><a href="#"><i class="{{ Request::is('admin/data-master/data-pegawai') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Data Pegawai</a></li>
                <li class="disabled"><a href="#"><i class="{{ Request::is('admin/data-master/tujuan-penggunaan') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Tujuan Penggunaan</a></li>
            </ul> --}}
        </li>
        @else
        <li class="treeview {{ Request::is('admin/data-master/*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-folder-open"></i> <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::is('admin/data-master/data-pengelola') ? 'active' : '' }}"><a href="{{url('admin/data-master/data-pengelola')}}"><i class="{{ Request::is('admin/data-master/data-pengelola') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Data Pengelola</a></li>
                <li class="{{ Request::is('admin/data-master/data-pegawai') ? 'active' : '' }}"><a href="{{url('admin/data-master/data-pegawai')}}"><i class="{{ Request::is('admin/data-master/data-pegawai') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Data Pegawai</a></li>
                <li class="{{ Request::is('admin/data-master/tujuan-penggunaan') ? 'active' : '' }}"><a href="{{url('admin/data-master/tujuan-penggunaan')}}"><i class="{{ Request::is('admin/data-master/tujuan-penggunaan') ? 'fa fa-circle' : 'fa fa-circle-o' }}"></i> Tujuan Penggunaan</a></li>
            </ul>
        </li>
        @endif

        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('adminlte')}}./index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="{{asset('adminlte')}}./index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> --}}
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li> --}}
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li class="active"><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul> --}}
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>AdminLTE Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2022 <a href="https://bsn.go.id">Badan Standardisasi Nasional</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  {{-- <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside> --}}
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Jquery Validate -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


<!-- DOM Halaman Rekap SNI -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#sni-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/standar/sni')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nomor_standar',
                    name : 'nomor_standar',
                },
                {
                    data : 'sestama',
                    name : 'sestama',
                },
                {
                    data : 'pengembangan',
                    name : 'pengembangan',
                },
                {
                    data : 'penerapan',
                    name : 'penerapan',
                },
                {
                    data : 'akreditasi',
                    name : 'akreditasi',
                },
                {
                    data : 'snsu',
                    name : 'snsu',
                },
                {
                    data : 'klt',
                    name : 'klt',
                },
                {
                    data : 'total',
                    name : 'total',
                },
            ],
            order : [[0, 'asc']],
        });
    });
</script>

<!-- DOM Halaman Rekap ASTM -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#astm-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/standar/astm')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nomor_standar',
                    name : 'nomor_standar',
                },
                {
                    data : 'sestama',
                    name : 'sestama',
                },
                {
                    data : 'pengembangan',
                    name : 'pengembangan',
                },
                {
                    data : 'penerapan',
                    name : 'penerapan',
                },
                {
                    data : 'akreditasi',
                    name : 'akreditasi',
                },
                {
                    data : 'snsu',
                    name : 'snsu',
                },
                {
                    data : 'klt',
                    name : 'klt',
                },
                {
                    data : 'total',
                    name : 'total',
                },
            ],
            order : [[0, 'asc']],
        });
    });
</script>

<!-- DOM Halaman Rekap IEC -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#iec-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/standar/iec')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nomor_standar',
                    name : 'nomor_standar',
                },
                {
                    data : 'sestama',
                    name : 'sestama',
                },
                {
                    data : 'pengembangan',
                    name : 'pengembangan',
                },
                {
                    data : 'penerapan',
                    name : 'penerapan',
                },
                {
                    data : 'akreditasi',
                    name : 'akreditasi',
                },
                {
                    data : 'snsu',
                    name : 'snsu',
                },
                {
                    data : 'klt',
                    name : 'klt',
                },
                {
                    data : 'total',
                    name : 'total',
                },
            ],
            order : [[0, 'asc']],
        });
    });
</script>

<!-- DOM Halaman Rekap ISO -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#iso-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/standar/iso')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nomor_standar',
                    name : 'nomor_standar',
                },
                {
                    data : 'sestama',
                    name : 'sestama',
                },
                {
                    data : 'pengembangan',
                    name : 'pengembangan',
                },
                {
                    data : 'penerapan',
                    name : 'penerapan',
                },
                {
                    data : 'akreditasi',
                    name : 'akreditasi',
                },
                {
                    data : 'snsu',
                    name : 'snsu',
                },
                {
                    data : 'klt',
                    name : 'klt',
                },
                {
                    data : 'total',
                    name : 'total',
                },
            ],
            order : [[0, 'asc']],
        });
    });
</script>

<!-- DOM Halaman Rekap Lainnya -->
<script type="text/javascript">
$(document).ready(function(){
        $('#lainnya-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/standar/lainnya')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nomor_standar',
                    name : 'nomor_standar',
                },
                {
                    data : 'sestama',
                    name : 'sestama',
                },
                {
                    data : 'pengembangan',
                    name : 'pengembangan',
                },
                {
                    data : 'penerapan',
                    name : 'penerapan',
                },
                {
                    data : 'akreditasi',
                    name : 'akreditasi',
                },
                {
                    data : 'snsu',
                    name : 'snsu',
                },
                {
                    data : 'klt',
                    name : 'klt',
                },
                {
                    data : 'total',
                    name : 'total',
                },
            ],
            order : [[0, 'asc']],
        });
    });
</script>

<!-- DOM Halaman Sestama -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#sestama-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/unit-kerja/sestama')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nama',
                    name : 'nama',
                },
                {
                    data : 'singkatan',
                    name : 'singkatan',
                },
                {
                    data : 'permintaan',
                    name : 'permintaan',
                },
                {
                    data : 'created_at',
                    name : 'created_at',
                },
                {
                    data : 'updated_at',
                    name : 'updated_at',
                },
                {
                    data : 'status',
                    name : 'status',
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="label label-warning">Dalam Proses</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="label label-success">Sudah Terkirim</span>';
                        }
                        else {
                            return row.status = '<span class="label label-danger">Gagal Proses</span>';
                        }
                    }
                },
            ],
            order : [[3, 'desc']],
        });
    });
</script>

<!-- DOM Halaman Pengembangan -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#pengembangan-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/unit-kerja/pengembangan')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nama',
                    name : 'nama',
                },
                {
                    data : 'singkatan',
                    name : 'singkatan',
                },
                {
                    data : 'permintaan',
                    name : 'permintaan',
                },
                {
                    data : 'created_at',
                    name : 'created_at',
                },
                {
                    data : 'updated_at',
                    name : 'updated_at',
                },
                {
                    data : 'status',
                    name : 'status',
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="label label-warning">Dalam Proses</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="label label-success">Sudah Terkirim</span>';
                        }
                        else {
                            return row.status = '<span class="label label-danger">Gagal Proses</span>';
                        }
                    }
                },
            ],
            order : [[3, 'desc']],
        });
    });
</script>

<!-- DOM Halaman Penerapan -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#penerapan-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/unit-kerja/penerapan')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nama',
                    name : 'nama',
                },
                {
                    data : 'singkatan',
                    name : 'singkatan',
                },
                {
                    data : 'permintaan',
                    name : 'permintaan',
                },
                {
                    data : 'created_at',
                    name : 'created_at',
                },
                {
                    data : 'updated_at',
                    name : 'updated_at',
                },
                {
                    data : 'status',
                    name : 'status',
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="label label-warning">Dalam Proses</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="label label-success">Sudah Terkirim</span>';
                        }
                        else {
                            return row.status = '<span class="label label-danger">Gagal Proses</span>';
                        }
                    }
                },
            ],
            order : [[3, 'desc']],
        });
    });
</script>

<!-- DOM Halaman Akreditasi -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#akreditasi-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/unit-kerja/akreditasi')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nama',
                    name : 'nama',
                },
                {
                    data : 'singkatan',
                    name : 'singkatan',
                },
                {
                    data : 'permintaan',
                    name : 'permintaan',
                },
                {
                    data : 'created_at',
                    name : 'created_at',
                },
                {
                    data : 'updated_at',
                    name : 'updated_at',
                },
                {
                    data : 'status',
                    name : 'status',
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="label label-warning">Dalam Proses</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="label label-success">Sudah Terkirim</span>';
                        }
                        else {
                            return row.status = '<span class="label label-danger">Gagal Proses</span>';
                        }
                    }
                },
            ],
            order : [[3, 'desc']],
        });
    });
</script>

<!-- DOM Halaman SNSU -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#snsu-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/unit-kerja/snsu')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nama',
                    name : 'nama',
                },
                {
                    data : 'singkatan',
                    name : 'singkatan',
                },
                {
                    data : 'permintaan',
                    name : 'permintaan',
                },
                {
                    data : 'created_at',
                    name : 'created_at',
                },
                {
                    data : 'updated_at',
                    name : 'updated_at',
                },
                {
                    data : 'status',
                    name : 'status',
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="label label-warning">Dalam Proses</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="label label-success">Sudah Terkirim</span>';
                        }
                        else {
                            return row.status = '<span class="label label-danger">Gagal Proses</span>';
                        }
                    }
                },
            ],
            order : [[3, 'desc']],
        });
    });
</script>

<!-- DOM Halaman KLT -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#klt-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/unit-kerja/klt')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nama',
                    name : 'nama',
                },
                {
                    data : 'singkatan',
                    name : 'singkatan',
                },
                {
                    data : 'permintaan',
                    name : 'permintaan',
                },
                {
                    data : 'created_at',
                    name : 'created_at',
                },
                {
                    data : 'updated_at',
                    name : 'updated_at',
                },
                {
                    data : 'status',
                    name : 'status',
                    render : function(data, type, row) {
                        if(row.status == 0) {
                            return row.status = '<span class="label label-warning">Dalam Proses</span>';
                        }
                        else if(row.status == 1) {
                            return row.status = '<span class="label label-success">Sudah Terkirim</span>';
                        }
                        else {
                            return row.status = '<span class="label label-danger">Gagal Proses</span>';
                        }
                    }
                },
            ],
            order : [[3, 'desc']],
        });
    });
</script>

<!-- DOM Halaman Dokumen Standar yang Tidak Tersedia -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#dokumen-tidak-tersedia-dt').DataTable({
            language: {
                url: "/json/id.json"
            },
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{url('admin/dokumen-tidak-tersedia')}}",
                type : 'GET',
            },
            columns : [
                {
                    data : 'nomor_standar',
                    name : 'nomor_standar',
                },
                {
                    data : 'jenis_standar',
                    name : 'jenis_standar',
                },
                {
                    data : 'sestama',
                    name : 'sestama',
                },
                {
                    data : 'pengembangan',
                    name : 'pengembangan',
                },
                {
                    data : 'penerapan',
                    name : 'penerapan',
                },
                {
                    data : 'akreditasi',
                    name : 'akreditasi',
                },
                {
                    data : 'snsu',
                    name : 'snsu',
                },
                {
                    data : 'klt',
                    name : 'klt',
                },
                {
                    data : 'total',
                    name : 'total',
                },
            ],
            order : [[0, 'asc']],
        });
    });
</script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@yield('footer')
@include('sweetalert::alert')
</body>
</html>
