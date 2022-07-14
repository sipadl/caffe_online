<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/basic.min.css">
    <title>Admin Kafe</title>
  </head>
  <body>
      @php
          $x = Request::segment(1);
      @endphp
      <style>
          svg{
              display: none;
          }
          .text-white{
              text-decoration: none;
              font-size: 12px;
              font-family: sans-serif;
              color: whitesmoke;
          }
      </style>
      <div class="container">
          <nav class="navbar navbar-expand navbar-dark bg-dark d-flex justify-content-center" style="border-radius: 12px;">
              <div class="nav navbar-nav">
              <a class="nav-item nav-link  active" href="{{ route('admin') }}">Home</a>
              <a class="nav-item nav-link " href="{{ route('meja') }}">Meja</a>
              <a class="nav-item nav-link" href="/menu">Menu</a>
              <a class="nav-item nav-link" href="/order">Order</a>
            </div>
        </nav>
        <div class="d-flex">
            <div class="w-25">
                <ul class="list-group p-2 mt-3" style="border-radius: 12px;">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin') }}" class="text-body">Home</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('meja') }}" class="text-body">Meja</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('menus') }}" class="text-body">Menu</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('orders') }}" class="text-body">Order</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('logouts') }}" class="text-body">Keluar</a>
                    </li>
                </ul>
            </div>
            <div class="w-75">
                <div class="mt-3 p-2">
                    <div class="card" style="min-height: 10rem">

                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @yield('js')
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
