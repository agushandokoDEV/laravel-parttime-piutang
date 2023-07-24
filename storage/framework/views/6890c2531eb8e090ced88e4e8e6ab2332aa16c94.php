<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <?php if(Auth::user()->role == 'nasabah'): ?>
        <li class="nav-item dropdown no-arrow mx-1" id="">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div id="countNotif"></div>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Pemberitahuan
                </h6>
                <div id="notif"></div>
                <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Pemberitahuan</a>
            </div>
        </li>
        <?php endif; ?>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="<?php echo e(asset('img/boy.png')); ?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo e(Auth::user()->name); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                    Reset Password
                </a>
                <div class="dropdown-divider"></div>
                <form action="<?php echo e(route('cek.logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="dropdown-item" href="javascript:void(0);" id="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav><?php /**PATH D:\Workspace\Website\upwork\piutang\vinensia-piutang\resources\views/layouts/components/nav.blade.php ENDPATH**/ ?>