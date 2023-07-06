<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link href="{{asset('')}}vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('')}}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('')}}vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('')}}css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  @stack('css')
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.components.side')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        @include('layouts.components.nav')
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
          </div>
          @yield('content')
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script>
                document.write(new Date().getFullYear());
              </script> - <b>Piutang</b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>
  @stack('modal')
  <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notifModalLabel"></h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <div id="pesan"></div>
          <hr>
        </div>
      </div>
    </div>
  </div>
  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('')}}vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{asset('')}}vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('')}}vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('')}}js/ruang-admin.min.js"></script>
  <script src="{{asset('js/notif.js')}}"></script>
  @stack('js')
</body>

</html>