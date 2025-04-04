@extends("front.layouts.app")
@section("content")

<div class="container-fluid">
    <div class="row px-xl-5">
        @if(count($orders) > 0)
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($orders as $order)
                    <tr>
                        <td class="align-middle">{{$order->created_at->format('Y-m-d')}}</td>
                        <td class="align-middle">${{$order->total_price}}</td>
                        <td class="align-middle">{{$order->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="w-100 d-flex align-items-center" style="height: 50dvh;">
            <h5 class="text-center w-100">No Orders</h5>
        </div>
        @endif
    </div>
</div>

@endsection