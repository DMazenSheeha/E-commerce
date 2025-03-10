@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('categories.update', $category->id)}}" id="form" method="post">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" name="name" value="{{is_null(old('name')) ? $category->name : old('name')}}">
        </div>
        <button type="submit" class="btn bg-teal form-control mt-3">Update</button>
    </form>
</div>
@endsection