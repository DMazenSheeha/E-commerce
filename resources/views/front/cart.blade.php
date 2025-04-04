@extends("front.layouts.app")
@section("content")

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        @if(count($cartItems) > 0)
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($cartItems as $item)
                    <tr>
                        <td class="align-middle img-container"><img src="{{$item->product->image()}}" alt="" class="cart-item-img"><span>{{$item->product->name}}</span></td>
                        <td class="align-middle">${{$item->product->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <form action="{{route('cart.update')}}" method="post" class="cartEditForm" id="dec-{{$item->product_id}}">
                                        @csrf
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </form>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" style="height: 100%;" value="{{$item->quantity}}" readonly id="{{$item->product_id}}">
                                <div class="input-group-btn">
                                    <form action="{{route('cart.update')}}" method="post" class="cartEditForm" id="inc-{{$item->product_id}}">
                                        @csrf
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">${{$item->product->price * $item->quantity}}</td>
                        <td class="align-middle">
                            <form action="{{route('cart.destroy', $item->product_id)}}" method="post" class="mb-0 deleteItemForm">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="total-price">${{$totalPrice}}</h5>
                    </div>
                    <a class="btn btn-block btn-primary font-weight-bold my-3 py-3" href="{{route('order.create')}}">Proceed To Checkout</a>
                </div>
            </div>
        </div>
        @else
        <div class="w-100 d-flex align-items-center" style="height: 50dvh;">
            <h5 class="text-center w-100">No Cart items</h5>
        </div>
        @endif
    </div>
</div>
<!-- Cart End -->

@endsection

@section("script")
<script>
    const cartEditForms = Array.from(document.getElementsByClassName('cartEditForm'));
    const token = document.querySelector('[name="_token"]').value;
    const deleteItemForms = Array.from(document.getElementsByClassName('deleteItemForm'));

    cartEditForms.forEach((form) => {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            const url = form.action;
            const action = form.id.split("-")[0];
            const productId = form.id.split("-").slice(-1)[0];
            fetch(url, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        'product_id': productId,
                        'action': action
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data['success']) {
                        location.reload();
                    } else {
                        toastify().error('Something went wrong');
                    }
                })
                .catch(error => {
                    toastify().error('Failed to update cart');
                });
        });
    });

    deleteItemForms.forEach((form) => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const url = form.action;
            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                })
                .then(res => res.json())
                .then(data => {
                    if (data['success']) {
                        location.reload();
                    } else {
                        toastify().error('Something went wrong');
                    }
                })
        })
    })
</script>
@endsection