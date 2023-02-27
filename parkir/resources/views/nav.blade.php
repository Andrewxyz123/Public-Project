<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<nav class="menu-container">

    <!-- menu items -->
    <div class="menu">
        <ul>
            <li>
                <a href="/">
                    Sistem Parkir
                </a>
            </li>
        </ul>
        <ul>
            
            @if (!Auth::check())
                <li>
                    <a href="/login">
                        Login
                    </a>
                </li>
            @else
            <li>
                <a href="/logout" >Logout</a>
            </li>
            @endif

        </ul>
    </div>
    
</nav>

</div>