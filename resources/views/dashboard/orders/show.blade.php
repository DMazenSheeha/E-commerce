@extends("dashboard.layouts.app")
@section("content")
<div class="show-page">
    User : {{$order->user->name}}
    <br>
    Total Price : ${{$totalPrice}}
    <br>
    City : {{$order->city}}
    <br>
    Address : {{$order->address}}
    <br>
    Products :
    @foreach($order->products as $product)
    {{$product->name}} @if($order->products[count($order->products) -1 ] != $product),@endif
    @endforeach
</div>
@endsection