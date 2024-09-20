<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generated</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="password-container">
        <h1>Registration Successful</h1>
        <p>Your account has been created successfully.</p>
        <p><strong>Auto-Generated Password:</strong></p>
        <p class="generated-password">{{ $password }}</p>
        <p>Please copy and securely store this password. It has also been sent to your email.</p>
        <a href="{{ route('login') }}">Go to Login</a>
    </div>
</body>
</html>
