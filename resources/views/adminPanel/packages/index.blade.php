@extends('adminPanel.layout.adminLayout')

@section('content')
    <div>
        <h3 class="text-center mb-3">Ad Category Management</h3>
    </div>

    <div class="row">

        <div class="col-12 ">
            {{-- table for view update delete admins  --}}
            <div class="card">
                <div class="card-header">
                    category list
                </div>
                <div class="card-body m-3">
                    <table id="package_list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>ad category</th>
                                <th>status</th>
                                <th>action</th>
                                <th>ad type</th>
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

    {{-- admin edit modal start  --}}
    <div class="modal fade" id="edit_package_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    {{-- form start   --}}
                    <form id="edit_post_form">

                        <input type="hidden" name="id" id="package_id">

                        <div class="form-group">
                            <label>Package Name </label>
                            <input type="text" class="form-control" name="name" id="package_name_edit"
                                placeholder="Enter Package Name">
                            <span id="package_name_edit_error" class="text-danger clear_form_error"> </span>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12"> <label class="mr-3">Status</label> </div>
                                <div class="col-12"> <input type="checkbox" class="mr-2" name="package_status" required
                                        id="package_status" data-toggle="toggle" data-on="Active" data-off="Deactive"
                                        data-onstyle="success" data-offstyle="danger" data-width="200" data-height="30">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="edit_package_btn" class="btn btn-primary">Save changes</button>
                    </form>
                    {{-- form end   --}}
                </div>
            </div>
        </div>
    </div>
    {{-- admin edit modal end  --}}

    <script>
        $(document).ready(function() {
            //start display data using datatbles through yajra 
            $('#package_list').DataTable({

                processing: true,
                serverSide: true,

                ajax: '{!! route('admin.recievePackages') !!}',

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'package_name',
                        name: 'package_name'
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
                        data: 'ad_type',
                        name: 'ad_type'
                    },
                ]

            });
            //end display data using datatbles through yajra 
        });
    </script>

    <script>
        // to get csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // edit package start 
        $('body').on('click', '.edit_package', function() {

            var id = $(this).data('id');
            $('.clear_form_error').html('');

            // get ajax data start 
            $.ajax({
                url: '{{ url('admin/package') }}' + '/' + id + '/editData',
                method: 'GET',
                success: function(response) {
                    if (response.status == 0) {
                        $('#package_status').bootstrapToggle('off');
                    } else {
                        $('#package_status').bootstrapToggle('on');
                    }
                    $('#package_id').val(response.id);
                    $('#package_name_edit').val(response.package_name);

                },
                error: function(error) {}
            });

            $('#edit_package_modal').modal('show');

        });
        // edit package end

        // update record start
        $('#edit_package_btn').click(function() {

            $('.clear_form_error').html('');

            var form_update = $('#edit_post_form')[0];
            var form_update_ajax = new FormData(form_update);

            // start send updated data through ajax 
            $.ajax({
                url: "{{ route('admin.package.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_update_ajax,
                success: function(response) {
                    $('.clear_form_error').html('');
                    $('#edit_package_modal').modal('hide');

                    if (response.code == "true") {
                        Swal.fire({
                            icon: 'success',
                            //  title: response.msg,
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
                    $('#package_list').DataTable().ajax.reload();
                },
                error: function(error) {
                    $('#package_name_edit_error').html(error.responseJSON.errors.name);
                }
            });

        })
        // update record start

        // delete package start 
        $('body').on('click', '.delete_package', function() {

            var id = $(this).data('id');
            if (confirm("Are you sure you want to delete record ? ")) {
                $.ajax({
                    url: '{{ url('admin/package') }}' + '/' + id + '/delete',
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
                        $('#package_list').DataTable().ajax.reload();
                    },
                    error: function(error) {}
                });
            }
        });
        // delete package end 

        // access ad type
        $('body').on('click', '.ad_type', function() {

            var id = $(this).data('id');
            // Construct the new URL with the parameter
            var newUrl = '{{ route('admin.adsType', ['id' => ':id']) }}';
            newUrl = newUrl.replace(':id', id);

            // Set the new URL and trigger a page refresh
            window.location.href = newUrl;
        });
        // access ad type
    </script>
@endsection
