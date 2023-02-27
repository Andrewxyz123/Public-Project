<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            .container{
                align-items: center;
                text-align: center;
            }
        </style>
    </head>
    <body class="antialiased">
        @include('nav')


        <h1>Login Page</h1>
        <form action="{{ route('login') }}" method="POST">

            @csrf
            <div class="container">
                <label>Email : </label>
                <input type="email" placeholder="Email" name="email" required>
                <br>
                <label>Password : </label>
                <input type="password" placeholder="Password" name="password" required>
                <br>
                <button class="btn btn-outline-dark" style="border-radius: 5px; font-size:50px;" type="submit">Login</button>
            </div>
    
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </body>
</html>
