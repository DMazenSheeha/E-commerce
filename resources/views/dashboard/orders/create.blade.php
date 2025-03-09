@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <input type="text" value="{{route('products.search',$categories[0]->id)}}" hidden id="url">
    <form action="{{route('orders.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Oredr Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach($categories as $cat)
                <option @selected(old("category")==$cat->id) value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="products" multiple id="products" class="form-control" style="height: 100px !important;">
                @if($categories[0]->products && $categories[0]->products->isNotEmpty())
                @foreach($categories[0]->products as $product)
                <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
                @else
                <option disabled>No products found for this category</option>
                @endif
            </select>
        </div>
        <div class="mb-3" id="products_display">
            Products :
        </div>
        <button type="submit" class="btn bg-teal form-control">Add</button>
    </form>
</div>
@endsection
@section("script")
<script>
    let productsSelectElement = document.getElementById("products");
    let productsDisplay = document.getElementById('products_display');
    const categoryId = document.getElementById("category_id");
    const token = document.getElementsByName("_token")[0].value
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
                productsSelectElement.innerHTML = '';
                if (data.products.length == 0) {
                    let newOptionElement = document.createElement("option");
                    newOptionElement.innerHTML = '<option>No products found for this category</option>';
                    newOptionElement.setAttribute('disabled', '');
                    productsSelectElement.appendChild(newOptionElement);
                } else {
                    data.products.forEach(product => {
                        let newOptionElement = document.createElement("option");
                        newOptionElement.value = product.id;
                        newOptionElement.textContent = product.name;
                        productsSelectElement.appendChild(newOptionElement)
                    })
                }
            })
    })
    productsSelectElement.addEventListener("change", (e) => {

    })
</script>
@endsection