@extends('wayshop.layouts.master')

@section('main-content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop Detail</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ $data->name }}</a></li>
                    <li class="breadcrumb-item active">Shop Detail </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">

                        @foreach ($data->attributesImages as $key => $image)
                        <div class="carousel-item {{ ($key == 0)? 'active' : '' }}"> <img class="d-block w-100"
                                src="{{ URL::to('') }}/uploads/products/attributes/{{ $image->image }}"
                                alt="First slide" style="height: 460px;"> </div>
                        @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                    <ol class="carousel-indicators">
                        @foreach ($data->attributesImages as $key => $image)
                        <li data-target="#carousel-example-1" data-slide-to="{{ $key }}"
                            class="{{ ($key == 0)? 'active' : '' }}">
                            <img class="d-block w-100 img-fluid"
                                src="{{ URL::to('') }}/uploads/products/attributes/{{ $image->image }}"
                                style="height: 88px;" alt="" />
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <div class="single-product-details">
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <input type="hidden" name="product_name" value="{{ $data->name }}">
                        <input type="hidden" name="product_code" value="{{ $data->code }}">
                        <input type="hidden" name="product_color" value="{{ $data->color }}">
                        <input type="hidden" name="price" id="cart_price" value="">
                        <h2>{{ $data->name }}</h2>
                        <h5 id="pro_price"> ${{ $data->price }}</h5>
                        <p>
                            <h4>Short Description:</h4>
                            <p>{{ $data->description }}</p>
                            <ul>
                                <li>
                                    <div class="form-group size-st">
                                        <label class="size-label">Size</label>
                                        <select name="size" id="basic"
                                            class="selectpicker show-tick form-control isSize">
                                            <option value="">Size</option>
                                            @foreach ($data->attributes as $attr)
                                            <option value="{{ $data->id }}-{{ $attr->size }}">{{ $attr->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" name="quantity" value="0" min="0" max="20"
                                            type="number">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <button type="submit" class="btn hvr-hover text-white">Add to cart</button>
                                </div>
                            </div>

                            <div class="add-to-btn">
                                <div class="add-comp">
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                                </div>
                                <div class="share-bar">
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-facebook"
                                            aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus"
                                            aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-twitter"
                                            aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p"
                                            aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Featured Products</h1>
                </div>
                <div class="featured-products-box owl-carousel owl-theme">
                    @php
                    $featured_product = App\Models\Product::where('featured_product', 1)->latest()->get();
                    @endphp


                    @foreach($featured_product as $product)
                    <div class="item">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <img src="{{ URL::to('/') }}/uploads/products/{{ $product->image }}"
                                    style="width: 260px; height: 300px" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                    class="fas fa-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                    class="fas fa-sync-alt"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                    </ul>
                                    <a class="cart" href="{{ route('single.product', $product->slug) }}">Product
                                        Details</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{ $product->name }}</h4>
                                <h5> ${{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->

@include('wayshop.layouts.instagram')

@endsection