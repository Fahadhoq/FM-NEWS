<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail verification</title>
</head>
<body>
    <p>Dear {{ $user->full_name}}</p>
    <p>Your account has been created. Please click the following link to activate your account:</p>
    <a href="{{ route('RegistrationVerify', $user->email_verification_token) }}"> click {{ $user->email_verification_token }}</a>
</body>
</html>