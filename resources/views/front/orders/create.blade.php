@extends("front.layouts.app")
@section("content")
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        @if(count($cartItems) > 0)
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                    Address</span></h5>
            <form class="bg-light p-30 mb-5" action="{{route('order.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="Menoufia" name="city" value="{{old('city')}}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" placeholder="Elsalam street" name="address" value="{{old('address')}}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" type="text" placeholder="+123 456 789" name="user_mobile_number" value="{{old('user_mobile_number')}}">
                    </div>
                    <div class="col-md-12 form-group">
                        <button class="btn form-control bg-primary">Order</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                    Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between">
                        <p>{{$item->product->name}} x {{$item->quantity}}</p>
                        <p>${{$item->product->price}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>${{$totalPrice}}</h5>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div style="height: 50dvh;" class="d-flex align-items-center w-100">
            <h5 class="text-center w-100">No Products In Cart</h5>
        </div>
        @endif
    </div>
</div>
<!-- Checkout End -->
@endsection