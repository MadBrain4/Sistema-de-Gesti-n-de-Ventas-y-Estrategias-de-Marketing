<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Titulo</title>
</head>
<body>
    <h3>Recibiste un mensaje de: {{ $msg['name'] }} -- {{ $msg['email'] }}</h3>
    <p>{{ $msg['content'] }}</p>
</body>
</html>