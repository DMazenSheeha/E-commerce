@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control" style="height: 100%;">
        </div>
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="name" value="{{is_null(old('name')) ? $product->name : old('name')}}">
        </div>
        <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" id="priceInput" name="price" value="{{is_null(old('price')) ? $product->price : old('price')}}">
        </div>
        <div class="form-group">
            <label>Categories</label>
            <select class="form-control" name="category_id" id="role">
                @foreach($categories as $cat)
                <option @selected(is_null(old('category') ) ? $product->category : old("category")==$cat->id) value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="message" name="desc" rows="4">{{is_null(old('desc')) ? $product->desc : old('desc')}}</textarea>
        </div>
        <button type="submit" class="btn bg-teal form-control">Update</button>
    </form>
</div>
@endsection
@section("script")
<script>
    const priceInput = document.getElementById("priceInput")
    priceInput.addEventListener("input", (e) => {
        e.target.value = isNaN(+e.target.value) ? 0 : e.target.value;
    })
</script>
@endsection