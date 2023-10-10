@extends('web.layout.webLayout')
@section('content')
    <style>
        .fa-location-dot {
            font-size: 20px;
            color: rgb(12, 12, 156);
        }

        option:empty {
            display: none;
        }

        .customSelect {
            height: 50px;
            background-color: #f5f5f5;
            border: 1px solid #a6b0cf !important;
        }

        input {
            border: 1px solid #a6b0cf !important;
            border-radius: 0.3rem !important;
        }
    </style>
    <div class="container ">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <h3 class="mb-2">Fill in the details</h3>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="row">
                            <div class="col-9"><i class="fa-solid fa-location-dot mr-1"></i> <span id="locationDisplay"
                                    class="mr-2"><b> {{ $userData->location }} </b> </span> <span
                                    id="subLocationDisplay"><b>{{ $userData->sub_location }}</b> </span> <span
                                    onmouseover="this.style.cursor='pointer'" id="changeLocation"
                                    style="color:rgb(56, 56, 185); text-decoration: underline;">change</span></div>
                            <span class="text-danger error" id="location_error"></span>
                            <span class="text-danger error" id="sublocation_error"></span>
                            <div class="col-3"></div>
                        </div>
                    </div>
                </div>

                <form id="create_vehicle_post_form">

                    {{-- hidden input location  --}}
                    <input name="ads_location" value="{{ $userData->location }}" id="ads_location_hidden" type="hidden">
                    <input name="ads_sublocation" value="{{ $userData->sub_location }}" id="ads_sublocation_hidden"
                        type="hidden">
                    <input type="hidden" value="{{ $userData->id }}" name="user_id" id="hidden_user_id">
                    <input type="hidden" value="{{ $subCategory->id }}" name="sub_category_id" id="hidden_sub_category_id">
                    <input type="hidden" value="{{ $category->id }}" name="category_id" id="hidden_category_id">
                    {{-- hidden input sublocation  --}}

                    <div class="row">
                        <div class="col-lg-6 col-12 ">
                            <div class="col-12 mt-2 ">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control resetInput" id="title" name="title"
                                    placeholder="Enter title">
                                <span class="text-danger error" id="title_error"></span>
                            </div>

                            @if ($subCategory->id == 18 || $subCategory->id == 23 || $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1">Brand</label>
                                    <select class="browser-default custom-select  brands customSelect resetInput"
                                        name="brand" id="brand" aria-label="Default select example">
                                        <option value="" selected>Choose brand</option>
                                        @foreach ($subCatBrands as $one)
                                            <option value="{{ $one->id }}">{{ $one->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error" id="brand_error"></span>
                                </div>
                            @endif

                            <div class="col-12 mt-2 ">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" class="form-control resetInput" id="price" name="price"
                                    placeholder="Enter Price">
                                <span class="text-danger error" id="price_error"></span>
                            </div>

                            @if (
                                $subCategory->id == 15 ||
                                    $subCategory->id == 18 ||
                                    $subCategory->id == 20 ||
                                    $subCategory->id == 23 ||
                                    $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1">Trim / Edition (optional)</label>
                                    <input type="text" class="form-control resetInput" id="Edition" name="Edition"
                                        placeholder="What is trim/edition of your vehicle?">
                                    <span class="text-danger error" id="Edition_error"></span>
                                </div>
                            @endif

                            @if (
                                $subCategory->id == 15 ||
                                    $subCategory->id == 18 ||
                                    $subCategory->id == 20 ||
                                    $subCategory->id == 23 ||
                                    $subCategory->id == 24 ||
                                    $subCategory->id == 25 ||
                                    $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1">Mileage (km)</label>
                                    <input type="number" class="form-control resetInput" id="Mileage" name="Mileage"
                                        placeholder="What is the mileage of your car?">
                                    <span class="text-danger error" id="Mileage_error"></span>
                                </div>
                            @endif

                            @if ($subCategory->id == 17)
                                <div class="col-12 mt-3 ">
                                    <label>Fuel type</label>
                                    <select class="browser-default custom-select customSelect resetInput" name="fuel_type"
                                        id="fuel_type" aria-label="Default select example">
                                        <option selected value="">Choose fuel type</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="CNG">CNG</option>
                                        <option value="Hybrid">Hybrid</option>
                                        <option value="Electric">Electric</option>
                                        <option value="other">Other Fuel type</option>
                                    </select>
                                    <span class="text-danger error" id="fuel_type_error"></span>
                                </div>
                            @else
                            @endif

                            @if ($subCategory->id == 17)
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1"> Body type (optional)</label>
                                    <select class="browser-default custom-select customSelect resetInput" name="Bodytype"
                                        id="Bodytype" aria-label="Default select example">
                                        <option selected value="">Open this select menu</option>
                                        <option value="Saloon">Saloon</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="Station_wagon">Station wagon</option>
                                        <option value="Convertible">Convertible</option>
                                        <option value="Coupé_Sports">Coupé/Sports</option>
                                        <option value="SUV_4x4">SUV / 4x4</option>
                                        <option value="MPV">MPV</option>
                                    </select>
                                    <span class="text-danger error" id="Bodytype_error"></span>
                                </div>
                            @else
                            @endif

                        </div>

                        <div class="col-lg-6 col-12 ">
                            @if (
                                $subCategory->id == 17 ||
                                    $subCategory->id == 19 ||
                                    $subCategory->id == 20 ||
                                    $subCategory->id == 21 ||
                                    $subCategory->id == 22 ||
                                    $subCategory->id == 26 ||
                                    $subCategory->id == 24 ||
                                    $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-2 ">
                                    <label for="exampleInputEmail1">Type</label>
                                    <select class="browser-default custom-select  customSelect resetInput"
                                        name="VehicleType" id="VehicleType" aria-label="Default select example">
                                        <option value="" selected>Open this select menu</option>
                                        @foreach ($subCategoryTypes as $one)
                                            <option value="{{ $one->id }}">{{ $one->sct_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error" id="VehicleType_error"></span>
                                </div>
                            @endif

                            @if ($subCategory->id == 15 || $subCategory->id == 18 || $subCategory->id == 23)
                            @else
                                <div class="col-12 mt-2">
                                    <label for="exampleInputEmail1">Condition</label>
                                    <select class="browser-default custom-select  custom_select customSelect resetInput"
                                        name="Condition" id="Condition" aria-label="Default select example">
                                        <option value="" selected>Open this select menu</option>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                        <option value="Reconditioned">Reconditioned</option>
                                    </select>
                                    <span class="text-danger error" id="Condition_error"></span>
                                </div>
                            @endif
                            @if (
                                $subCategory->id == 15 ||
                                    $subCategory->id == 18 ||
                                    $subCategory->id == 20 ||
                                    $subCategory->id == 23 ||
                                    $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1">Year of Manufacture</label>
                                    <input type="number" class="form-control resetInput" id="YearOfManufacture"
                                        name="YearOfManufacture" placeholder="When was your can manufactured?">
                                    <span class="text-danger error" id="YearOfManufacture_error"></span>
                                </div>
                            @endif
                            @if (
                                $subCategory->id == 20 ||
                                    $subCategory->id == 18 ||
                                    $subCategory->id == 23 ||
                                    $subCategory->id == 15 ||
                                    $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-2 ">
                                    <label for="exampleInputEmail1">Models</label>
                                    <select id="getModels" name="model"
                                        class="browser-default custom-select customSelect resetInput"
                                        aria-label="Default select example ">
                                    </select>
                                    <span class="text-danger error" id="model_error"></span>
                                </div>
                            @endif
                            @if (
                                $subCategory->id == 15 ||
                                    $subCategory->id == 18 ||
                                    $subCategory->id == 19 ||
                                    $subCategory->id == 20 ||
                                    $subCategory->id == 23 ||
                                    $subCategory->id == 24 ||
                                    $subCategory->id == 25 ||
                                    $subCategory->id == 27)
                            @else
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1">Engine capacity (cc)</label>
                                    <input type="number" class="form-control resetInput" id="Enginecapacity"
                                        name="Enginecapacity" placeholder="What is the engine capacity of your car?">
                                    <span class="text-danger error" id="Enginecapacity_error"></span>
                                </div>
                            @endif
                            @if ($subCategory->id == 17)
                                <div class="col-12 mt-3 ">
                                    <label for="exampleInputEmail1">Transmission</label>
                                    <select class="browser-default custom-select  customSelect resetInput"
                                        name="Transmission" id="Transmission" aria-label="Default select example">
                                        <option selected value="">Open this select menu</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="Tiptronic">Tiptronic</option>
                                        <option value="Other">Other transmission</option>
                                    </select>
                                    <span class="text-danger error" id="Transmission_error"></span>
                                </div>
                            @else
                            @endif
                            <div class="col-12 mt-3 ">
                                <label for="exampleInputEmail1"> Negotiable</label><br>
                                <label class="radio-inline m-2">
                                    <input type="radio" name="negotiable" value="1" class="m-1" checked>Yes
                                </label>
                                <label class="radio-inline m-2">
                                    <input type="radio" class="m-1" value="0" name="negotiable">No
                                </label>
                                {{-- <span class="text-danger error" id="negotiable_error"></span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row m-1">
                        <div class="form-group col-lg-3">
                            <label for="exampleInputEmail1">Main image</label>
                            <input type="file" data-height="60" class="form-control dropify" name="main_image"
                                id="main_image">
                            <span class="text-danger error" id="main_image_error"></span>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputPassword1">Image one</label>
                            <input data-height="60" type="file" class="form-control dropify" name="image_one"
                                id="image_one">
                            <span class="text-danger error" id="image_one_error"></span>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputEmail1">Image two</label>
                            <input data-height="60" type="file" class="form-control dropify" id="image_two"
                                name="image_two">
                            <span class="text-danger error" id="image_two_error"></span>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputPassword1">Image three</label>
                            <input data-height="60" type="file" class="form-control dropify" id="image_three"
                                name="image_three">
                            <span class="text-danger error" id="image_three_error"></span>
                        </div>
                    </div>

                    <div class="row mr-3">
                        <div class="col-12 mt-2 ml-3 mr-3">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea class="form-control resetInput" id="description" name="description" rows="5"></textarea>
                            <span class="text-danger error" id="description_error"></span>
                        </div>
                    </div>

                    <button type="button" id="create_vehicle_post" class="btn btn-primary m-2">Post Ad</button>
                </form>

            </div>
        </div>
    </div>

    {{-- start modal  --}}
    <div class="modal fade" id="showLocationAndSublocation" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change location and sublocation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="myform">
                        <div class="row">
                            <div class="col-lg-6 col-12 form-group">
                                <select name="location" id="location"
                                    class="browser-default custom-select location resetInput">
                                    <option value="">Select location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" name="{{ $location->name_en }}">
                                            {{ $location->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-12 form-group">
                                <select name="sublocation" id="subLocation" class="browser-default custom-select">

                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="getLocationbtn" class="btn btn-primary m-2">Change </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal  --}}

    <form id="postForm" action="{{ route('web.dashboard.payedAds.package') }}" method="POST">
        @csrf
        <input type="hidden" name="data" id="postData">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"
        integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#description').summernote({
                height: 100,
            });

            //  start get models 
            $(".brands").on('click', function() {
                var brands = $(this).val();
                console.log(brands);
                $.ajax({
                    url: "{{ url('web/dashboard/getModels') }}/" + brands,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        var display_models = '';
                        $.each(res.models, function(index, row) {
                            display_models += '<option  value="' + row.id + '" >' + row
                                .model_name + '<option>'
                        });
                        // console.log(display_models);
                        $("#getModels").html(display_models);
                    }
                });
            });
            //  end to get models 

        });
    </script>
    <script>
        $('.dropify').dropify();
        $('#changeLocation').click(function() {
            $('#showLocationAndSublocation').modal('show');
        });

        $(".location").on('click', function() {
            var selectedlocation = $(this).val();
            $.ajax({
                url: "{{ url('web/dashboard/setting') }}/" + selectedlocation,
                dataType: 'json',
                success: function(res) {
                    var _html = '';
                    $.each(res.sublocation, function(index, row) {
                        _html += '<option name="' + row.name_en + '"  value="' + row.id +
                            '" >' + row.name_en + '<option>'
                    });
                    $("#subLocation").html(_html);
                }
            });
        });

        //get locations and save it into hidden inputs and display via html append
        $('#getLocationbtn').click(function() {

            var location = $("#location").find(':selected').attr('name');
            var sublocation = $("#subLocation").find(':selected').attr('name');

            if (location == null || sublocation == null) {
                Swal.fire({
                    title: 'Error!',
                    text: "Please select location and sublocation",
                    icon: 'error',
                    confirmButtonText: 'OK'
                }) //display error msg
            } else {
                document.getElementById('ads_location_hidden').value =
                    location; //change hidden location value after change location
                document.getElementById('ads_sublocation_hidden').value =
                    sublocation; //change hidden sub location value after change sub location

                // change displayed location and sub location is displayed
                var Changelocation = document.getElementById('locationDisplay');
                var jslocation = location;
                Changelocation.innerHTML = jslocation;

                var Changesublocation = document.getElementById('subLocationDisplay');
                var jssublocation = sublocation;
                Changesublocation.innerHTML = jssublocation;

                $('#showLocationAndSublocation').modal('hide');

            }
        });

        //create add start 
        $('#create_vehicle_post').click(function() {
            $('.error').html('');
            var data = $('#create_vehicle_post_form')[0];
            var data_ajax = new FormData(data); // get form data

            // send form data start 
            $.ajax({
                url: "{{ route('web.dashboard.vehicle.create') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: data_ajax,
                success: function(response) {
                    // reset values 
                    $('.dropify').each(function() {
                        $(this).dropify('resetPreview');
                    });
                    $('.resetInput').val('');

                    document.getElementById("create_vehicle_post").disabled =
                        false; //disable button after click it
                    if (response.payment_method === "free") {
                        var inserted_ad = response
                            .last_inerted_id; // Corrected the variable name
                        var url = '{{ route('web.dashboard.freeAds.package', ':slug') }}';
                        url = url.replace(':slug', inserted_ad);
                        window.location.href = url;
                    } else if (response.payment_method === "payed") {
                        var ad_data = response;
                        var postData = JSON.stringify(ad_data);
                        // Set the data in the hidden input field
                        document.getElementById("postData").value = postData;
                        // Submit the form programmatically
                        document.getElementById("postForm").submit();
                    }
                    $('.error').html(''); //clear validation errors
                },
                error: function(error) {
                    console.log(error);
                    $('#title_error').html(error.responseJSON.errors.title);
                    $('#brand_error').html(error.responseJSON.errors.brand);
                    $('#price_error').html(error.responseJSON.errors.price);
                    $('#Edition_error').html(error.responseJSON.errors.Edition);
                    $('#Mileage_error').html(error.responseJSON.errors.Mileage);
                    $('#fuel_type_error').html(error.responseJSON.errors.fuel_type);
                    $('#Bodytype_error').html(error.responseJSON.errors.Bodytype);
                    $('#VehicleType_error').html(error.responseJSON.errors.VehicleType);
                    $('#Condition_error').html(error.responseJSON.errors.Condition);
                    $('#YearOfManufacture_error').html(error.responseJSON.errors.YearOfManufacture);
                    $('#model_error').html(error.responseJSON.errors.model);
                    $('#Enginecapacity_error').html(error.responseJSON.errors.Enginecapacity);
                    $('#Transmission_error').html(error.responseJSON.errors.Transmission);
                    $('#negotiable_error').html(error.responseJSON.errors.negotiable);
                    $('#main_image_error').html(error.responseJSON.errors.main_image);
                    $('#image_one_error').html(error.responseJSON.errors.image_one);
                    $('#image_two_error').html(error.responseJSON.errors.image_two);
                    $('#image_three_error').html(error.responseJSON.errors.image_three);
                    $('#description_error').html(error.responseJSON.errors.description);
                }
            });
            // send form data end
        });


        //create add end 
    </script>







@endsection
