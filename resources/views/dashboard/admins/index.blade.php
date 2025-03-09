@extends("dashboard.layouts.app")
@include("inc.message")
@section("header-right-section")
<a href="{{route('admins.create')}}" class="btn bg-navy">Add New Admin</a>
@endsection
@section("content")
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Admin Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $admin)
        <tr class="align-middle">
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>
                <a href="{{route('admins.edit',$admin->id)}}" class="btn bg-teal">Edit</a>
            </td>
            <td>
                <form action="{{route('admins.destroy',$admin->id)}}" class="delete-form" method="post">
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
    {{$admins->links()}}
</div>
@endsection