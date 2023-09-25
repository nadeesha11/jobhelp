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

        .inputCustom {
            border: 1px solid #a6b0cf !important;
            border-radius: 0.3rem !important;
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

                <form id="create_service_post_form">

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

                        <div class="col-lg-6 col-12 ">
                            <div class="col-12 mt-2 ">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control inputCustom resetInput" id="title"
                                    name="title" placeholder="Enter title">
                                <span class="text-danger error" id="title_error"></span>
                            </div>

                            <div class="col-12 mt-2 ">
                                <label for="exampleInputEmail1">Type</label>
                                <select class="browser-default custom-select  customSelect  resetInput" name="serviceType"
                                    id="serviceType" aria-label="Default select example">
                                    <option value="" selected>Open this select menu</option>
                                    @foreach ($subCategoryTypes as $one)
                                        <option value="{{ $one->id }}">{{ $one->sct_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" id="serviceType_error"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 ">
                            <div class="col-12 mt-2 ">
                                <label for="exampleInputPassword1">Price</label>
                                <input type="number" class="form-control inputCustom resetInput" id="price"
                                    name="price" placeholder="Enter price">
                                <span class="text-danger error" id="price_error"></span>
                            </div>
                            <div class="col-12 mt-3 ">
                                <label for="exampleInputEmail1">Negotiable</label><br>
                                <label class="radio-inline m-2">
                                    <input type="radio" name="negotiable" value="1" class="m-1" checked>Yes
                                </label>
                                <label class="radio-inline m-2">
                                    <input type="radio" class="m-1" value="0" name="negotiable">No
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row m-1">
                        <div class="form-group col-12">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control ckeditor resetInput" id="description" name="description" rows="5"></textarea>
                            <span class="text-danger error" id="description_error"></span>
                        </div>
                    </div>

                    <div class="row m-1">
                        <div class="form-group col-lg-3">
                            <label for="exampleInputEmail1">Main image</label>
                            <input type="file" data-height="62" class="form-control dropify" name="main_image"
                                id="main_image">
                            <span class="text-danger error" id="main_image_error"></span>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputPassword1">Image one (optional)</label>
                            <input data-height="62" type="file" class="form-control dropify" name="image_one"
                                id="image_one">
                            <span class="text-danger error" id="image_one_error"></span>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputEmail1">Image two (optional)</label>
                            <input data-height="62" type="file" class="form-control dropify" id="image_two"
                                name="image_two">
                            <span class="text-danger error" id="image_two_error"></span>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputPassword1">Image three (optional)</label>
                            <input data-height="62" type="file" class="form-control dropify" id="image_three"
                                name="image_three">
                            <span class="text-danger error" id="image_three_error"></span>
                        </div>
                    </div>

                    {{-- this is testing reviwed by se  end --}}
                    {{-- Features end  --}}
                    <button type="button" id="create_service_post" class="btn btn-primary">Post Ad</button>
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

        //   create service ad start 
        $('#create_service_post').click(function() {

            $('.error').html(''); //clear validation errors
            document.getElementById("create_service_post").disabled = true; //disable button after click it
            var data = $('#create_service_post_form')[0];
            var dataAjax = new FormData(data);

            // ajax call start
            $.ajax({
                url: "{{ route('web.dashboard.service.create') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: dataAjax,
                success: function(response) {
                    // clear all inputs after 
                    $('.resetInput').val('');
                    $('.dropify').each(function() {
                        $(this).dropify('resetPreview');
                    });
                    document.getElementById("create_service_post").disabled =
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
                    document.getElementById("create_service_post").disabled =
                        false; //enable button after click it

                    $('#location_error').html(error.responseJSON.errors.ads_location);
                    $('#sublocation_error').html(error.responseJSON.errors.ads_sublocation);
                    $('#title_error').html(error.responseJSON.errors.title);
                    $('#price_error').html(error.responseJSON.errors.price);
                    $('#serviceType_error').html(error.responseJSON.errors.serviceType);
                    $('#description_error').html(error.responseJSON.errors.description);
                    $('#main_image_error').html(error.responseJSON.errors.main_image);
                    $('#image_one_error').html(error.responseJSON.errors.image_one);
                    $('#image_two_error').html(error.responseJSON.errors.image_two);
                    $('#image_three_error').html(error.responseJSON.errors.image_three);

                }
            });

            // ajax call end
        });

        //   create service ad start 
    </script>
@endsection
