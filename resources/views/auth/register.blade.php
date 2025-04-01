@include('inc.message')
@extends('auth.layouts.app')
@section('title') Register @endsection
@section("content")
<div class="col-md-7">
    <div id="loader" class="loader">
        <span class="spinner"></span>
    </div>
    <h3 class="mb-3">Register</h3>
    <form action="{{route('register')}}" method="post">
        @csrf
        <div class="form-group first">
            <label>Username</label>
            <input type="text" class="form-control" name="name" placeholder="Your Username" value="{{old('name')}}">
        </div>
        <div class="form-group last mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="your-email@gmail.com" value="{{old('email')}}">
        </div>
        <div class="form-group last mb-3">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Your Password">
        </div>
        <div class="form-group last mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Your Password Confirmation">
        </div>

        <input type="submit" value="Register" class="btn btn-block btn-primary">
        <div class="mx-auto" style="width: fit-content;">
            <a href="{{route('show.login')}}">Have an account ?</a>
        </div>
    </form>
</div>
@endsection