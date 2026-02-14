<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { margin: 0; padding: 20px; font-family: sans-serif; background: #f5f5f5; }
        .login-box { max-width: 300px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #555; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; }
        input:focus { outline: none; border-color: #007bff; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .links { text-align: center; margin-top: 15px; font-size: 14px; }
        a { color: #007bff; text-decoration: none; }

        .blink-red {
            color: red;
            font-weight: bold;
            animation: blink 0.8s infinite;
        }
        @keyframes blink { 50% { opacity: 0; } }

    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="{{route('checkAuth')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="links">
            @if(isset($error))
            <p class="blink-red">Check your login or pass</p>
            @endif
            <a href="/forgot">Forgot password?</a> | 
            <a href="/register">Sign up</a>
        </div>
    </div>
</body>
</html>
