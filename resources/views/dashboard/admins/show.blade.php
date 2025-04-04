@extends("dashboard.layouts.app")
@section("content")
<div class="show-page">
    <div>
        Name : {{$admin->name}}
    </div>
    <div>
        Email : {{$admin->email}}
    </div>
</div>
@endsection