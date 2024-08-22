<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Add your CSS here -->
</head>
<body>
    @guest
        <h1>Welcome to Our Application</h1>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @else
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <a href="{{ route('logout') }}">Logout</a>
    @endguest

    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
</body>
</html>
