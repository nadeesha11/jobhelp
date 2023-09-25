@extends('adminPanel.layout.adminLayout')

@section('content')
    <div>
        <h4 class="text-center mb-1">Subcategory Brands Management</h4>
    </div>


    <div class="row">
        {{-- start create new admin  --}}
        <div class="col-12 ">
            <div class="card">
                <div style="height: 10px;" class="card-header ">
                    <p class="mt-3">Create subcategory brands</p>
                </div>
                <div class="card-body">

                    <form id="create_brands">

                        <input type="hidden" name="id" id="hidden_id" value="{{ $id }}">
                        <div class="form-group">
                            <input type="text" class="form-control input clear_input" name="brand" id="brand"
                                placeholder="Enter Brand Name">
                            <span id="brand_error" class="text-danger clear_form_error"> </span>
                        </div>

                        <button type="button" id="create_brand_btn" class="btn btn-primary">Create</button>
                    </form>

                </div>
            </div>
        </div>
        {{-- end create new admin   --}}

        <div class="col-12 ">

            {{-- table for view update delete admins  --}}

            <div class="card">
                <div class="card-header">
                    Sub Category brands list
                </div>
                <div class="card-body m-1">



                    <table id="brands_list" class="table table-striped">
                        <thead>
                            <tr>

                                <th>id</th>
                                <th>name </th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>status</th>
                                <th>action</th>
                                <th>model</th>

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
    <div class="modal fade" id="more_sub_category_details" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <textarea class="form-control " readonly id="more_description" rows="3"></textarea>
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
    <div class="modal fade" id="edit_sub_category_brand" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Model</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- form start   --}}
                    <form id="update_brands_form">
                        <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                        <div class="form-group">
                            <label>name</label>
                            <input type="text" class="form-control clear_input" name="name" id="edit_name">
                            <span id="update_name_error" class="text-danger clear_form_error"></span>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12"> <label class="mr-3">Status</label> </div>
                                <div class="col-12"> <input type="checkbox" class="mr-2" name="brand_status" required
                                        id="brand_status" data-toggle="toggle" data-on="Active" data-off="Deactive"
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
                    <button type="button" id="update_brand_btn" class="btn btn-primary">Save changes</button>

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
            //  view data on table start 
            var id = $('#hidden_id').val();
            var brands = '{!! url('admin/subcategoryBrands/getData') !!}' + '/' + id;

            // view data on table start 
            $('#brands_list').DataTable({

                processing: true,
                serverSide: true,
                ajax: brands,

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'model',
                        name: 'model'
                    },

                ]

            });
            //  view data on table end 
        });
    </script>

    <script>
        //   create brands start 
        $('#create_brand_btn').click(function() {

            $('.clear_form_error').html('');
            var create_brands = $('#create_brands')[0];
            var create_brands_ajax = new FormData(create_brands); // get form data

            // ajax post start 
            $.ajax({

                url: "{{ route('admin.subcategoryBrands.create') }}",
                method: "POST",

                processData: false,
                contentType: false,
                data: create_brands_ajax,
                success: function(response) {

                    console.log(response);
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
                    $('#brands_list').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    $('#brand_error').html(error.responseJSON.errors.brand);
                }
            });
        });
        // create brands end 


        // delete brand start 
        $('body').on('click', '.delete_brand', function() {

            var id = $(this).data('id');

            //start send delete id using ajax 
            if (confirm("Are you sure you want to delete record ? ")) {

                $.ajax({

                    url: '{{ url('admin/subcategoryBrand') }}' + '/' + id + '/delete',
                    method: 'GET',
                    success: function(response) {

                        console.log(response);

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
                        $('#brands_list').DataTable().ajax.reload();
                    },
                    error: function(error) {}
                });
            }
            //end send delete id using ajax 
        });
        // delete brands end 

        // edit brands start 
        $('body').on('click', '.edit_brand', function() {
            $('.clear_form_error').html('');
            var id = $(this).data('id');
            $.ajax({

                url: '{{ url('admin/subcategoryBrand') }}' + '/' + id + '/edit',
                method: 'GET',
                success: function(response) {
                    $('#edit_sub_category_brand').modal('show');
                    // console.log(response);
                    $('#update_id').val(response.id);
                    $('#edit_name').val(response.brand_name);

                    if (response.status == 0) {
                        $('#brand_status').bootstrapToggle('off');
                    } else {
                        $('#brand_status').bootstrapToggle('on');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
        // edit brands end 

        // update brand start 
        $('#update_brand_btn').click(function() {


            $('.clear_form_error').html('');

            var update_brand = $('#update_brands_form')[0];
            var update_brand_ajax = new FormData(update_brand); // get form data

            // ajax post start 
            $.ajax({

                url: "{{ route('admin.subcategoryBrand.update') }}",
                method: "POST",

                processData: false,
                contentType: false,
                data: update_brand_ajax,
                success: function(response) {

                    console.log(response);

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
                    $('#edit_sub_category_brand').modal('hide');
                    $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    $('#brands_list').DataTable().ajax.reload();
                },
                error: function(error) {
                    $('#update_name_error').html(error.responseJSON.errors.name);
                }
            });
        });
        // update brand end 

        // start access subcategory types 
        $('body').on('click', '.model', function() {

            var id = $(this).data('id');
            console.log(id);
            let url = '{{ url('admin/subcategoryTypesModel') }}' + '/' + id + '/index';
            location.href = url;

        });
        // end access subcategory types
    </script>
@endsection
