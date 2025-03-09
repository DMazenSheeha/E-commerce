@extends("dashboard.layouts.app")
@include("inc.message")
@section("header-right-section")
<a href="{{route('users.create')}}" class="btn bg-navy">Add New User</a>
@endsection
@section("content")
@if(count($users) == 0)
<h5 style="position: absolute; left: 50%; top: 40%; tranform: transalte(-50%);">No Users</h5>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Orders</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="align-middle">
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td><a href="{{route('users.orders', $user->id)}}" class="btn bg-indigo">Orders</a></td>
            <td>
                <form action="{{route('users.destroy',$user->id)}}" class="delete-form" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn bg-maroon">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{$users->links()}}
</div>
@endif
@endsection