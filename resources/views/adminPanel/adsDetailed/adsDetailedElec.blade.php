@extends('adminPanel.layout.adminLayout')
@section('content')
    <div>
        <h4 class="text-center mb-1">Ads Detailed</h4>
    </div>
    <div class="row">
        <div class="col-12 ">
            {{-- table for view update delete admins  --}}
            <div class="card">
                <div class="card-body m-1">
                    <div class="raw">
                        <div class="col-md-12">
                            <div class="jumbotron">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <!-- AD DETAILS CARD -->
                                            <div class="common-card">
                                                <h3 style="margin-bottom: 10px !important;" class="ad-details-title">
                                                    {{ $ads->ads_title }}</h3>
                                                <div id="carouselExampleIndicators" class="carousel slide"
                                                    data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                        @foreach ($imageArray as $index => $imageName)
                                                            <li data-target="#carouselExampleIndicators"
                                                                data-slide-to="{{ $index }}"
                                                                @if ($index === 0) class="active" @endif>
                                                            </li>
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
                                                            <div
                                                                class="carousel-item @if ($index === 0) active @endif">
                                                                <img class="d-block w-100" src="{{ $imageUrl }}"
                                                                    alt="Slide {{ $index + 1 }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                        role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                        role="button" data-slide="next">
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
                                                            @if (
                                                                $ads_subcategory == 5 ||
                                                                    $ads_subcategory == 4 ||
                                                                    $ads_subcategory == 12 ||
                                                                    $ads_subcategory == 9 ||
                                                                    $ads_subcategory == 7 ||
                                                                    $ads_subcategory == 6 ||
                                                                    $ads_subcategory == 10 ||
                                                                    $ads_subcategory == 13 ||
                                                                    $ads_subcategory == 8)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Model</td>
                                                                    <td>{{ $ads_electronic->model_name }}</td>
                                                                </tr>
                                                            @endif

                                                            @if ($ads_subcategory == 2)
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Condition</td>
                                                                    <td>
                                                                        @if ($ads_electronic->ele_condition == 'on')
                                                                            New
                                                                        @else
                                                                            Used
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @else
                                                            @endif

                                                            @if ($ads_subcategory == 10)
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Capacity</td>
                                                                    <td>{{ $ads_electronic->elec_capacity }} BTU</td>
                                                                </tr>
                                                            @else
                                                            @endif

                                                            @if ($ads_subcategory == 2 || $ads_subcategory == 8)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Type</td>
                                                                    <td>{{ $ads_electronic->sct_name }}</td>
                                                                </tr>
                                                            @endif

                                                            @if ($ads_subcategory == 11)
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Screen Size</td>
                                                                    <td>{{ $ads_electronic->elec_screen_size }}</td>
                                                                </tr>
                                                            @else
                                                            @endif

                                                            <tr>
                                                                <th scope="row"></th>
                                                                <td>Negotiable</td>
                                                                <td>
                                                                    @if ($ads_electronic->ele_price_negotiable == '1')
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
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
                                            <button type="button" class="common-card number" data-toggle="modal"
                                                data-target="#number">
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
                                                        <h4><a href="#">{{ $ads->first_name }}
                                                                {{ $ads->last_name }}</a></h4>
                                                        <h5>joined:
                                                            {{ \Carbon\Carbon::parse($ads->joined)->diffForHumans() }}</h5>
                                                        <h5>{{ $ads->email }}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end table for view update delete admins --}}
        </div>
    </div>
@endsection