<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ticketify</title>
    <!-- Import your custom CSS file here -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap CSS (if you're using Bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Additional CSS or other stylesheets -->
    <style>

    </style>
</head>
<body>

<div class="ticketnav">
    <div class="ticketnavleft">
        <img src="https://dylanovalentijn.nl/linktree/assets/DylanoValentijnbluegreenbg.png">
        <h1>Dylano Valentijn</h1>
    </div>
    <div class="ticketnavright">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mr-3">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
    </div>
</div>

<div class="">

</body>
</html>
