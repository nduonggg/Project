@extends('front.layout.master')

@section('title', 'Shop')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    @include('front.shop.components.products-sidebar-filter')

                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <form action="">
                                    <div class="select-option">
                                        <select name="sort_by" class="sorting" onchange="this.form.submit();">
                                            <option {{request('sort_by') == 'latest' ? 'selected' : ''}} value="latest">Sorting Latest</option>
                                            <option {{request('sort_by') == 'oldest' ? 'selected' : ''}} value="oldest">Sorting Oldest</option>
                                            <option {{request('sort_by') == 'name-ascending' ? 'selected' : ''}} value="name-ascending">Sorting A-Z</option>
                                            <option {{request('sort_by') == 'name-descending' ? 'selected' : ''}} value="name-descending">Sorting Z-A</option>
                                            <option {{request('sort_by') == 'price-ascending' ? 'selected' : ''}} value="price-ascending">Price Ascending</option>
                                            <option {{request('sort_by') == 'price-descending' ? 'selected' : ''}} value="price-descending">Price Descending</option>
                                        </select>
                                        <select name="show" class="p-show" onchange="this.form.submit();">
                                            <option {{request('show') == '6' ? 'selected' : ''}} value="6">Show: 6</option>
                                            <option {{request('show') == '12' ? 'selected' : ''}} value="12">Show: 12</option>
                                        </select>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-sm-6">
                                    @include('front.components.product-item')
                                    {{-- <div class="product-item">
                                        <div class="pi-pic">
                                            <img src="front/img/products/{{$product->productImages[0]->path}}" alt="">

                                            @if($product->discount != null)
                                                <div class="sale pp-sale">Sale</div>
                                            @endif
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                            <ul>
                                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                                <li class="quick-view"><a href="shop/product/{{$product->id}}">+ Quick View</a></li>
                                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->tag}}</div>
                                            <a href="shop/product/{{$product->id}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                @if ($product->discount != 0 )
                                                    ${{$product->discount}} <span>{{$product->price}}</span>
                                                @else
                                                    ${{$product->price}}
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            @endforeach


                        </div>
                    </div>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection

