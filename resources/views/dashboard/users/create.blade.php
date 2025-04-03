@extends("dashboard.layouts.app")
@section("content")
<div class="card-body">
    <form action="{{route('users.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label class="mt-3">Username</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label class="mt-3">Email</label>
            <input type="email" class="form-control" name="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label class="mt-3">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label class="mt-3">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn bg-teal form-control mt-3">Add</button>
    </form>
</div>
@endsection