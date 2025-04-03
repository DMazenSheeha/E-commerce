@extends("front.layouts.app")
@section("content")

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset($product->image())}}" alt="Image">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->name}}</h3>
                <h3 class="font-weight-semi-bold mb-4">${{$product->price}}</h3>
                <p class="mb-4">{{Str::limit($product->desc, 200)}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" disabled class="form-control bg-secondary border-0 text-center" style="height: 100%;" value="{{$productCart ? $productCart->quantity : 1}}" id="item-count">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <form action="{{route('cart.update')}}" class="mb-0" id="edit-cart">
                    @csrf
                    <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{$product->desc}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach($product->category->products as $catProduct)
                @if($catProduct->id != $product->id)
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{$catProduct->image()}}" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{route('shop.show', $catProduct->id)}}"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="{{route('shop.show', $catProduct->id)}}">{{$catProduct->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${{$catProduct->price}}</h5>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

@endsection
@section("script")
<script>
    const editCartForm = document.getElementById("edit-cart");
    const url = editCartForm.action;
    const token = document.querySelector("[name='_token']").value;
    editCartForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const itemCount = document.getElementById('item-count').value;
        fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({
                    'product_id': "{{$product->id}}",
                    'action': 'payload',
                    'payload': +itemCount
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data['success']) {
                    location.reload();
                } else {
                    toastify().error('Something wrong');
                }
            })
    })
</script>
@endsection