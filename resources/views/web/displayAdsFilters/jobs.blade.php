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
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by Sallary</h6>
                                <form method="POST" action="{{ route('jobs.filterdAds') }}" class="product-widget-form">
                                    @csrf
                                    <div class="product-widget-group">
                                        <input name="min" value="{{ session('jobs_filter_data')['min'] ?? null }}"
                                            type="text" placeholder="min">
                                        <input name="max" value="{{ session('jobs_filter_data')['max'] ?? null }}"
                                            type="text" placeholder="max">
                                        <input name="subCat" type="hidden" value="{{ $id }}">
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
                                <h6 class="product-widget-title">Filter by experience</h6>
                                <form method="POST" action="{{ route('jobs.filterdAds') }}" class="product-widget-form">
                                    @csrf
                                    <input name="min" value="{{ session('jobs_filter_data')['min'] ?? null }}"
                                        type="hidden" placeholder="min">
                                    <input name="max" value="{{ session('jobs_filter_data')['max'] ?? null }}"
                                        type="hidden" placeholder="max">
                                    <input name="subCat" type="hidden" value="{{ $id }}">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="1"
                                                    name="experience_1" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_1')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>1 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="2"
                                                    name="experience_2" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_2')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>2 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="3"
                                                    name="experience_3" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_3')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>3 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="4"
                                                    name="experience_4" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_4')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>4 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="5"
                                                    name="experience_5" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_5')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>5 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="6"
                                                    name="experience_6" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_6')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>6 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="7"
                                                    name="experience_7" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_7')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>7 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="8"
                                                    name="experience_8" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_8')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>8 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="9"
                                                    name="experience_9" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_9')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>9 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="10"
                                                    name="experience_10" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_10')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>10 Year</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="more than 10" name="experience_more_than_10" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.experience_more_than_10')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>more than 10</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by education</h6>
                                <form method="POST" action="{{ route('jobs.filterdAds') }}" class="product-widget-form">
                                    @csrf
                                    <input name="min" value="{{ session('jobs_filter_data')['min'] ?? null }}"
                                        type="hidden" placeholder="min">
                                    <input name="max" value="{{ session('jobs_filter_data')['max'] ?? null }}"
                                        type="hidden" placeholder="max">
                                    <input name="subCat" type="hidden" value="{{ $id }}">
                                    <ul class="product-widget-list">

                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Ordinary Level" name="Ordinary_Level" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Ordinary_Level')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Ordinary Level</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Advanced Level" name="Advanced_Level" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Advanced_Level')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Advanced Level</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Certificate" name="Certificate" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Certificate')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Certificate</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Diploma"
                                                    name="Diploma" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Diploma')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Diploma</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Higher Diploma" name="Higher_Diploma" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Higher_Diploma')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Higher Diploma</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Degree"
                                                    name="Degree" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Degree')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Degree</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Masters"
                                                    name="Masters" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Masters')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Masters</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Docterate"
                                                    name="Docterate" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Docterate')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Docterate</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Skilled Apprentice" name="Skilled_Apprentice" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Skilled_Apprentice')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Skilled Apprentice</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by job type</h6>
                                <form method="POST" action="{{ route('jobs.filterdAds') }}"
                                    class="product-widget-form">
                                    @csrf
                                    <input name="min" value="{{ session('jobs_filter_data')['min'] ?? null }}"
                                        type="hidden" placeholder="min">
                                    <input name="max" value="{{ session('jobs_filter_data')['max'] ?? null }}"
                                        type="hidden" placeholder="max">
                                    <input name="subCat" type="hidden" value="{{ $id }}">
                                    <ul class="product-widget-list">

                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Full Time"
                                                    name="Full_Time" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Full_Time')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Full Time</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Part Time"
                                                    name="Part_Time" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Part_Time')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Part Time</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" value="Temporary"
                                                    name="Temporary" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Temporary')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Temporary</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Internship" name="Internship" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Internship')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Internship</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox"
                                                    value="Contractual" name="Contractual" id="chcek1"
                                                    @if (null !== session('jobs_filter_data.Contractual')) checked @endif>
                                            </div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span>Contractual</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit" class="product-widget-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                {{-- </div> --}}
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-filter">
                                <div class="filter-show">
                                    <div class="filter-show">
                                        <a href="{{ route('ads.displaymain.ads', ['id' => $cat_id]) }}">Back to jobs
                                        </a>
                                    </div>
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
                                                    <h5 class="product-price">Sallary From Rs.
                                                        {{ number_format($item->sallary_start_to, 2, '.', '') }} to
                                                        {{ number_format($item->sallary_start_from, 2, '.', '') }}
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

            var url = '{{ route('web.dashboard.jobs.detailed', ':slug') }}';
            url = url.replace(':slug', id);
            window.location.href = url;
        }
    </script>
@endsection
