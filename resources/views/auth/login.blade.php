@include("inc.message")
@extends('auth.layouts.app')
@section('title') Login @endsection
@section("content")
<div class="col-md-7">
    <h3 class="mb-3">Login</h3>
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group last mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" value="{{old('email')}}">
        </div>
        <div class="form-group last mb-3">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Your Password">
        </div>

        <input type="submit" value="Log in" class="btn btn-block btn-primary">
        <div class="mx-auto" style="width: fit-content;">
            <a href="{{route('show.register')}}">Don't have an account ?</a>
        </div>
    </form>
</div>
@endsection