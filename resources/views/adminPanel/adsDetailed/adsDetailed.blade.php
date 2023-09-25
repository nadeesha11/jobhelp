@extends('adminPanel.layout.adminLayout')
@section('content')
    <div>
        <h4 class="text-center mb-1">Ads Detailed</h4>
    </div>
    <div class="row">
        <div class="col-12 ">
            {{-- table for view update delete admins  --}}
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" id="changeStatus">Change Ad Status</button>
                </div>

                <div class="card-body m-1">
                    <div class="raw">
                        <div class="col-md-12">
                            <div class="jumbotron">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end table for view update delete admins --}}
        </div>
    </div>

    <div class="modal fade" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#changeStatus').click(function() {
            alert('clicked')
        })
    </script>
@endsection
