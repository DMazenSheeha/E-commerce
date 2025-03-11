@extends("front.layouts.app")
@include("inc.message")
@section("content")
<form action="{{route('logout')}}" method="post">
    @csrf
    <button>Logout</button>
</form>
@endsection