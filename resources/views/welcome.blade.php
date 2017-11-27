
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Venue Hunter</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
         <!-- Fonts -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
        <script src="https://use.fontawesome.com/14f1f2c704.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

        <!-- local css -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/hover.css') }}" rel="stylesheet" media="all">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="display-3">VENUE HUNTER</h1>
                <p class="lead">Give us a city. We'll give you numbers to start calling.</p>
                @if (Route::has('login'))
                    @if (Auth::check())
                        <p style="text-align:center" class="play">
                            <a href="{{ url('/home') }}" class="hvr-pulse" role="button">
                            <i style="color:#383A3F" class="fa fa-play" ></i>
                                Hey, {{\Auth::user()->name}}. Let's Go
                            </a>
                        </p>
                        <p>Not {{ Auth::user()->name }}?
                            <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>                                
                         
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form> 
                        </p>

                       
                    @else
                        <p>Let's get to know each other first.
                                    <a href="{{ url('/login') }}">Login</a>
                                    <a href="{{ url('/register') }}">Register</a>
                        </p>
                    @endif
                @endif
            </div>
        </div>
    </body>
</html>
