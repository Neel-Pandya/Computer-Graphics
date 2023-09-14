<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
</head>
<body>
    <h3>{{ $mailData['title'] }}</h3>
    <h3>{{ $mailData['body'] }}</h5>
    http://127.0.0.1:8000/guest_user/activate/{{ $mailData['email'] }}/{{ $mailData['token'] }}
</body>
</html>