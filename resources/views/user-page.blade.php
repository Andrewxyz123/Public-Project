<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/user-page.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        @include('nav')

    @if(Auth::user()->role == 1)
        <h1>User Page</h1>

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        <form action="{{ route('check-in') }}" method="POST">

            @csrf
            <div class="container1">
                <label>Plate Number : </label>
                <input type="text" placeholder="Plate" name="plate" required>
                <br>
            <button style="border-radius: 5px" type="submit" class="btn btn-outline-primary">Check-in</button>
        </div>
        </form>

        @if (session('code'))
            <div class="alert alert-success">
                Unique Code : {{ session('code') }}
            </div>
        @endif


        <form action="{{ route('check-out') }}" method="POST">

            @csrf
            <div class="container1">
                <label>Unique Code : </label>
                <input type="text" placeholder="Code" name="code" required>
                <br>
            <button style="border-radius: 5px" type="submit" class="btn btn-outline-primary">Check-out</button>
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

        @if (session('time'))
            <div class="alert alert-success">
                Total Price : {{ session('time') }}
            </div>
        @endif

    @endif


    {{-- Admin --}}
    @if(Auth::user()->role == 2)

    <form action="{{ route('date-filter') }}" method="POST">
        
        @csrf
        <div class="admin-choice">
            <label for="start_date">Start date:</label>
            <br>
            <input type="date" id="start_date" name="start_date">
        </div>
        <br>
        <div class="admin-choice">
            <label for="end_date">End Date:</label>
            <br>
            <input type="date" id="end_date" name="end_date">
        </div>

        <div class="admin-choice">
            <button style="border-radius: 5px margin:20px;" type="submit">Filter</button>
        </div>
        </form>

        @if (!is_null($getAllUser))
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Park In</th>
                    <th scope="col">Park Out</th>
                    <th scope="col">Code</th>
                    <th scope="col">Plate Number</th>
                    <th scope="col">Price</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach($getAllUser as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->park_in}}</td>
                        <td>{{$user->park_out}}</td>
                        <td>{{$user->code}}</td>
                        <td>{{$user->plate_number}}</td>
                        <td>{{$user->price}}</td>
                    </tr>
                    @endforeach
                </tbody>

                <a href="{{route('export-parking')}}" class="btn btn-success" style="margin: 20px">Export</a>
        @endif
    @endif
    <div class="logout">
        <button style="btn btn-outline-primary">
            <a href="/logout" >Logout</a>
        </button>
    </div>
    </body>
</html>
