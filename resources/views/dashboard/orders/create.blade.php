@extends("dashboard.layouts.app")
@section("content")
<div class="card-body">
    <input type="text" value="{{route('products.search', $categories[0]->id)}}" hidden id="url">
    <form action="{{route('orders.store')}}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label>Phone Number</label>
            <input type="text" name="user_mobile_number" class="form-control" value="{{old('user_mobile_number')}}">
        </div>
        <div class="form-group mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{old('city')}}">
        </div>
        <div class="form-group mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{old('address')}}">
        </div>
        <div class="form-group mb-3 col-12 row">
            <div class="col-9">
                <label>Products</label>
                <select name="products[]" multiple id="products" class="form-control" style="height: 100px !important;">
                    @if($products->isNotEmpty())
                    @foreach($products as $product)
                    <option value="{{$product->id}}" @selected(!is_null(old('products')) && in_array($product->id, old('products')))>{{$product->name}}</option>
                    @endforeach
                    @else
                    <option disabled>No products found for this category</option>
                    @endif
                </select>
            </div>
            <div class="col-3">
                <label>Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="0">All</option>
                    @foreach($categories as $cat)
                    <option @selected(old("category")==$cat->id) value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>User</label>
            <select name="user_id" class="form-control">
                <option>Choose the user</option>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn bg-teal form-control mt-3">Add</button>
    </form>
</div>
@endsection

@section("script")
<script>
    let productsSelectElement = document.getElementById("products");
    const categoryId = document.getElementById("category_id");
    const token = document.getElementsByName("_token")[0].value;
    let url = document.getElementById("url").value.split("/").slice(0, -1).join('/');

    categoryId.addEventListener("change", (e) => {
        fetch(`${url}/${e.target.value}`, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                }
            }).then(res => res.json())
            .then(data => {
                Array.from(productsSelectElement.children).forEach(child => {
                    child.setAttribute('hidden', '');
                });

                if (data.products.length == 0) {
                    let newOptionElement = document.createElement("option");
                    newOptionElement.innerHTML = 'No products found for this category';
                    newOptionElement.setAttribute('disabled', '');
                    productsSelectElement.appendChild(newOptionElement);
                } else {
                    data.products.forEach(product => {
                        Array.from(productsSelectElement.children).forEach(child => {
                            if (+product.id === +child.value) {
                                child.removeAttribute('hidden');
                            }
                        });
                    });
                }
            });
    });
</script>
@endsection