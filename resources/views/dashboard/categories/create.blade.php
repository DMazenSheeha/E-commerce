@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('categories.store')}}" id="form" method="post">
        @csrf
        <div class="form-group">
            <label>Category Image</label>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <button type="submit" class="btn bg-teal form-control mt-3">Add</button>
    </form>
</div>
@endsection