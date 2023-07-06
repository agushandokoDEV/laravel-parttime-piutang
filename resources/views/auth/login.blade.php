<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Piutang</title>
  <link href="{{asset('')}}vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('')}}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
  <section class="vh-100" style="background-color: #ebebec;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-header">
            <center>
                <img src="{{asset('img/logo/dki.png')}}" class="mt-3" width="80" alt="">
            </center>
          </div>
          <div class="card-body p-5">
            {{-- <h3 class="mb-5 text-center">E-Piutang</h3> --}}
            @if (session()->has('suc'))
                <div class="alert alert-info">
                    <b>{{session()->get('suc')}}</b>
                </div>
            @endif
            <form action="{{route('cek.login')}}" method="POST">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="typeEmailX-2">Email</label>
                    <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control form-control-lg @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="typePasswordX-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" />
                    @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            </form>
          </div>
          <p class="text-center">Copyrigth &copy; {{date('Y')}} Piutang</p>
        </div>
      </div>
    </div>
  </div>
</section>
  <script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>