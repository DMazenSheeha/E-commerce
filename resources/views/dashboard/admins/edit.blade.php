@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('admins.update', $admin->id)}}" method="post">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label>Admin name</label>
            <input type="text" class="form-control" name="name" value="{{is_null(old('name')) ? $admin->name : old('name')}}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{is_null(old('email')) ? $admin->email : old('email')}}">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn bg-teal form-control">Update</button>
    </form>
</div>
@endsection