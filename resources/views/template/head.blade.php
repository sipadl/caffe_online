
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>&mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ @asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ @asset('assets/css/components.css') }}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
</head>
    @php
    $x = Request::segment(1);
    $p = Request::segment(2);
    $d = Request::segment(3);
    @endphp
  {{-- @yield('style') --}}
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        {{-- <a href="index.html" class="navbar-brand sidebar-gone-hide">Stisla</a> --}}
        {{-- <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a> --}}
        <div class="nav-collapse">
            @if($d == null && $p == null )
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="{{ url("/menu/".$p) }}">
            {{-- <i class="fas fa-ellipsis-v"></i> Logo --}}
            Logos
          </a>
          @else
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="{{ url("/menu/".$d) }}">
            {{-- <i class="fas fa-ellipsis-v"></i> Logo --}}
            Menu
          </a>
          @endif
          {{-- <ul class="navbar-nav">
            <li class="nav-item active"><a href="#" class="nav-link">Application</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Report Something</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Server Status</a></li>
          </ul> --}}
        </div>
        <div class="form-inline ml-auto">
            <ul class="navbar-nav">
                @if($x == 'menu')
                <li><a href="{{ route('li-cart',[$p])}}" data-toggle="search" class=" d-sm-none btn text-light bg-primary"><i class="fas  fa-shopping-cart"></i> Proses : <span id="qtyx">0 Items</span> </a></li>
                @endif
            </ul>
        </div>
      </nav>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>@yield('title')</h1>
          </div>
        </section>
      </div>
