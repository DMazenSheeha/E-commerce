@extends('dashboard.layouts.app')
@section("content")
<div class="show-page">
    Category Image : {{$category->image() ? $category->image() : "Not Found"}}
    <br>
    Category name : {{$category->name}}
</div>
@endsection