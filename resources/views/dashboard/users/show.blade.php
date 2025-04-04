@extends("dashboard.layouts.app")
@section("content")
<div class="show-page">
    Username : {{$user->name}}
    <br>
    Email : {{$user->email}}
    <br>
    Orders : {{$ordersCount}}
</div>
@endsection