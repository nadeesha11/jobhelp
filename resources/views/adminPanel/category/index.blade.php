@extends('adminPanel.layout.adminLayout')

@section('content')
    <div>
        <h4 class="text-center mb-1">Category Management</h4>
    </div>
    <div class="row">
        {{-- start create new admin  --}}
        <div class="col-12 ">
            <div class="card">
                <div style="height: 10px;" class="card-header ">
                    <p class="mt-3">Create category</p>
                </div>
                <div class="card-body">
                    <form id="create_category">
                        <div class="form-group">
                            <input type="text" class="form-control input clear_input" name="category_name"
                                id="category_name" placeholder="Enter Category Name">
                            <span id="category_name_error" class="text-danger clear_form_error"> </span>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control clear_input" name="category_description" placeholder="Enter Category Description"
                                id="category_description" rows="2"></textarea>
                            <span id="category_description_error" class="text-danger clear_form_error"> </span>
                        </div>

                        <div class="form-group" id="dropify_image">
                            <label>Category image</label>
                            <input type="file" data-height="50" class="form-control input clear_input dropify"
                                name="category_image" id="category_image" data-height="200"
                                placeholder="Enter Category Image">
                            <span id="category_image_error" class="text-danger clear_form_error"> </span>
                        </div>

                        <button type="button" id="create_category_btn" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- end create new admin   --}}

        <div class="col-12 ">

            {{-- table for view update delete admins  --}}

            <div class="card">
                <div class="card-header">
                    Category list
                </div>
                <div class="card-body m-1">
                    <table id="category_list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name </th>
                                <th>status</th>
                                <th>more</th>
                                <th>action</th>
                                <th>subcategory</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- end table for view update delete admins --}}
        </div>

    </div>

    {{-- category more modal start  --}}
    <div class="modal fade" id="more_category_details" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">More details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- form start   --}}
                    <form id="edit_post_form">
                        <div class="form-group">
                            <label>created_at </label>
                            <input type="text" class="form-control" readonly id="more_created_at">
                        </div>
                        <div class="form-group">
                            <label>updated_at </label>
                            <input type="text" class="form-control" readonly id="more_updated_at">
                        </div>

                        <div class="form-group">
                            <label>Details</label>
                            <textarea class="form-control clear_input" readonly id="more_description" rows="3"></textarea>
                        </div>

                        <label>Image</label>
                        <div id="display_image">
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" id="edit_package_btn" class="btn btn-primary">Save changes</button> --}}

                    </form>
                    {{-- form end   --}}

                </div>
            </div>
        </div>
    </div>
    {{-- category more modal end  --}}




    {{-- category edit modal start  --}}
    <div class="modal fade" id="edit_category_details" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- form start   --}}
                    <form id="update_category_form">

                        <input type="hidden" class="form-control clear_input" name="id" id="update_id">

                        <div class="form-group">
                            <label>name </label>
                            <input type="text" class="form-control clear_input" name="name" id="edit_name">
                            <span id="edit_name_error" class="text-danger clear_form_error"></span>
                        </div>

                        <div class="form-group">
                            <label>description</label>
                            <textarea class="form-control clear_input" name="description" id="edit_description" rows="3"></textarea>
                            <span id="edit_description_error" class="text-danger clear_form_error"></span>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="dropify_image">
                                    <label>Category image</label>
                                    <input type="file" data-height="85" class="form-control input clear_input dropify"
                                        id="test_dropify" name="category_image" id="category_image"
                                        placeholder="Enter Category Name">
                                    <span id="category_image_edit_error" class="text-danger clear_form_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Current Image</label>
                                <div id="display_image_edit">
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12"> <label class="mr-3">Status</label> </div>
                                <div class="col-12"> <input type="checkbox" class="mr-2" name="cat_status" required
                                        id="cat_status" data-toggle="toggle" data-on="Active" data-off="Deactive"
                                        data-onstyle="success" data-offstyle="danger" data-width="200" data-height="30">
                                </div>
                            </div>
                        </div>


                        {{-- <label >Image</label>
          <div id="display_image">
          </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="update_category_btn" class="btn btn-primary">Save changes</button>

                    </form>
                    {{-- form end   --}}

                </div>
            </div>
        </div>
    </div>
    {{-- category edit modal end  --}}


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


            $('.dropify').dropify();

            //  view data on table start 
            $('#category_list').DataTable({

                processing: true,
                serverSide: true,

                ajax: '{!! route('admin.category.recieveData') !!}',

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'cat_name',
                        name: 'cat_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'more',
                        name: 'more'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'subcategory',
                        name: 'subcategory'
                    },
                ]

            });



            //  view data on table start 

        });
    </script>

    <script>
        $('#create_category_btn').click(function() {

            $('.clear_form_error').html('');

            // to get csrf


            var create_category = $('#create_category')[0];
            var create_category_ajax = new FormData(create_category); // get form data

            // ajax post start 
            $.ajax({

                url: "{{ route('admin.category.create') }}",
                method: "POST",

                processData: false,
                contentType: false,
                data: create_category_ajax,
                success: function(response) {

                    // $('.dropify').dropify(); //test

                    var drEvent = $('.dropify').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();



                    if (response.code == "true") {

                        Swal.fire({
                            title: 'Success!',
                            icon: 'success',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg
                    }

                    $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    $('#category_list').DataTable().ajax.reload();
                    // location.reload(true);


                },

                error: function(error) {

                    console.log(error);

                    // display validations in created admin 

                    $('#category_name_error').html(error.responseJSON.errors.category_name);
                    $('#category_description_error').html(error.responseJSON.errors
                        .category_description);
                    $('#category_image_error').html(error.responseJSON.errors.category_image);

                }
            });
            // ajax post end 
        });


        // more details start 
        $('body').on('click', '.more', function() {

            var id = $(this).data('id');
            // get ajax data start 
            $.ajax({

                url: '{{ url('admin/category') }}' + '/' + id + '/more',
                method: 'GET',
                success: function(response) {

                    $('#more_category_details').modal('show');

                    console.log(response);
                    $('#more_created_at').val(response.created_at);
                    $('#more_updated_at').val(response.updated_at);
                    $('#more_description').val(response.cat_description);

                    var display_image = document.getElementById('display_image');
                    var img = '';
                    img +=
                        '<img height="70px" weight="100" src="{{ asset('/uploaded_images/cat_images/') }}/' +
                        response.cat_image + '" alt="">';
                    display_image.innerHTML = img;
                },
                error: function(error) {}
            });
            // ajax code end

        });
        // more details end 


        //  start delete category 
        $('body').on('click', '.delete_category', function() {

            var id = $(this).data('id');
            if (confirm("Are you sure you want to delete record ? ")) {

                $.ajax({

                    url: '{{ url('admin/category') }}' + '/' + id + '/delete',
                    method: 'GET',
                    success: function(response) {

                        if (response.code == "true") {

                            Swal.fire({
                                icon: 'success',

                                text: response.msg,

                            })
                        }
                        if (response.code == "false") {

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.msg,

                            })
                        }
                        $('#category_list').DataTable().ajax.reload();


                    },
                    error: function(error) {

                    }
                });

            }
        });
        // end category  delete


        // edit category data start 

        $('body').on('click', '.edit_category', function() {

            var drEvent = $('#test_dropify').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement(); //clear dropify image


            $('.clear_input').val('');
            $('.clear_form_error').html(''); //clear validation and input values(old)

            var id = $(this).data('id');
            // get ajax data start 
            $.ajax({

                url: '{{ url('admin/category') }}' + '/' + id + '/edit',
                method: 'GET',
                success: function(response) {

                    console.log(response);

                    $('#edit_category_details').modal('show');

                    // console.log(response);
                    $('#update_id').val(response.id);
                    $('#edit_name').val(response.cat_name);
                    $('#edit_description').val(response.cat_description);

                    if (response.status == 0) {

                        $('#cat_status').bootstrapToggle('off');
                    } else {
                        $('#cat_status').bootstrapToggle('on');

                    }

                    var display_image = document.getElementById('display_image_edit');
                    var img = '';
                    img += '<img height="95px"  src="{{ asset('/uploaded_images/cat_images/') }}/' +
                        response.cat_image + '" alt="">';
                    display_image.innerHTML = img;
                },
                error: function(error) {}
            });
            // ajax code end
        });
        // edit category data end 


        // update form data start 
        $('#update_category_btn').click(function() {

            $('.clear_form_error').html('');

            var update_category = $('#update_category_form')[0];
            var update_category_ajax = new FormData(update_category); // get form data

            // ajax post start 
            $.ajax({

                url: "{{ route('admin.category.update') }}",
                method: "POST",

                processData: false,
                contentType: false,
                data: update_category_ajax,
                success: function(response) {

                    // console.log(response);
                    if (response.code == "true") {

                        Swal.fire({
                            title: 'Success!',
                            icon: 'success',

                            text: response.msg,
                            confirmButtonText: 'OK'

                        })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg
                    }

                    $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    $('#edit_category_details').modal('hide');
                    $('#category_list').DataTable().ajax.reload();

                },

                error: function(error) {

                    $('#edit_name_error').html(error.responseJSON.errors.name);
                    $('#edit_description_error').html(error.responseJSON.errors.description);
                    $('#category_image_edit_error').html(error.responseJSON.errors.category_image);

                }
            });
            // ajax post end 
        });
        // update form data end 



        // start access subcategory 
        $('body').on('click', '.subcategory', function() {

            var id = $(this).data('id');
            let url = '{{ url('admin/subcategory') }}' + '/' + id + '/index';
            location.href = url;

        });
        // end access subcategory 
    </script>
@endsection
