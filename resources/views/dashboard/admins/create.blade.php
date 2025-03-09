@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('admins.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Admin name</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn bg-teal form-control">Add</button>
    </form>
</div>
@endsection