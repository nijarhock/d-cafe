<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/jquery-ui/jquery-ui.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo url('/') ?>/assets/plugins/select2/css/select2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    /* Preview */
  .preview{
    height: 200px;
    border: 1px solid black;
    margin: 0 auto;
    background: white;
  }

  .preview img{
    display: none;
  }

  .ui-menu img{
    width:40px;
    height:40px;
  }
  .ui-menu li span{
    font-size:2em;
    padding:0 0 10px 10px;
    margin:0 0 10px 0 !important;
    white-space:nowrap;
  }

  .mailbox-attachment-icon.has-img>img {
    max-height: 148px !important;
  }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-primary">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ url('/') }}/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
            
          </a>
        </div>
        
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo url('/') ?>/dashboard" class="brand-link">
      <span class="brand-text font-weight-light">D` Cafe</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/dashboard" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Master Data</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->role == "admin")
              <li class="nav-item">
                <a href="<?php echo url('/') ?>/user/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="<?php echo url('/') ?>/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubah</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Auth::user()->role == "admin")
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Jenis Bayar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo url('/') ?>/jenis_byr/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo url('/') ?>/jenis_byr" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubah</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Konsumen
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Kategori
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/konsumen_kategori/create" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tambah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/konsumen_kategori" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ubah</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-box"></i>
                  <p>
                    Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/konsumen/create" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tambah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/konsumen" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ubah</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          @if(Auth::user()->role != "waiter")
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Meja
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo url('/') ?>/meja/create" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo url('/') ?>/meja" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubah</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menu
                
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Kategori
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/menu_kategori/create" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tambah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/menu_kategori" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ubah</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-box"></i>
                  <p>
                    Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/menu/create" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tambah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo url('/') ?>/menu" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ubah</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-header">Pesanan</li>
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/pesanan" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Buat Pesanan
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/pesanan/proses" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Pesanan Proses
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/pesanan/batal" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Batal Pesanan Kosong
                
              </p>
            </a>
          </li>
          <li class="nav-header">Laporan</li>
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/laporan/pesanan" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Pesanan / Tanggal
                
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/laporan/stok_min" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Stok Minimum
                
              </p>
            </a>
          </li>
          @if(Auth::user()->role != "waiter")
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/laporan/bayar" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Jenis Bayar / Tanggal
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/laporan/detail" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Detail / Tanggal
                
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == "admin")
          <li class="nav-header">Logs</li>
          <li class="nav-item">
            <a href="<?php echo url('/') ?>/logs" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Logs
                
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('layout.footer')
</div>
</body>
</html>
