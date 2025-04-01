@extends("dashboard.layouts.app")
@section("content")
<div class="show-page p-3 product">

    <img src="{{$product->image()}}" alt="">
    <div>

        Product Name : <span style="text-decoration: underline;">{{$product->name}}</span>
    </div>
    <div>

        Product Price : <span style="text-decoration: underline;">${{$product->price}}</span>
    </div>
</div>
@endsection