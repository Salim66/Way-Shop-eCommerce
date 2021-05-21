<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wayshop Account Varification Mail</title>
</head>

<body>
    <p>
        Dear {{ $email_data['name'] }} <br>
        Please click the link below to activate your account! <br>
        <a href="{{ route('customer.email.confirm', $email_data['code']) }}" target="blank">Account Activate</a><br>
        Regards,<br>
        Wayshop Team
    </p>
</body>

</html>