<!-- resources/views/emails/verification.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h1>Email Verification</h1>
    <p>Dear {{ $user->name }},</p>
    <p>Click the following link to verify your email:</p>
    <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
    <p>If you didn't register on our site, you can safely ignore this email.</p>
</body>
</html>
