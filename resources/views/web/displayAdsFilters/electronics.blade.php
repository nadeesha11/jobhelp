@extends('web.layout.webLayout')
@section('content')
    <style>
        .product-card {
            cursor: pointer !important;
        }
    </style>
    <section class="inner-section ad-list-part">
        <div class="container">
            <div class="row content-reverse">
                <div class="col-lg-4 col-xl-3">
                    <div class="row">
                        <form method="POST" action="{{ route('electronics.filterdAds') }}" class="product-widget-form">

                            @csrf
                            <div class="col-md-6 col-lg-12">
                                <div class="product-widget">
                                    <h6 class="product-widget-title">Filter by Price</h6>
                                    <div class="product-widget-group">
                                        <input name="min"
                                            value="{{ session('electronics_filter_data')['min'] ?? null }}" type="text"
                                            placeholder="min">
                                        <input name="max"
                                            value="{{ session('electronics_filter_data')['max'] ?? null }}" type="text"
                                            placeholder="max">
                                        <input type="hidden" name="subCat" type="text" value="{{ $id }}">
                                    </div>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-12">
                                <div class="product-widget">
                                    <h6 class="product-widget-title">Filter by condition</h6>
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="1"
                                                    name="new" id="chcek1" class="condition"
                                                    @if (null !== session('electronics_filter_data.new')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span class="product-widget-type rent ">new</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="0"
                                                    class="condition" name="used" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.used')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span class="product-widget-type sale">used</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </div>
                            </div>



                            @if ($id == 10)
                                <div class="col-md-6 col-lg-12">
                                    <div class="product-widget">
                                        <h6 class="product-widget-title">Filter by Capacity</h6>
                                        <ul class="product-widget-list">
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"><input type="checkbox" value="12000"
                                                        @if (null !== session('electronics_filter_data.capacity_12000')) checked @endif
                                                        name="capacity_12000" id="chcek1" class="condition">
                                                </div>
                                                <label class="product-widget-label" for="chcek1">
                                                    <span>12000 BTU</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox" value="18000"
                                                        @if (null !== session('electronics_filter_data.capacity_18000')) checked @endif class="condition"
                                                        name="capacity_18000" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>18000 BTU</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox" value="22000"
                                                        @if (null !== session('electronics_filter_data.capacity_22000')) checked @endif class="condition"
                                                        name="capacity_22000" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>22000 BTU</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox" value="24000"
                                                        @if (null !== session('electronics_filter_data.capacity_24000')) checked @endif class="condition"
                                                        name="capacity_24000" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>24000 BTU</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        @if (null !== session('electronics_filter_data.capacity_other')) checked @endif
                                                        value="capacity_other" class="condition" name="capacity_other"
                                                        id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>other</span>
                                                </label>
                                            </li>
                                        </ul>
                                        <button type="submit" class="product-widget-btn">
                                            <i class="fas fa-search"></i>
                                            <span>search</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                            @endif

                            @if ($id == 11)
                                <div class="col-md-6 col-lg-12">
                                    <div class="product-widget">
                                        <h6 class="product-widget-title">Filter by Capacity</h6>
                                        <ul class="product-widget-list">
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"><input type="checkbox"
                                                        value="24" @if (null !== session('electronics_filter_data.inch_24')) checked @endif
                                                        name="inch_24" id="chcek1" class="condition">
                                                </div>
                                                <label class="product-widget-label" for="chcek1">
                                                    <span>24 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"><input type="checkbox"
                                                        value="32" @if (null !== session('electronics_filter_data.inch_32')) checked @endif
                                                        name="inch_32" id="chcek1" class="condition">
                                                </div>
                                                <label class="product-widget-label" for="chcek1">
                                                    <span>32 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        value="40" @if (null !== session('electronics_filter_data.inch_40')) checked @endif
                                                        class="condition" name="inch_40" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>40 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        value="43" @if (null !== session('electronics_filter_data.inch_43')) checked @endif
                                                        class="condition" name="inch_43" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>43 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        value="50" @if (null !== session('electronics_filter_data.inch_50')) checked @endif
                                                        class="condition" name="inch_50" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>50 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        @if (null !== session('electronics_filter_data.inch_55')) checked @endif value="55"
                                                        class="condition" name="inch_55" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>55 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        @if (null !== session('electronics_filter_data.inch_60')) checked @endif value="60"
                                                        class="condition" name="inch_60" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>60 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        @if (null !== session('electronics_filter_data.inch_65')) checked @endif value="65"
                                                        class="condition" name="inch_65" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>65 inches</span>
                                                </label>
                                            </li>
                                            <li class="product-widget-item">
                                                <div class="product-widget-checkbox"> <input type="checkbox"
                                                        @if (null !== session('electronics_filter_data.inch_other')) checked @endif value="other"
                                                        class="condition" name="inch_other" id="chcek2">
                                                </div>
                                                <label class="product-widget-label" for="chcek2">
                                                    <span>other</span>
                                                </label>
                                            </li>
                                        </ul>
                                        <button type="submit" class="product-widget-btn">
                                            <i class="fas fa-search"></i>
                                            <span>search</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                            @endif

                            <div class="col-md-6 col-lg-12">
                                <div class="product-widget">
                                    <h6 class="product-widget-title">Filter by location</h6>

                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Ampara"
                                                    name="Ampara" id="chcek1" class="condition"
                                                    @if (null !== session('electronics_filter_data.Ampara')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Ampara</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Anuradhapura" class="condition" name="Anuradhapura"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Anuradhapura')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Anuradhapura</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Badulla"
                                                    class="condition" name="Badulla" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Badulla')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Badulla</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Batticaloa" class="condition" name="Batticaloa"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Batticaloa')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Batticaloa</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Colombo"
                                                    class="condition" name="Colombo" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Colombo')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Colombo</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Galle"
                                                    class="condition" name="Galle" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Galle')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Galle</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Gampaha"
                                                    class="condition" name="Gampaha" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Gampaha')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Gampaha</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Hambantota" class="condition" name="Hambantota"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Hambantota')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Hambantota</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Jaffna"
                                                    class="condition" name="Jaffna" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Jaffna')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Jaffna</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Kalutara"
                                                    class="condition" name="Kalutara" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Kalutara')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Kalutara</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Kandy"
                                                    class="condition" name="Kandy" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Kandy')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Kandy</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Kegalle"
                                                    class="condition" name="Kegalle" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Kegalle')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Kegalle</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Kilinochchi" class="condition" name="Kilinochchi"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Kilinochchi')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Kilinochchi</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Kurunegala" class="condition" name="Kurunegala"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Kurunegala')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Kurunegala</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Mannar"
                                                    class="condition" name="Mannar" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Mannar')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Mannar</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Matale"
                                                    class="condition" name="Matale" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Matale')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Matale</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Matara"
                                                    class="condition" name="Matara" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Matara')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Matara</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Monaragala" class="condition" name="Monaragala"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Monaragala')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Monaragala</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Mullaitivu" class="condition" name="Mullaitivu"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Mullaitivu')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Mullaitivu</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Nuwara Eliya" class="condition" name="Nuwara_Eliya"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Nuwara_Eliya')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Nuwara Eliya</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Polonnaruwa" class="condition" name="Polonnaruwa"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Polonnaruwa')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Polonnaruwa</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Puttalam"
                                                    class="condition" name="Puttalam" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Puttalam')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Puttalam</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Ratnapura" class="condition" name="Ratnapura" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Ratnapura')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Ratnapura</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox"
                                                    value="Trincomalee" class="condition" name="Trincomalee"
                                                    id="chcek2" @if (null !== session('electronics_filter_data.Trincomalee')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Trincomalee</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"> <input type="checkbox" value="Vavuniya"
                                                    class="condition" name="Vavuniya" id="chcek2"
                                                    @if (null !== session('electronics_filter_data.Vavuniya')) checked @endif>

                                            </div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span>Vavuniya</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-filter">
                                <div class="filter-show">
                                    <a href="{{ route('ads.displaymain.ads', ['id' => $cat_id]) }}">Back to all
                                        electronics
                                    </a>
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
                        @if (count($ads) == 0)
                            <p>There is no ads</p>
                        @else
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
                                            </div>
                                            <div class="product-content">
                                                <ol class="breadcrumb product-category">
                                                    <li><i class="fas fa-tags"></i></li>
                                                    <li class="breadcrumb-item">{{ $item->subCatName }}</li>
                                                </ol>
                                                <h5 class="product-title">
                                                    <a href="#">{{ $item->ads_title }}</a>
                                                </h5>
                                                <div class="product-meta">
                                                    <span><i class="fas fa-map-marker-alt"></i>{{ $item->ads_location }},
                                                        {{ $item->ads_sublocation }}</span>
                                                    <span><i class="fas fa-clock"></i>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-price">Rs.
                                                        {{ number_format($item->ads_price, 2, '.', '') }}
                                                        <span></span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {!! $ads->withQueryString()->links('pagination::bootstrap-5') !!}

                </div>
            </div>
        </div>
    </section>

    <script>
        function getId(id) {

            var url = '{{ route('web.dashboard.electronic.detailed', ':slug') }}';
            url = url.replace(':slug', id);
            window.location.href = url;
        }
    </script>


@endsection
