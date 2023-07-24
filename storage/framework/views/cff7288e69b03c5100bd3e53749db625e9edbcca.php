<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="<?php echo e(asset('img/logo/dki.png')); ?>">
        </div>
        <div class="sidebar-brand-text mx-3">Piutang</div>
    </a>
    <hr class="sidebar-divider my-0">
    <?php if(Auth::user()->role == 'admin'): ?>
    <li class="nav-item <?php echo e(request()->is('admin/dashboard') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/dashboard')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    <li class="nav-item <?php echo e(request()->is('admin/usulan') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/usulan')); ?>">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Usulan</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('admin/berita-acara') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/berita-acara')); ?>">
            <i class="fas fa-fw fa-plus"></i>
            <span>Berita Acara</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('admin/usulan-knkpl') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/usulan-knkpl')); ?>">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Surat Usulan KNKPL</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('admin/balasan-knkpl') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/balasan-knkpl')); ?>">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Surat Balasan KNKPL</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('admin/keputusan') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/keputusan')); ?>">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Keputusan gubernur</span>
        </a>
    </li>
    
    <li class="nav-item <?php echo e(request()->is('admin/laporan') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/admin/laporan')); ?>">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan</span>
        </a>
    </li>
    <?php else: ?>
    <li class="nav-item <?php echo e(request()->is('nasabah/home') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/nasabah/home')); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    <li class="nav-item <?php echo e(request()->is('nasabah/usulan') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/nasabah/usulan')); ?>">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Tambah Data Usulan</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('nasabah/surat-bpkd') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/nasabah/surat-bpkd')); ?>">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Surat Ke BPKD</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('nasabah/status-usulan') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/nasabah/status-usulan')); ?>">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Status Usulan</span>
        </a>
    </li>
    <li class="nav-item <?php echo e(request()->is('nasabah/pembayaran') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/nasabah/pembayaran')); ?>">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Pembayaran</span>
        </a>
    </li>
    <?php endif; ?>
</ul><?php /**PATH D:\Workspace\Website\upwork\piutang\vinensia-piutang\resources\views/layouts/components/side.blade.php ENDPATH**/ ?>