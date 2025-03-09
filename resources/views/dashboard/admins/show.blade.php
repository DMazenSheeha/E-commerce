@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div>
    <div>
        Name : {{$admin->name}}
    </div>
    <div>
        Email : {{$admin->email}}
    </div>
</div>
@endsection