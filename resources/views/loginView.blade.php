<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <title>Login</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="../assets/css/sign-in.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
    <main class="form-signin w-100 m-auto">
      <div class="mb-4">

      @if(session('massage'))
      <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <div class="alert alert-success">{{ session('massage') }}</div>
      </div>
      @endif

        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
        {{ session('loginError') }}
        @endif
        </div>
      </div>
      <br>

      <img class="mb-4" src="{{asset('assets/images/logo-balimed.png')}}" alt=""><br><br>
      <h1 class="h3 mb-3 fw-normal" style="font-weight: bold;">Login</h1><br>

      <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf

        <div class="form-floating">
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Username" autofocus value="{{ old('name') }}">
          <label for="name">Username</label>
          @error('name')
            <div class="invalid-feedback d-block">
            <span>{{ $message }}</span>
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
          <label for="password">Password</label>
          @error('password')
            <div class="invalid-feedback d-block">
            <span>{{ $message }}</span>
            </div>
          @enderror
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      </form>
      <!-- <small>Belum Punya Akun? <a href="/register">Daftar Disini</a></small> -->
    </main>

  </body>
</html>

@include('templates.metascript')
@include('templates.script')
@stack('script')

<script>

  var timeout = 3000; // in miliseconds (3*1000)
  $('.alert').delay(timeout).fadeOut(300);

</script>

