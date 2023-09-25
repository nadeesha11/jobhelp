@extends('web.layout.webLayout')
@section('content')
    <section class="inner-section ad-details-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- AD DETAILS CARD -->
                    <div class="common-card">
                        <h3 style="margin-bottom: 10px !important;" class="ad-details-title">{{ $ads->ads_title }}</h3>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($imageArray as $index => $imageName)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                                        @if ($index === 0) class="active" @endif></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($imageArray as $index => $imageName)
                                    @php
                                        // Determine the folder based on the image name or any other logic you have
                                        $folder = $imageName === $main_image ? 'ad_image/main_image' : 'ad_image/sub_images';
                                        // Construct the URL to the image
                                        $imageUrl = asset($folder . '/' . $imageName);
                                    @endphp
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img class="d-block w-100" src="{{ $imageUrl }}"
                                            alt="Slide {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <!-- SPECIFICATION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">Specification</h5>
                        </div>
                        <ul class="ad-details-specific">
                            <table class="table">

                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Sub Category</td>
                                        <td>{{ $ads->ads_sub_cat_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Price</td>
                                        <td>Rs. {{ $ads->ads_price }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Job Type</td>
                                        <td>{{ $ads_jobs->jobType }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Job Work Experience</td>
                                        <td>{{ $ads_jobs->job_work_expirience }} Yr</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Jobs Education</td>
                                        <td>{{ $ads_jobs->job_education }} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Jobs Application Deadline </td>
                                        <td>{{ $ads_jobs->jobs_application_deadline }} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Sallary </td>
                                        <td>Rs. {{ $ads_jobs->sallary_start_from }} - {{ $ads_jobs->sallary_start_to }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Job Employer Website </td>
                                        <td><a
                                                href="{{ $ads_jobs->job_employer_website }}">{{ $ads_jobs->job_employer }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </ul>
                    </div>

                    <!-- SPECIFICATION CARD -->


                    <!-- DESCRIPTION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">description</h5>
                        </div>
                        <p class="ad-details-desc">{!! $ads->desc !!}</p>
                    </div>

                </div>
                <div class="col-lg-4">

                    <!-- NUMBER CARD -->
                    <button type="button" class="common-card number" data-toggle="modal" data-target="#number">
                        <h3>{{ $ads->phone_number }}</h3>
                        <i class="fas fa-phone"></i>
                    </button>

                    <!-- AUTHOR CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">author info</h5>
                        </div>
                        <div class="ad-details-author">
                            <div class="author-meta">
                                <h4><a href="#">{{ $ads->first_name }} {{ $ads->last_name }}</a></h4>
                                <h5>joined: {{ \Carbon\Carbon::parse($ads->joined)->diffForHumans() }}</h5>
                                <h5>{{ $ads->email }}</h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- <section class="inner-section related-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Related This <span>Ads</span></h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero
                            voluptatum repudiandae veniam maxime tenetur.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related-slider slider-arrow">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="images/product/01.jpg" alt="product">
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge sale">sale</span>
                                </div>
                                <ul class="product-action">
                                    <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                    <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    <li class="breadcrumb-item"><a href="#">Luxury</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Duplex House</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="#">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>Uttara, Dhaka</span>
                                    <span><i class="fas fa-clock"></i>30 min ago</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">$1500<span>/negotiable</span></h5>
                                    <div class="product-btn">
                                        <a href="compare.html" title="Compare" class="fas fa-compress"></a>
                                        <button type="button" title="Wishlist" class="far fa-heart"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="images/product/03.jpg" alt="product">
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge sale">sale</span>
                                </div>
                                <ul class="product-action">
                                    <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                    <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    <li class="breadcrumb-item"><a href="#">stationary</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">books</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="#">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>Uttara, Dhaka</span>
                                    <span><i class="fas fa-clock"></i>30 min ago</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">$470<span>/fixed</span></h5>
                                    <div class="product-btn">
                                        <a href="compare.html" title="Compare" class="fas fa-compress"></a>
                                        <button type="button" title="Wishlist" class="far fa-heart"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="images/product/10.jpg" alt="product">
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge sale">sale</span>
                                </div>
                                <ul class="product-action">
                                    <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                    <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">private car</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="#">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>Uttara, Dhaka</span>
                                    <span><i class="fas fa-clock"></i>30 min ago</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">$3300<span>/fixed</span></h5>
                                    <div class="product-btn">
                                        <a href="compare.html" title="Compare" class="fas fa-compress"></a>
                                        <button type="button" title="Wishlist" class="far fa-heart"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="images/product/09.jpg" alt="product">
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge sale">sale</span>
                                </div>
                                <ul class="product-action">
                                    <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                    <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    <li class="breadcrumb-item"><a href="#">animals</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">cat</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="#">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>Uttara, Dhaka</span>
                                    <span><i class="fas fa-clock"></i>30 min ago</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">$900<span>/Negotiable</span></h5>
                                    <div class="product-btn">
                                        <a href="compare.html" title="Compare" class="fas fa-compress"></a>
                                        <button type="button" title="Wishlist" class="far fa-heart"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="images/product/02.jpg" alt="product">
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge sale">sale</span>
                                </div>
                                <ul class="product-action">
                                    <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                    <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    <li class="breadcrumb-item"><a href="#">fashion</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">shoes</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="#">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>Uttara, Dhaka</span>
                                    <span><i class="fas fa-clock"></i>30 min ago</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">$384<span>/fixed</span></h5>
                                    <div class="product-btn">
                                        <a href="compare.html" title="Compare" class="fas fa-compress"></a>
                                        <button type="button" title="Wishlist" class="far fa-heart"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                        <a href="ad-column3.html" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span>view all related</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
