<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Email Address</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verify Your Email Address</h2>
        
        <p>Hello {{ $user->name }},</p>
        
        <p>Thank you for registering. Please click the button below to verify your email address:</p>
        
        <div style="margin: 30px 0;">
            <a href="{{ $verificationUrl }}" 
               style="background-color: #0d6efd; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Verify Email Address
            </a>
        </div>
        
        <p>If you did not create an account, no further action is required.</p>
        
        <p>Thank you,<br>{{ config('app.name') }}</p>
        
        <hr>
        <p style="color: #666; font-size: 12px;">
            If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
            <br>{{ $verificationUrl }}
        </p>
    </div>
</body>
</html>