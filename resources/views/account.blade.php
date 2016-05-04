@extends('layouts.base')

@section('title')
    Account
@endsection

@section('content')

    <section class="row new_post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account:</h3></header>
            <form action="{{ route( 'account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" class="form-control" id="firstName"
                           value="{{ $user->firstName }}">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" class="form-control" id="lastName" value="{{ $user->lastName }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>

    @if (Storage::disk('local')->has($user->firstName . '-' . $user->id . '.jpg'))
        <p>jezz</p>
        <section class="row new_post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('account.image', ['filename' => $user->firstName . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif
    <p>{{ Session::get('msg') }}</p>
@endsection