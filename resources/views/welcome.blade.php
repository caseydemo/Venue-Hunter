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
                                
                                @if (Auth::check())
                                    <a href="{{ url('/places/input') }}" role="button">
                                    <i style="color:#383A3F" class="fa fa-play" aria-hidden="true"></i>
                                Hey, {{\Auth::user()->name}}. Let's Go</a>
                               <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                <p>Not {{ Auth::user()->name }}?
                                
                                    <a action="{{ route('logout') }}" role="button" value="submit">logout</a>
                                    {{ csrf_field() }}
                                    </form>
                                  </p>
                                @else
                                Let's get to know each other first.
                                    <a href="{{ url('/login') }}">Login</a>
                                    <a href="{{ url('/register') }}">Register</a>
                                @endif
                                

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
