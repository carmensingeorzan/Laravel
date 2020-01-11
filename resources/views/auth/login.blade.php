@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <?php
                                if (@$_GET['email'] && !old('email')) {
                                    ?>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $_GET['email'] }}" autofocus>
                                <?php } else { ?>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                                    <?php
                                }
                                ?>

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
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <?php
                        if (@$_GET['email'] || old('email')) {
                            if (old('email')) {
                                $user = App\User::where('email', old('email'))->first();
                            } else {
                                $user = App\User::where('email', $_GET['email'])->first();
                            }
                            if ($user && !$user->confirmed_email) {
                                ?>
                                <div class="has-error">
                                    <span class="help-block">
                                        <strong>This email address is not verified. Click <a href='<?php echo url("/confirmEmail/{$user->email}"); ?>'>here</a> to resend the activation email</strong>
                                    </span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
