<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Client</title>
       
    </head>
    <body style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <a href="{{ route('prepare.login') }}" target="_blank" style="border: 2px solid lightgray; padding: 10px 10px;">Login with ...</a>
    </body>
</html>
