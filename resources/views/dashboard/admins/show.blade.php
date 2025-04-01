@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="show-page">
    <div>
        Name : <span style="text-decoration: underline;">{{$admin->name}}</span>
    </div>
    <div>
        Email : <span style="text-decoration: underline;">{{$admin->email}}</span>
    </div>
</div>
@endsection