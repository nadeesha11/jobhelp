@extends('adminPanel.layout.adminLayout')
@section('content')
    <div>
        <h4 class="text-center mb-1">Ad Type Management</h4>
    </div>
    <div class="row">
        {{-- start create new ads types  --}}
        <div class="col-4">
            <div class="card">
                <div style="height: 10px;" class="card-header ">
                    <p class="mt-3">create ad type</p>
                </div>
                <div class="card-body">
                    <form id="create_ad_type_form">
                        <input type="hidden" name="id" id="hidden_id" value="{{ $id }}">
                        <div class="form-group">
                            <input type="text" class="form-control input clear_input" name="ad_type_name"
                                id="ad_type_name" placeholder="Enter Ad Type Name">
                            <span id="ad_type_name_error" class="text-danger clear_form_error"> </span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input clear_input" name="ad_type_duration"
                                id="ad_type_duration" placeholder="Enter Duration">
                            <span id="ad_type_duration_error" class="text-danger clear_form_error"> </span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input clear_input" name="ad_type_price"
                                id="ad_type_price" placeholder="Enter Price">
                            <span id="ad_type_price_error" class="text-danger clear_form_error"> </span>
                        </div>
                        <button type="button" id="create_ad_type_btn" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- end create ads types   --}}

        <div class="col-8">
            {{-- table for view update delete ads types  --}}
            <div class="card">
                <div class="card-header">
                    ad types list
                </div>
                <div class="card-body m-1">
                    <table id="ads_types_list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>duration (Days)</th>
                                <th>price (Rs)</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- end table for view update delete ads types --}}
        </div>
    </div>

    {{-- ads types edit modal start  --}}
    <div class="modal fade" id="ads_types_modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ads Types</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_ads_types_form">
                        <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control clear_input" name="name" id="edit_name">
                            <span id="update_name_error" class="text-danger clear_form_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Duration (Days)</label>
                            <input type="text" class="form-control clear_input" name="duration" id="edit_duration">
                            <span id="update_duration_error" class="text-danger clear_form_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Price (LKR)</label>
                            <input type="text" class="form-control clear_input" name="price" id="edit_price">
                            <span id="update_price_error" class="text-danger clear_form_error"></span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12"> <label class="mr-3">Status</label> </div>
                                <div class="col-12"> <input type="checkbox" class="mr-2" name="ads_status_status" required
                                        id="ads_status_status_edit" data-toggle="toggle" data-on="Active"
                                        data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                        data-width="200" data-height="30">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="update_ads_types_btn" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ads types edit modal end  --}}

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

            var id = $('#hidden_id').val();
            var display_ads_types = '{!! url('admin/display_ads_types') !!}' + '/' + id;

            //  view data on table start 
            $('#ads_types_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: display_ads_types,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'duration',
                        name: 'duration'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            //  view data on table start 
        });
    </script>

    <script>
        // create ads types start 
        $('#create_ad_type_btn').click(function() {

            $('.clear_form_error').html('');
            var create_ad_type_form = $('#create_ad_type_form')[0];
            var ad_type_form_ajax = new FormData(create_ad_type_form); // get form data
            $('#create_ad_type_btn').disabled = true;
            // ajax post start 
            $.ajax({
                url: "{{ route('admin.ad_type.create') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: ad_type_form_ajax,
                success: function(response) {
                    $('#create_ad_type_btn').disabled = false;
                    if (response.code == "true") {
                        Swal.fire({
                            title: 'Success!',
                            icon: 'success',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        })
                    } else if (response.code == "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something Went Wrong',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg   
                    }
                    $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    $('#ads_types_list').DataTable().ajax.reload();
                },
                error: function(error) {
                    $('#create_ad_type_btn').disabled = false;
                    $('#ad_type_name_error').html(error.responseJSON.errors.ad_type_name);
                    $('#ad_type_duration_error').html(error.responseJSON.errors
                        .ad_type_duration);
                    $('#ad_type_price_error').html(error.responseJSON.errors
                        .ad_type_price);
                }
            });
        });
        // create ads types end 

        // edit ads types start 
        $('body').on('click', '.edit_', function() {
            $('#ads_types_modal_edit').modal('show');
            $('.clear_form_error').html('');
            var id = $(this).data('id');
            $.ajax({
                url: '{{ url('admin/ads_types') }}' + '/' + id + '/edit',
                method: 'GET',
                success: function(response) {
                    $('#ads_types_modal_edit').modal('show');
                    $('#update_id').val(response.id);
                    $('#edit_name').val(response.name);
                    $('#edit_duration').val(response.duration);
                    $('#edit_price').val(response.price);
                    if (response.status == 0) {
                        $('#ads_status_status_edit').bootstrapToggle('off');
                    } else {
                        $('#ads_status_status_edit').bootstrapToggle('on');
                    }
                },
                error: function(error) {
                }
            });
        });
        //edit ads types end 

        // start update ads types 
        $('#update_ads_types_btn').click(function() {
            $('#update_ads_types_btn').disabled = true;
            $('.clear_form_error').html('');
            var update_ads_types = $('#update_ads_types_form')[0];
            var update_ads_types_ajax = new FormData(update_ads_types); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('admin.ads_types.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: update_ads_types_ajax,
                success: function(response) {
                    $('#update_ads_types_btn').disabled = false;
                    if (response.code == "true") {
                        Swal.fire({
                            title: 'Success!',
                            icon: 'success',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        })
                    } else if (response.code == "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg
                    } else if (response.code == "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg
                    }
                    $('#ads_types_modal_edit').modal('hide');
                    $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    $('#ads_types_list').DataTable().ajax.reload();
                },
                error: function(error) {
                    // display validations in ads types
                    $('#update_ads_types_btn').disabled = false;
                    $('#update_name_error').html(error.responseJSON.errors.name);
                    $('#update_duration_error').html(error.responseJSON.errors.duration);
                    $('#update_price_error').html(error.responseJSON.errors.price);
                }
            });
        })
        // end update ads types  

        // deactivate ads types start 
        $('body').on('click', '.delete_', function() {

            var id = $(this).data('id');
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this item.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send delete request using AJAX
                    $.ajax({
                        url: '{{ url('admin/ad_type') }}' + '/' + id +
                            '/delete', // Replace with your actual delete route
                        method: 'GET',
                        success: function(response) {
                            if (response.code == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    text: response.msg,
                                });
                            }
                            if (response.code == "false") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.msg,
                                });
                            }
                            // Reload the DataTable
                            $('#ads_types_list').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            });
            //end send delete id using ajax 
        });
        // delete ads types end 
    </script>
@endsection
