
@extends('adminlte::master')

@inject('layoutHelper', \JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper)

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())
    
@section('meta_tags')
    <?php include(app_path().'/Includes/meta_tags.php'); ?>
@stop

@section('adminlte_css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"></script>
<style>
    .card.maximized-card .card-body {
        overflow: scroll;
    }
    th {
        text-align: center;
    }
     .animated {
        animation-duration: 1s;
        animation-fill-mode: both;
     }

     @keyframes fadeInLeft {
        0% {
           opacity: 0;
           transform: translateX(-20px);
        }
        100% {
           opacity: 1;
           transform: translateX(0);
        }
     }

     @keyframes fadeInRight {
        0% {
           opacity: 0;
           transform: translateX(20px);
        }
        100% {
           opacity: 1;
           transform: translateX(0);
        }
     }

     .fadeInLeft {
     animation-name: fadeInLeft;
     } 
     .fadeInRight {
     animation-name: fadeInRight;
     }
    
    @keyframes fadeInUp {
        0% {
           opacity: 0;
           transform: translateY(20px);
        }
        100% {
           opacity: 1;
           transform: translateY(0);
        }
     }

     @keyframes fadeInDown {
        0% {
           opacity: 0;
           transform: translateY(-20px);
        }
        100% {
           opacity: 1;
           transform: translateY(0);
        }
     }

     .fadeInUp {
     animation-name: fadeInUp;
     } 
     .fadeInDown {
     animation-name: fadeInDown;
     }
  </style>
@stop

@section('body_data')
    hold-transition sidebar-mini layout-fixed 
@stop

@section('body')
    <div class="wrapper">
         <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/logout">Log Keluar</a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->
            <a href="#" class="brand-link"> 
              <img src="@yield('logo')" class="brand-image img-circle elevation-3"
                   style="opacity: .8">
              <span class="brand-text font-weight-light">eRisiko</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="@yield('userImg')" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block">@yield('userName')</a>
                </div>
              </div>

              <!-- Sidebar Menu -->
              @include('sidebar')
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
            
        <!--- CONTENT --->
        <div class="content-wrapper">
            <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>

    </div>
    <!-- ./wrapper -->
@stop

@yield('before_js')

@section('adminlte_js')
    <script>document.getElementById("@yield('sidebar_item')").classList.add("active");</script>
    <script>document.getElementById("@yield('sidebar_tree_item')").classList.add("menu-open");</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('script')
@stop
