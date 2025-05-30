@extends("dashboard.layouts.app")
@section("header-right-section")
<a href="{{route('products.create')}}" class="btn bg-navy">Add New Product</a>
@endsection
@section("content")
@if(count($products) == 0)
<h5 style="position: absolute; left: 50%; top: 40%; tranform: transalte(-50%);">No Products</h5>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th style=" width: 10px">#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Veiw</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="align-middle">
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->category->name}}</td>
            <td>{{\Str::limit($product->desc,50)}}</td>
            <td><a href="{{route('products.show', $product->id)}}" class="btn bg-indigo">View</a></td>
            <td><a href="{{route('products.edit',$product->id)}}" class="btn bg-teal">Edit</a></td>
            <td>
                <form action="{{route('products.destroy',$product->id)}}" method="post" class="delete-form m-0">
                    @csrf
                    @method('DELETE')
                    <button class="btn bg-maroon">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-links">
    {{$products->links()}}
</div>
@endif
@endsection