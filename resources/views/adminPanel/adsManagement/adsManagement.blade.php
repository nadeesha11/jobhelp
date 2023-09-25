@extends('adminPanel.layout.adminLayout')

@section('content')
    <div>
        <h4 class="text-center mb-1">Ads Management</h4>
    </div>
    <div class="row">
        <div class="col-12 ">
            {{-- table for view update delete admins  --}}
            <div class="card">
                <div class="card-header">
                    ads list
                </div>
                <div class="card-body m-1">
                    <table id="category_list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>title</th>
                                <th>ad type</th>
                                <th>status</th>
                                <th>more</th>
                                <th>action</th>
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
    <div class="modal fade" id="more_category_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="action_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Ad Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- form start   --}}
                    <form id="update_status_form">
                        <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12"> <label class="mr-3">Status</label> </div>
                                <div class="col-12"> <input type="checkbox" class="mr-2" name="status" required
                                        id="cat_status" data-toggle="toggle" data-on="Active" data-off="Deactive"
                                        data-onstyle="success" data-offstyle="danger" data-width="200" data-height="30">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="update_status_btn" class="btn btn-primary">Save changes</button>
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
                ajax: {
                    url: '{!! route('admin.adsManagement.recieveData') !!}',
                    data: function(d) {
                        d.order = [{
                            column: 0,
                            dir: 'desc'
                        }]; // Order by the first column (assuming it's the 'id' column) in descending order
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'ads_title',
                        name: 'ads_title'
                    },
                    {
                        data: 'ads_type',
                        name: 'ads_type'
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
                ]
            });

            //  view data on table start 
        });
    </script>

    <script>
        $('#update_status_btn').click(function() {
            var update_data = $('#update_status_form')[0];
            var update_data_ajax = new FormData(update_data); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('admin.adManagement.update.status') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: update_data_ajax,
                success: function(response) {
                    if (response.code == 1) {

                        Swal.fire({
                            title: 'Success!',
                            icon: 'success',
                            text: response.msg,
                            confirmButtonText: 'OK'

                        })
                    } else if (response.code == 0) {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg 
                    }
                    $('#action_modal').modal('hide');
                    $('#category_list').DataTable().ajax.reload();

                },

                error: function(error) {}
            });
        });

        $('body').on('click', '.action', function() {
            var id = $(this).data('id');
            // get ajax data start 
            $.ajax({
                url: '{{ url('/admin/adsManagement') }}' + '/' + id + '/detailed',
                method: 'GET',
                success: function(response) {
                    $('#update_id').val(response.id)
                    if (response.status == 0) {
                        $('#cat_status').bootstrapToggle('off');
                    } else {
                        $('#cat_status').bootstrapToggle('on');
                    }
                    $('#action_modal').modal('show');
                },
                error: function(error) {}
            });
            // ajax code end
        });

        // more details start 
        $('body').on('click', '.more', function() {

            var id = $(this).data('id');
            let url = '{{ url('/admin/adsmanagement') }}' + '/' + id + '/index/detailed';
            location.href = url;

        });
        // more details end 
    </script>
@endsection
