@extends("dashboard.layouts.app")
@section("header-right-section")
<a href="{{route('categories.create')}}" class="btn bg-navy">Add New Category</a>
@endsection
@section("content")
@if(count($categories) == 0)
<h5 style="position: absolute; left: 50%; top: 40%; tranform: transalte(-50%);">No Categories</h5>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Category Name</th>
            <th>Products</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr class="align-middle">
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td><a href="{{route('categories.products',$category->id)}}" class="btn bg-indigo">Products</a></td>
            <td><a href="{{route('categories.edit',$category->id)}}" class="btn bg-teal ">Edit</a></td>
            <td>
                <form action="{{route('categories.destroy',$category->id)}}" class="delete-form m-0" method="post">
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
    {{$categories->links()}}
</div>
@endif
@endsection