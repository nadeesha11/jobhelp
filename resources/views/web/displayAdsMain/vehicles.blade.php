@extends('web.layout.webLayout')
@section('content')
    <!--=====================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            AD LIST PART START
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                =======================================-->
    <section class="inner-section ad-list-part">
        <div class="container">
            <div class="row content-reverse">
                <div class="col-lg-4 col-xl-3">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by Price</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-group">
                                        <input type="text" placeholder="min - 00">
                                        <input type="text" placeholder="max - 1B">
                                    </div>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by type</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek1">
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span class="product-widget-type sale">sales</span>
                                                <span class="product-widget-number">(15)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek2">
                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span class="product-widget-type rent">rental</span>
                                                <span class="product-widget-number">(25)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek3">
                                            </div>
                                            <label class="product-widget-label" for="chcek3">
                                                <span class="product-widget-type booking">booking</span>
                                                <span class="product-widget-number">(35)</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-broom"></i>
                                        <span>Clear Filter</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by rating</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek4">
                                            </div>
                                            <label class="product-widget-label" for="chcek4">
                                                <span class="product-widget-star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                                <span class="product-widget-number">(45)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek5">
                                            </div>
                                            <label class="product-widget-label" for="chcek5">
                                                <span class="product-widget-star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </span>
                                                <span class="product-widget-number">(55)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek6">
                                            </div>
                                            <label class="product-widget-label" for="chcek6">
                                                <span class="product-widget-star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </span>
                                                <span class="product-widget-number">(65)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek7">
                                            </div>
                                            <label class="product-widget-label" for="chcek7">
                                                <span class="product-widget-star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </span>
                                                <span class="product-widget-number">(75)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek8">
                                            </div>
                                            <label class="product-widget-label" for="chcek8">
                                                <span class="product-widget-star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </span>
                                                <span class="product-widget-number">(85)</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-broom"></i>
                                        <span>Clear Filter</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by cities</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search">
                                        <input type="text" placeholder="Search">
                                    </div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek9">
                                            </div>
                                            <label class="product-widget-label" for="chcek9">
                                                <span class="product-widget-text">Los Angeles</span>
                                                <span class="product-widget-number">(95)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek10">
                                            </div>
                                            <label class="product-widget-label" for="chcek10">
                                                <span class="product-widget-text">San Francisco</span>
                                                <span class="product-widget-number">(82)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek11">
                                            </div>
                                            <label class="product-widget-label" for="chcek11">
                                                <span class="product-widget-text">California</span>
                                                <span class="product-widget-number">(1t)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek12">
                                            </div>
                                            <label class="product-widget-label" for="chcek12">
                                                <span class="product-widget-text">Manhattan</span>
                                                <span class="product-widget-number">(46)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek13">
                                            </div>
                                            <label class="product-widget-label" for="chcek13">
                                                <span class="product-widget-text">Baltimore</span>
                                                <span class="product-widget-number">(24)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek14">
                                            </div>
                                            <label class="product-widget-label" for="chcek14">
                                                <span class="product-widget-text">Avocados</span>
                                                <span class="product-widget-number">(34)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek15">
                                            </div>
                                            <label class="product-widget-label" for="chcek15">
                                                <span class="product-widget-text">new york</span>
                                                <span class="product-widget-number">(82)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek16">
                                            </div>
                                            <label class="product-widget-label" for="chcek16">
                                                <span class="product-widget-text">Houston</span>
                                                <span class="product-widget-number">(45)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek17">
                                            </div>
                                            <label class="product-widget-label" for="chcek17">
                                                <span class="product-widget-text">Chicago</span>
                                                <span class="product-widget-number">(19)</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-broom"></i>
                                        <span>Clear Filter</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by popularity</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search">
                                        <input type="text" placeholder="Search">
                                    </div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek9">
                                            </div>
                                            <label class="product-widget-label" for="chcek9">
                                                <span class="product-widget-text">laptop</span>
                                                <span class="product-widget-number">(68)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek10">
                                            </div>
                                            <label class="product-widget-label" for="chcek10">
                                                <span class="product-widget-text">camera</span>
                                                <span class="product-widget-number">(78)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek11">
                                            </div>
                                            <label class="product-widget-label" for="chcek11">
                                                <span class="product-widget-text">television</span>
                                                <span class="product-widget-number">(34)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek12">
                                            </div>
                                            <label class="product-widget-label" for="chcek12">
                                                <span class="product-widget-text">by cycle</span>
                                                <span class="product-widget-number">(43)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek13">
                                            </div>
                                            <label class="product-widget-label" for="chcek13">
                                                <span class="product-widget-text">bike</span>
                                                <span class="product-widget-number">(57)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek14">
                                            </div>
                                            <label class="product-widget-label" for="chcek14">
                                                <span class="product-widget-text">private car</span>
                                                <span class="product-widget-number">(67)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek15">
                                            </div>
                                            <label class="product-widget-label" for="chcek15">
                                                <span class="product-widget-text">air condition</span>
                                                <span class="product-widget-number">(98)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek16">
                                            </div>
                                            <label class="product-widget-label" for="chcek16">
                                                <span class="product-widget-text">apartment</span>
                                                <span class="product-widget-number">(45)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input type="checkbox" id="chcek17">
                                            </div>
                                            <label class="product-widget-label" for="chcek17">
                                                <span class="product-widget-text">watch</span>
                                                <span class="product-widget-number">(76)</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-broom"></i>
                                        <span>Clear Filter</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">filter by category</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search">
                                        <input type="text" placeholder="search">
                                    </div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                electronics (234)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">mixer (56)</a></li>
                                                <li><a href="#">freez (78)</a></li>
                                                <li><a href="#">LED tv (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                automobiles (767)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">private car (56)</a></li>
                                                <li><a href="#">motorbike (78)</a></li>
                                                <li><a href="#">truck (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                properties (456)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">free land (56)</a></li>
                                                <li><a href="#">apartment (78)</a></li>
                                                <li><a href="#">shop (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                fashion (356)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">jeans (56)</a></li>
                                                <li><a href="#">t-shirt (78)</a></li>
                                                <li><a href="#">jacket (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                gadgets (768)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">computer (56)</a></li>
                                                <li><a href="#">mobile (78)</a></li>
                                                <li><a href="#">drone (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                furnitures (977)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">chair (56)</a></li>
                                                <li><a href="#">sofa (78)</a></li>
                                                <li><a href="#">table (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                hospitality (124)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">jeans (56)</a></li>
                                                <li><a href="#">t-shirt (78)</a></li>
                                                <li><a href="#">jacket (78)</a></li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fas fa-tags"></i>
                                                agriculture (565)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li><a href="#">jeans (56)</a></li>
                                                <li><a href="#">t-shirt (78)</a></li>
                                                <li><a href="#">jacket (78)</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-broom"></i>
                                        <span>Clear Filter</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-filter">
                                <div class="filter-show">
                                    <label class="filter-label">Show :</label>
                                    <select class="custom-select filter-select">
                                        <option value="1">12</option>
                                        <option value="2">24</option>
                                        <option value="3">36</option>
                                    </select>
                                </div>
                                <div class="filter-short">
                                    <label class="filter-label">Short by :</label>
                                    <select class="custom-select filter-select">
                                        <option selected>default</option>
                                        <option value="3">trending</option>
                                        <option value="1">featured</option>
                                        <option value="2">recommend</option>
                                    </select>
                                </div>
                                <div class="filter-action">
                                    <a href="ad-column3.html" title="Three Column"><i class="fas fa-th"></i></a>
                                    <a href="ad-column2.html" title="Two Column"><i class="fas fa-th-large"></i></a>
                                    <a href="ad-column1.html" title="One Column" class="active"><i
                                            class="fas fa-th-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ad-feature-slider slider-arrow">
                                <div class="feature-card">
                                    <a href="#" class="feature-img">
                                        <img src="{{ asset('images/product/10.jpg') }}" alt="feature">
                                    </a>
                                    <div class="cross-inline-badge feature-badge">
                                        <span>featured</span>
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <button type="button" class="feature-wish">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <div class="feature-content">
                                        <ol class="breadcrumb feature-category">
                                            <li><span class="flat-badge rent">rent</span></li>
                                            <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">private car</li>
                                        </ol>
                                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                                nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                        <div class="feature-meta">
                                            <span class="feature-price">$1200<small>/Monthly</small></span>
                                            <span class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-card">
                                    <a href="#" class="feature-img">
                                        <img src="{{ asset('images/product/01.jpg') }}" alt="feature">
                                    </a>
                                    <div class="cross-inline-badge feature-badge">
                                        <span>featured</span>
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <button type="button" class="feature-wish">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <div class="feature-content">
                                        <ol class="breadcrumb feature-category">
                                            <li><span class="flat-badge booking">booking</span></li>
                                            <li class="breadcrumb-item"><a href="#">Property</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">House</li>
                                        </ol>
                                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                                nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                        <div class="feature-meta">
                                            <span class="feature-price">$800<small>/perday</small></span>
                                            <span class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-card">
                                    <a href="#" class="feature-img">
                                        <img src="{{ asset('images/product/08.jpg') }}" alt="feature">
                                    </a>
                                    <div class="cross-inline-badge feature-badge">
                                        <span>featured</span>
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <button type="button" class="feature-wish">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <div class="feature-content">
                                        <ol class="breadcrumb feature-category">
                                            <li><span class="flat-badge sale">sale</span></li>
                                            <li class="breadcrumb-item"><a href="#">gadget</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">iphone</li>
                                        </ol>
                                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                                nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                        <div class="feature-meta">
                                            <span class="feature-price">$1150<small>/Negotiable</small></span>
                                            <span class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-card">
                                    <a href="#" class="feature-img">
                                        <img src="{{ asset('images/product/06.jpg') }}" alt="feature">
                                    </a>
                                    <div class="cross-inline-badge feature-badge">
                                        <span>featured</span>
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <button type="button" class="feature-wish">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <div class="feature-content">
                                        <ol class="breadcrumb feature-category">
                                            <li><span class="flat-badge sale">sale</span></li>
                                            <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">cycle</li>
                                        </ol>
                                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                                nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                        <div class="feature-meta">
                                            <span class="feature-price">$455<small>/fixed</small></span>
                                            <span class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div data-item="8" data-item-show="4" class="row ad-standard">
                        @foreach ($ads as $item)
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div onclick="getId({{ $item->id }});" class="product-card standard">
                                    <a href="#">
                                        <div class="product-media">
                                            <div class="product-img">
                                                <img style="height: 200px !important; object-fit:contain !important;"
                                                    src="{{ asset('ad_image/main_image/' . $item->ads_main_image) }}"
                                                    alt="product">
                                            </div>
                                            <div class="product-type">
                                                <span class="flat-badge sale">urgent</span>
                                            </div>
                                            {{-- <ul class="product-action">
                                            <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                            <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                            <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                        </ul> --}}
                                        </div>
                                        <div class="product-content">
                                            {{-- <ol class="breadcrumb product-category">
                                            <li><i class="fas fa-tags"></i></li>
                                            <li class="breadcrumb-item"><a href="#">gadget</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">camera</li>
                                        </ol> --}}
                                            <h5 class="product-title">
                                                <a href="#">{{ $item->ads_title }}</a>
                                            </h5>
                                            <div class="product-meta">
                                                <span><i class="fas fa-map-marker-alt"></i>{{ $item->ads_location }},
                                                    {{ $item->ads_sublocation }}</span>
                                                <span><i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                            </div>
                                            {{-- <div class="product-info">
                                            <h5 class="product-price">Rs. {{ number_format($item->ads_price, 2, '.', '') }}
                                                <span></span>
                                            </h5>
                                            <div class="product-btn">
                                                <a href="compare.html" title="Compare" class="fas fa-compress"></a>
                                                <button type="button" title="Wishlist" class="far fa-heart"></button>
                                            </div>
                                        </div> --}}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {!! $ads->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                           AD LIST PART END  =======================================-->

    <script>
        function getId(id) {

            var url = '{{ route('web.dashboard.vehicle.detailed', ':slug') }}';
            url = url.replace(':slug', id);
            window.location.href = url;
        }
    </script>
@endsection
