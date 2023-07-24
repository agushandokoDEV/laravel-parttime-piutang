<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <link href="<?php echo e(asset('')); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('')); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('')); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('')); ?>css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php echo $__env->make('layouts.components.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php echo $__env->make('layouts.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $__env->yieldContent('title'); ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $__env->yieldContent('title'); ?></li>
            </ol>
          </div>
          <?php echo $__env->yieldContent('content'); ?>
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
  <?php echo $__env->yieldPushContent('modal'); ?>
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
  <script src="<?php echo e(asset('')); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo e(asset('')); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(asset('')); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo e(asset('')); ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo e(asset('')); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo e(asset('')); ?>js/ruang-admin.min.js"></script>
  <script src="<?php echo e(asset('js/notif.js')); ?>"></script>
  <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html><?php /**PATH D:\Workspace\Website\upwork\piutang\master\5\piutang-bpkd\resources\views/layouts/app.blade.php ENDPATH**/ ?>