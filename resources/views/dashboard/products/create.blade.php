@extends("dashboard.layouts.app")
@include("inc.message")
@section("content")
<div class="card-body">
    <form class="form" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control" style="height: 100%;">
        </div>
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" name="price" id="priceInput" value="{{old('price')}}">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" id="role">
                @foreach($categories as $cat)
                <option @selected(old("category")==$cat->id) value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="message" name="desc" rows="4">{{old("desc")}}</textarea>
        </div>
        <button type="submit" class="btn bg-teal form-control">Add</button>
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