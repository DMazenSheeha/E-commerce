@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('categories.update', $category->id)}}" id="form" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group mb-3">
            <label>Category Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" name="name" value="{{is_null(old('name')) ? $category->name : old('name')}}">
        </div>
        <button type="submit" class="btn bg-teal form-control mt-3">Update</button>
    </form>
</div>
@endsection