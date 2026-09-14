<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Italiana&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
      body {
        background: linear-gradient(180deg, #F3E4DE 0%, #F8F0EC 100%);
        min-height: 100vh;
        margin: 0;
        font-family: 'Inter', sans-serif;
      }

      .container {
        padding-bottom: 2rem;
      }

      .alert-success {
        background: #F3E4DE !important;
        border-color: #E7C9BD !important;
        color: #4A2C38 !important;
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