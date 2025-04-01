@extends("dashboard.layouts.app")
@section("content")
<div class="show-page">
    User : <span style="text-decoration: underline;">{{$order->user->name}}</span>
    <br>
    Total Price : <span style="text-decoration: underline;">${{$totalPrice}}</span>
    <br>
    Products :
    @foreach($order->products as $product)
    <span style="text-decoration: underline;">{{$product->name}}</span> @if($order->products[count($order->products) -1 ] != $product),@endif
    @endforeach
</div>
@endsection