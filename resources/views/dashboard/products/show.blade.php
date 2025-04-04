@extends("dashboard.layouts.app")
@section("content")
<div class="show-page p-3 product">
    <img src="{{$product->image()}}" alt="">
    Product Name : {{$product->name}}
    <br>
    Product Price : ${{$product->price}}
    <br>
    Product Description : <p style="font-size: 14px; margin-top: -20px;">{{$product->desc}}</p>
    </br>
</div>
@endsection