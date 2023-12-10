<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>Posts</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href={{ route('posts.index') }}>CRUDPosts</a>
      <div class="col">
        <a class="btn btn-sm btn-success" href={{ route('posts.create') }}>Add Post</a>
      </div>
      <div class="justify-end">
        @if (Route::has('login'))
        <ul class="navbar-nav">
        @auth
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link">Log in</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a href="{{ route('register') }}" class="ml-4 nav-link">Register</a>
        </li>
        @endif
        @endauth
        @endif
      </ul>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
</html>