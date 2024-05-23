<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    @if(Auth::guard('web')->check())
    <h1>Welcome, {{ Auth::guard('web')->user()->NAMA }}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
        @else
            <p>Anda belum terautentikasi.</p>
        @endif
</body>
</html>
