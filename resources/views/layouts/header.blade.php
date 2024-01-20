<!doctype html>
<html lang="en">

<head>
  @stack('title')
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="description" content="Hit-O-Meter is a Tools for Counting Profile/Page/Visitor View Count build using PHP (Laravel)">
  <meta name="keywords" content="Hit-O-Meter ,hitometer Tools, Profile View Count,Page View Count ,Visitor View Count">
  <meta name="author" content="Madhurya Dutta">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="1 days">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="stylesheet" href="https://asset.databytedigital.com/bootstrap/theme/superhero/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://asset.databytedigital.com/bootstrap/theme/superhero/css/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://asset.databytedigital.com/bootstrap/theme/superhero/css/prism-okaidia.css">
  <!-- <link rel="stylesheet" href="https://asset.databytedigital.com/bootstrap/theme/superhero/css/custom.min.css"> -->
  
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light " data-bs-theme="light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"> <b>Hit-O-Meter</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03"
        aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="/">Home
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          @guest
          <li class="nav-item">
            <a class="nav-link active" href="/login">Sign in/sign Up
            </a>
          </li>
          @endguest
          {{-- <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li> --}}
        </li>
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
              aria-expanded="false">Profile</a>
            <div class="dropdown-menu">
              {{-- <a class="dropdown-item" href="#">Another action</a> --}}
              <a class="dropdown-item" href="/logout">Log Out</a>
              {{-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div> --}}
          @endauth
        </ul>
        <!-- <form class="d-flex">
          <input class="form-control me-sm-2" type="search" placeholder="Search">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>