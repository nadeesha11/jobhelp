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

                                                            @if ($ads_subcategory == 18 || $ads_subcategory == 23 || $ads_subcategory == 27)
                                                            @else
                                                                <th scope="row"></th>
                                                                <td>Brand</td>
                                                                <td>{{ $ads_vehicle->brand_name }}</td>
                                                            @endif
                                                            @if (
                                                                $ads_subcategory == 20 ||
                                                                    $ads_subcategory == 18 ||
                                                                    $ads_subcategory == 23 ||
                                                                    $ads_subcategory == 15 ||
                                                                    $ads_subcategory == 27)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Models</td>
                                                                    <td>{{ $ads_vehicle->model_name }}</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <th scope="row"></th>
                                                                <td>Price</td>
                                                                <td>Rs. {{ $ads->ads_price }}</td>
                                                            </tr>
                                                            @if (
                                                                $ads_subcategory == 15 ||
                                                                    $ads_subcategory == 18 ||
                                                                    $ads_subcategory == 20 ||
                                                                    $ads_subcategory == 23 ||
                                                                    $ads_subcategory == 27)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Trim / Edition </td>
                                                                    <td>{{ $ads_vehicle->edition }}</td>
                                                                </tr>
                                                            @endif

                                                            @if (
                                                                $ads_subcategory == 15 ||
                                                                    $ads_subcategory == 18 ||
                                                                    $ads_subcategory == 20 ||
                                                                    $ads_subcategory == 23 ||
                                                                    $ads_subcategory == 24 ||
                                                                    $ads_subcategory == 25 ||
                                                                    $ads_subcategory == 27)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Mileage (km)</td>
                                                                    <td>{{ $ads_vehicle->milage }} KM</td>
                                                                </tr>
                                                            @endif

                                                            @if ($ads_subcategory == 17)
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Fuel type</td>
                                                                    <td>{{ $ads_vehicle->fuel_type }}</td>
                                                                </tr>
                                                            @else
                                                            @endif

                                                            @if ($ads_subcategory == 17)
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td> Body type (optional)</td>
                                                                    <td>{{ $ads_vehicle->body_type }}</td>
                                                                </tr>
                                                            @else
                                                            @endif

                                                            @if (
                                                                $ads_subcategory == 17 ||
                                                                    $ads_subcategory == 19 ||
                                                                    $ads_subcategory == 20 ||
                                                                    $ads_subcategory == 21 ||
                                                                    $ads_subcategory == 22 ||
                                                                    $ads_subcategory == 26 ||
                                                                    $ads_subcategory == 24 ||
                                                                    $ads_subcategory == 27)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td> Type</td>
                                                                    <td>{{ $ads_vehicle->sct_name }}</td>
                                                                </tr>
                                                            @endif

                                                            @if ($ads_subcategory == 15 || $ads_subcategory == 18 || $ads_subcategory == 23)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Condition</td>
                                                                    <td>{{ $ads_vehicle->condition }}</td>
                                                                </tr>
                                                            @endif

                                                            @if (
                                                                $ads_subcategory == 15 ||
                                                                    $ads_subcategory == 18 ||
                                                                    $ads_subcategory == 20 ||
                                                                    $ads_subcategory == 23 ||
                                                                    $ads_subcategory == 27)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Year of Manufacture</td>
                                                                    <td>{{ $ads_vehicle->manufacture_year }}</td>
                                                                </tr>
                                                            @endif

                                                            @if (
                                                                $ads_subcategory == 15 ||
                                                                    $ads_subcategory == 18 ||
                                                                    $ads_subcategory == 19 ||
                                                                    $ads_subcategory == 20 ||
                                                                    $ads_subcategory == 23 ||
                                                                    $ads_subcategory == 24 ||
                                                                    $ads_subcategory == 25 ||
                                                                    $ads_subcategory == 27)
                                                            @else
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Engine capacity (cc)</td>
                                                                    <td>{{ $ads_vehicle->engine_capacity }}</td>
                                                                </tr>
                                                            @endif

                                                            @if ($ads_subcategory == 17)
                                                                <tr>
                                                                    <th scope="row"></th>
                                                                    <td>Transmission</td>
                                                                    <td>{{ $ads_vehicle->transmission }}</td>
                                                                </tr>
                                                            @else
                                                            @endif

                                                            <tr>
                                                                <th scope="row"></th>
                                                                <td>Negotiable</td>
                                                                <td>
                                                                    @if ($ads_vehicle->price_negotiable === '1')
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
                {{-- end table for view update delete admins --}}
            </div>
        </div>
    @endsection
