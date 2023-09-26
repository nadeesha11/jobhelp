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
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- AD DETAILS CARD -->
                            <div class="common-card">
                                <h3 style="margin-bottom: 10px !important;" class="ad-details-title">{{ $ads->ads_title }}
                                </h3>
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
                                                <td>Rs. {{ $ads_jobs->sallary_start_from }} -
                                                    {{ $ads_jobs->sallary_start_to }}
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
            </div>
        </div>
    </div>
    </div>
    {{-- end table for view update delete admins --}}
    </div>
    </div>
@endsection
