@extends("front.layouts.app")
@section("content")

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        @if(count($products) > 0)
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                    price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form id="sortProductsByPriceForm" action="{{route('shop.index')}}" method="get">
                    @foreach(request()->query() as $key => $value)
                    @if(!Str::startsWith($key,'price-option-'))
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                    @endforeach
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input name="price-option-1" type="checkbox" class="custom-control-input" id="price-all" value="all" @if(request()->query('price-option-1')) checked @endif>
                        <label class="custom-control-label" for="price-all">All Price</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input name="price-option-2" value="100" type="checkbox" class="custom-control-input" @if(request()->query('price-option-2')) checked @endif id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input name="price-option-3" value="200" type="checkbox" class="custom-control-input" id="price-2" @if(request()->query('price-option-3')) checked @endif>
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input name="price-option-4" value="300" type="checkbox" class="custom-control-input" id="price-3" @if(request()->query('price-option-4')) checked @endif>
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input name="price-option-5" value="400" type="checkbox" class="custom-control-input" id="price-4" @if(request()->query('price-option-5')) checked @endif>
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input name="price-option-6" value="500" type="checkbox" class="custom-control-input" id="price-5" @if(request()->query('price-option-6')) checked @endif>
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                    </div>
                </form>
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                    data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form action="{{route('shop.index')}}" method="get" class="dropdown-item mb-0">
                                        @foreach(request()->query() as $key => $value)
                                        @if($key !== 'sorting')
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                        @endforeach
                                        <input type="text" hidden value="latest" name="sorting">
                                        <button>Latest</button>
                                    </form>
                                    <form action="{{route('shop.index')}}" method="get" class="dropdown-item mb-0">
                                        @foreach(request()->query() as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach
                                        <input type="text" hidden value="best-selling" name="sorting">
                                        <button>Best selling</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{$product->image()}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('shop.show', $product->id)}}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h4 text-decoration-none text-truncate" href="{{route('shop.show', $product->id)}}">{{$product->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6 class="text-muted ml-2">${{$product->price}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-12">
                {{$products->links()}}
            </div>
        </div>
        <!-- Shop Product End -->
        @else
        <div class="w-100 d-flex align-items-center" style="height: 50dvh;">
            <h5 class="text-center w-100">No Products</h5>
        </div>
        @endif
    </div>
</div>
<!-- Shop End -->
@endsection
@section('script')
<script>
    document.getElementById("sortProductsByPriceForm").addEventListener('change', function() {
        this.submit();
    })
</script>
@endsection