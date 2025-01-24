<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Register</title>
</head>
<body>
    <div style="border: 3px solid black;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            @error('name')
                <div class="">{{ $message }}</div>
            @enderror
            <input name="email" type="text" placeholder="email">
            @error('email')
                <div class="">{{ $message }}</div>
            @enderror
            <input name="password" type="password" placeholder="password">
            @error('password')
                <div class="">{{ $message }}</div>
            @enderror
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        

        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            @error('loginname')
                <div class="">{{ $message }}</div>
            @enderror
            <input name="loginpassword" type="password" placeholder="password">
            @error('loginpassword')
                <div class="">{{ $message }}</div>
            @enderror
            <button>Log in</button>
            @if (Session::has('error'))
                <div class="">{{ Session::get('error') }}</div>
            @endif
        </form>
    </div>
</body>
</html>