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

        .combined-input .input-wrapper {
            display: flex;
        }

        .combined-input input {
            flex-grow: 1;
            margin-right: 5px;
            /* Add spacing between the two input fields */
        }

        .small-dropdown {
            width: auto;
            flex-shrink: 0;
            margin-left: 5px;
            /* Add spacing between the input fields and the dropdown */
        }

        .combined-input .input-wrapper {
            display: flex;
            align-items: center;
            /* Center the items vertically */
        }

        .combined-input input {
            flex-grow: 1;
            margin-right: 5px;
            /* Add spacing between the input fields */
        }

        .small-dropdown {
            width: auto;
            flex-shrink: 0;
            margin-left: 5px;
            /* Add spacing between the input fields and the dropdown */
        }
    </style>
    <div class="container ">
        <div class="card">
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

                <form id="create_property_post_form">

                    {{-- hidden input location  --}}
                    <input name="ads_location" value="{{ $userData->location }}" id="ads_location_hidden" type="text">
                    <input name="ads_sublocation" value="{{ $userData->sub_location }}" id="ads_sublocation_hidden"
                        type="text">
                    <input type="text" value="{{ $userData->id }}" name="user_id" id="hidden_user_id">
                    <input type="text" value="{{ $subCategory->id }}" name="sub_category_id" id="hidden_sub_category_id">
                    <input type="text" value="{{ $category->id }}" name="category_id" id="hidden_category_id">
                    {{-- hidden input sublocation  --}}

                    {{-- this is testing reviwed by se  start --}}
                    <div class="row">

                        <div class=" col-md-6  col-sm-12 mt-2 ">
                            <label for="exampleInputEmail1">Title *</label>
                            <input type="text" class="form-control resetInput" id="title" name="title"
                                placeholder="Enter title">
                            <span class="text-danger error" id="title_error"></span>
                        </div>

                        <div class="col-md-6  col-sm-12 mt-2 ">
                            <label for="exampleInputPassword1">Price *</label>
                            <input type="number" class="form-control resetInput" id="price" name="price"
                                placeholder="Enter price">
                            <span class="text-danger error" id="price_error"></span>
                        </div>

                        <div class="col-md-6  col-sm-12 mt-2 ">
                            <label for="exampleInputPassword1">Property Address </label>
                            <input type="text" class="form-control resetInput" id="address" name="address"
                                placeholder="Enter Address">
                            <span class="text-danger error" id="address_error"></span>
                        </div>

                        {{-- need to display bedrooms only when houses and apartments --}}
                        @if ($subCategory->id === 49 || $subCategory->id === 50)
                            <div class="col-md-6  col-sm-12 mt-2 ">
                                <label for="exampleInputPassword1">Bedrooms *</label>
                                <select class="browser-default custom-select  customSelect resetInput" name="bedrooms"
                                    id="bedrooms" aria-label="Default select example">
                                    <option value="" selected>Open this select menu</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="more than 10">more than 10</option>
                                </select>
                                <span class="text-danger error" id="bedrooms_error"></span>
                            </div>
                        @else
                        @endif
                        {{-- need to display bedrooms only when houses and apartments --}}

                        {{-- need to display bathrooms only when houses and apartments --}}
                        @if ($subCategory->id === 49 || $subCategory->id === 50)
                            <div class="col-md-6  col-sm-12 mt-2 ">
                                <label for="exampleInputPassword1">Bathrooms *</label>
                                <select class="browser-default custom-select  customSelect resetInput" name="bathrooms"
                                    id="bathrooms" aria-label="Default select example">
                                    <option value="" selected>Open this select menu</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="more than 10">more than 10</option>
                                </select>
                                <span class="text-danger error" id="bathrooms_error"></span>
                            </div>
                        @else
                        @endif
                        {{-- need to display bathrooms only when houses and apartments --}}

                        {{-- need to display House Size only when houses and apartments --}}
                        @if ($subCategory->id === 49 || $subCategory->id === 50)
                            <div class="col-md-6  col-sm-12 mt-2 ">
                                <label for="exampleInputPassword1">House Size(sqft) *</label>
                                <input type="text" class="form-control resetInput" id="house_size" name="house_size"
                                    placeholder="Enter House Size">
                                <span class="text-danger error" id="house_size_error"></span>
                            </div>
                        @else
                        @endif
                        {{-- need to display House Size only when houses and apartments --}}

                        {{-- need to display land type only when houses and apartments --}}
                        @if ($subCategory->id === 48)
                            <div class="col-md-6  col-sm-12 mt-2 ">
                                <label for="exampleInputPassword1">Land Type *</label>
                                <select class="browser-default custom-select  customSelect resetInput" name="land_type"
                                    id="land_type" aria-label="Default select example">
                                    <option value="" selected>Open this select menu</option>
                                    <option value="Agricultural">Agricultural</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="text-danger error" id="land_type_error"></span>
                            </div>
                        @else
                        @endif
                        {{-- need to display land type only when houses and apartments --}}

                        {{-- need to display land size only when houses and apartments --}}
                        @if ($subCategory->id === 48 || $subCategory->id === 49)
                            <div class="col-md-6 col-sm-12 mt-2 combined-input">
                                <label for="landSizeInput">Land Size *</label>
                                <div class="input-wrapper">
                                    <input type="text" class="form-control resetInput" id="landSize" name="landSize"
                                        placeholder="Land Size (e.g., 1000 sqft)">
                                    <select class="form-control small-dropdown" id="landSizeType" name="landSizeType">
                                        <option value="perches">perches</option>
                                        <option value="acres">acres</option>
                                    </select>
                                </div>
                                <span class="text-danger error" id="land_size_error"></span>
                            </div>
                        @else
                        @endif
                        {{-- need to display land size only when houses and apartments --}}

                        {{-- need to display land price only when houses and apartments --}}
                        @if ($subCategory->id === 48)
                            <div class="col-md-6 col-sm-12 mt-2 combined-input">
                                <label for="unit_price">Unit Price *</label>
                                <div class="input-wrapper">
                                    <input type="text" class="form-control resetInput" id="unit_price"
                                        name="unit_price" placeholder="Enter Unit Price">
                                    <select class="form-control small-dropdown" id="UnitPriceType" name="UnitPriceType">
                                        <option value="perches">perches</option>
                                        <option value="acres">acres</option>
                                    </select>
                                </div>
                                <span class="text-danger error" id="unit_price_error"></span>
                            </div>
                        @else
                        @endif
                        {{-- need to display land price only when houses and apartments --}}

                        <div class="col-md-6  col-sm-12 mt-2 ">
                            <label>Negotiable *</label><br>
                            <label class="radio-inline m-2">
                                <input type="radio" name="negotiable" value="1" class="m-1" checked>Yes
                            </label>
                            <label class="radio-inline m-2">
                                <input type="radio" class="m-1" value="0" name="negotiable">No
                            </label>
                        </div>


                        <div class="col-md-12  col-sm-12 mt-2 ">
                            <div class="form-group col-12">
                                <label for="exampleInputPassword1">Description *</label>
                                <textarea class="form-control ckeditor resetInput" id="description" name="description" rows="5"></textarea>
                                <span class="text-danger error" id="description_error"></span>
                            </div>
                        </div>

                        <div class="row m-1">
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Main image *</label>
                                <input type="file" data-height="62" class="form-control dropify" name="main_image"
                                    id="main_image">
                                <span class="text-danger error" id="main_image_error"></span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="exampleInputPassword1">Image one</label>
                                <input data-height="62" type="file" class="form-control dropify" name="image_one"
                                    id="image_one">
                                <span class="text-danger error" id="image_one_error"></span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Image two</label>
                                <input data-height="62" type="file" class="form-control dropify" id="image_two"
                                    name="image_two">
                                <span class="text-danger error" id="image_two_error"></span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="exampleInputPassword1">Image three</label>
                                <input data-height="62" type="file" class="form-control dropify" id="image_three"
                                    name="image_three">
                                <span class="text-danger error" id="image_three_error"></span>
                            </div>
                        </div>
                        <button type="button" id="create_property_post" class="btn btn-primary">Post Ad</button>
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
                                <select name="location" id="location" class="browser-default custom-select location">
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
                    <button type="button" id="getLocationbtn" class="btn btn-primary">Change </button>
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
                height: 200,
            });

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
    </script>
    <script>
        // create electronic post start
        $('#create_property_post').click(function() {

            $('.error').html('');
            document.getElementById("create_property_post").disabled = true; //disable button after click it
            var data = $('#create_property_post_form')[0];
            var data_ajax = new FormData(data); // get form data

            // send form data start 
            $.ajax({
                url: "{{ route('web.dashboard.property.create') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: data_ajax,
                success: function(response) {
                    // reset current inputs
                    $('.dropify').each(function() {
                        $(this).dropify('resetPreview');
                    });
                    $('.resetInput').val('');

                    document.getElementById("create_property_post").disabled =
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
                    document.getElementById("create_property_post").disabled =
                        false; //disable button after click it

                    $('#location_error').html(error.responseJSON.errors.ads_location);
                    $('#sublocation_error').html(error.responseJSON.errors.ads_sublocation);

                    $('#title_error').html(error.responseJSON.errors.title);
                    $('#description_error').html(error.responseJSON.errors.description);
                    $('#price_error').html(error.responseJSON.errors.price);

                    $('#main_image_error').html(error.responseJSON.errors.main_image);
                    $('#image_one_error').html(error.responseJSON.errors.image_one);
                    $('#image_two_error').html(error.responseJSON.errors.image_two);
                    $('#image_three_error').html(error.responseJSON.errors.image_three);

                    $('#address_error').html(error.responseJSON.errors.address);
                    $('#bedrooms_error').html(error.responseJSON.errors.bedrooms);
                    $('#bathrooms_error').html(error.responseJSON.errors.bathrooms);
                    $('#house_size_error').html(error.responseJSON.errors.house_size);
                    $('#land_type_error').html(error.responseJSON.errors.land_type);
                    $('#land_size_error').html(error.responseJSON.errors.landSize);
                    $('#unit_price_error').html(error.responseJSON.errors.unit_price);

                }
            });
            // send form data end
        });
        // create electronic post end
    </script>
@endsection
