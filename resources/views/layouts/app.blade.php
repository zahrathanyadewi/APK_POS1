<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      body {
        background: linear-gradient(160deg, #EAF3EF 0%, #DCEAE6 100%);
        min-height: 100vh;
        margin: 0;
      }

      .container {
        padding-bottom: 2rem;
      }

      .alert-success {
        background: #E4F0EC !important;
        border-color: #BFD9D1 !important;
        color: #22423A !important;
        border-radius: 8px;
      }
    </style>
</head>
<body>
    <div class="container">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        @yield('content')
    </div>
</body>
</html>