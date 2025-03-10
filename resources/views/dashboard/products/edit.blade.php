@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form action="{{route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label class="mt-3">Product Image</label>
            <input type="file" name="image" class="form-control" value="{{old('image')}}">
        </div>
        <div class="form-group">
            <label class="mt-3">Product Name</label>
            <input type="text" class="form-control" name="name" value="{{is_null(old('name')) ? $product->name : old('name')}}">
        </div>
        <div class="form-group">
            <label class="mt-3">Product Price</label>
            <input type="text" class="form-control" id="priceInput" name="price" value="{{is_null(old('price')) ? $product->price : old('price')}}">
        </div>
        <div class="form-group">
            <label class="mt-3">Categories</label>
            <select class="form-control" name="category_id" id="role">
                @foreach($categories as $cat)
                <option @selected(is_null(old('category') ) ? $product->category : old("category")==$cat->id) value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="mt-3">Description</label>
            <textarea class="form-control" id="message" name="desc" rows="5">{{is_null(old('desc')) ? $product->desc : old('desc')}}</textarea>
        </div>
        <button type="submit" class="btn bg-teal form-control mt-3">Update</button>
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