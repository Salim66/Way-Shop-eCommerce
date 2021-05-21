<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wayshop Success Account Activatd Mail</title>
</head>

<body>
    <p>
        Dear {{ $email_data['name'] }} <br>
        Your account has been created successfully.<br>
        Your acccount information has given below. <br>
        Your Name is : {{ $email_data['name'] }} <br>
        Your Eamil is : {{ $email_data['email'] }} <br>
    </p>
</body>

</html>