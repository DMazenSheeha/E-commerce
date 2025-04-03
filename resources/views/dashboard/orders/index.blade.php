@extends("dashboard.layouts.app")
@section("header-right-section")
<a href="{{route('orders.create')}}" class="btn bg-navy">Add New Order</a>
@endsection
@section("content")
@if(count($orders) == 0)
<h5 style="position: absolute; left: 50%; top: 40%; tranform: transalte(-50%);">No Orders</h5>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>User</th>
            <th>Total Price</th>
            <th>Veiw</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr class="align-middle">
            <td>{{$order->id}}</td>
            <td>{{$order->user->name}}</td>
            <td>${{$order->products->sum('price')}}</td>
            <td><a href="{{route('orders.show', $order->id)}}" class="btn bg-indigo">View</a></td>
            <td><a href="{{route('orders.edit',$order->id)}}" class="btn bg-teal">Edit</a></td>
            <td>
                <form action="{{route('orders.destroy',$order->id)}}" class="delete-form m-0" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn bg-maroon">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{$orders->links()}}
</div>
@endif
@endsection