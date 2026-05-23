<!DOCTYPE html>
<html>
<head>
    <title>Admin Login OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-w-md mx-auto bg-white p-8 rounded shadow text-center">
        <h2>Sach Tak News Admin Login</h2>
        <p>Your one-time password (OTP) for admin login is:</p>
        <h1 style="font-size: 36px; letter-spacing: 4px; color: #dc2626;">{{ $otp }}</h1>
        <p>This code will expire in 5 minutes. Do not share it with anyone.</p>
    </div>
</body>
</html>
