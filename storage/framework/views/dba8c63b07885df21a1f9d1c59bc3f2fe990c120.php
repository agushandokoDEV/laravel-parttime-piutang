<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Piutang</title>
  <link href="<?php echo e(asset('')); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('')); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
  <section class="vh-100" style="background-color: #ebebec;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-header">
            <center>
                <img src="<?php echo e(asset('img/logo/dki.png')); ?>" class="mt-3" width="80" alt="">
            </center>
          </div>
          <div class="card-body p-5">
            
            <?php if(session()->has('suc')): ?>
                <div class="alert alert-info">
                    <b><?php echo e(session()->get('suc')); ?></b>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('cek.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-outline mb-4">
                    <label class="form-label" for="typeEmailX-2">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email" class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="typePasswordX-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            </form>
          </div>
          <p class="text-center">Copyrigth &copy; <?php echo e(date('Y')); ?> Piutang</p>
        </div>
      </div>
    </div>
  </div>
</section>
  <script src="<?php echo e(asset('')); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo e(asset('')); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\Workspace\Website\upwork\piutang\vinensia-piutang\resources\views/auth/login.blade.php ENDPATH**/ ?>