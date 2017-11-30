@extends('layouts.app')

@section('content')

<div class="flex-center position-ref full-height">
            <div class="jumbotron vertical-center">
                <h1 class="medium-title">VENUE HUNTER</h1>
                <h2 class="medium-title">Login</h2>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            
                        </div>

                        <div class="form-group">
                            
                                      <button type="submit" class="btn hvr-bounce-to-right">
                                    Login
                                </button>

                                <p><a href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a></p>
                            
                        </div>
                    </form>
                </div>
            </div>
@endsection
