@extends('layouts.base')

@section('title')
    Welcome!
@endsection

@section('content')

   @include('includes.message')



    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div class="well">
                <form action="{{ route('signup') }}" method="post">
                    <h3>Sign up</h3>
                    <div class="form-group {{ $errors->has('firstName') ? 'has-error' : ''}}">
                        <label for="firstName">First Name</label>
                        <input class="form-control" type="text" name="firstName" id="firstName" value="{{ Request::old('firstName') }}">
                    </div>
                    <div class="form-group {{ $errors->has('lastName') ? 'has-error' : ''}}">
                        <label for="lastName">Last Name</label>
                        <input class="form-control" type="text" name="lastName" id="lastName" value="{{ Request::old('lastName') }}">
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>


        <div class="col-md-4 col-md-offset-2">
            <div class="well">
                <form action="{{ route('login') }}" method="post">
                    <h3>Log in</h3>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>

@endsection