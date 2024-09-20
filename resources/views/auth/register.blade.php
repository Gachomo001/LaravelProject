<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Personal Details -->
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="middle_name" placeholder="Middle Name">
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="date" name="dob" required>
    <select name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="email" name="email" placeholder="Email" required>

    <!-- File Uploads -->
    <input type="file" name="passport_photo" placeholder="passport_photo" required>
    <input type="file" name="id_front" placeholder="id_front" required>
    <input type="file" name="id_back" placeholder="id_back" required>

    <!-- User Role Selection -->
    <label for="user_role">Role:</label>
    <select name="user_role" id="user_role" required>
        <option value="user">User</option>
        <option value="staff">Staff</option>
    </select>
    
    <!-- Password -->
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Register</button>
</form>
</body>
</html>

