<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

            <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
              <script src="https://use.fontawesome.com/14f1f2c704.js"></script>



        <title>Venue Hunter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #1F2124;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div>
                    @if (Auth::check())
                        <a href="{{ url('/places/input') }}"></a>
                        <div class="jumbotron vertical-center">
                            <div class="inner-jumbo">
                              <h1 class="display-3">VENUE HUNTER</h1>
                              <p class="lead">Give us a city. We'll give you numbers to start calling.</p>
                              <p style="text-align:center" class="play">
                                <a href="{{ url('/places/input') }}" role="button">
                                <i style="color:#383A3F" class="fa fa-play" aria-hidden="true"></i>
                                Let's Go</a>
                              </p>
                            </div>
                        </div>
                         @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
            
        </div>
    </body>
</html>
