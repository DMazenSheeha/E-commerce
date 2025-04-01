@extends("dashboard.layouts.app")
@section("content")
<div class="show-page">
    Username : <span style="text-decoration: underline;">{{$user->name}}</span>
    <br>
    Email : <span style="text-decoration: underline;">{{$user->email}}</span>
    <br>
    Orders : <span style="text-decoration: underline;">{{$ordersCount}}</span>
</div>
@endsection