<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>Screenshooter</title>
</head>

<header>
    <div class="flex justify-center mt-10">
        <a href="/screenshooter" class="font-mono underline underline-offset-4 decoration-2 decoration-wavy decoration-pink-500 mr-10">Screenshooter</a>
        <a href="/gallery" class="font-mono underline underline-offset-4 decoration-2 decoration-wavy decoration-pink-500 mr-10">Image gallery <span>&#8674;</span></a>
    </div>
</header>

<body class="bg-blue-200">
    {{ $slot }}
</body>
</html>