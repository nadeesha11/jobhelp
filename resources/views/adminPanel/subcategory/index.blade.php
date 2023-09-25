@extends('adminPanel.layout.adminLayout')

@section('content')

<div>
    <h4 class="text-center mb-1">Subcategory Management</h4>
    </div>
  
  
    <div class="row">
      
      {{-- start create new admin  --}}
      <div class="col-12 ">
          <div class="card" >
              <div style="height: 10px;" class="card-header ">
                
                <p class="mt-3">Create sub category</p>
                
              </div>
              <div class="card-body">
  
                    <form id="create_sub_category">
                    
                        <input type="hidden" name="id" id="hidden_id" value="{{ $id }}">
                        <div class="form-group">
                          <input type="text" class="form-control input clear_input"  name="sub_category_name" id="sub_category_name"   placeholder="Enter Sub Category Name">
                          <span id="sub_category_name_error" class="text-danger clear_form_error">    </span>
                        </div>

                        <div class="form-group" >
                           
                            <textarea class="form-control clear_input" name="sub_category_description" placeholder="Enter Sub Category Description" id="sub_category_description" rows="2"></textarea>
                            <span id="sub_category_description_error" class="text-danger clear_form_error">    </span>
                          </div>

                      <button type="button" id="create_sub_category_btn" class="btn btn-primary">Create</button>
                    </form>
                
              </div>
            </div>
      </div>
      {{-- end create new admin   --}}
  
      <div class="col-12 ">
  
        {{-- table for view update delete admins  --}}
  
          <div class="card">
          <div class="card-header">
          Sub Category list
          </div>
          <div class="card-body m-1">
  
            
  
        <table id="sub_category_list" class="table table-striped">
          <thead>
            <tr>
  
              <th >id</th>
              <th >name </th>
              <th >status</th>
              <th >more</th>
              <th >action</th>
              <th >types</th>
              <th >brands</th>
             
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
  <div class="modal fade" id="more_sub_category_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label >created_at </label>
            <input type="text" class="form-control" readonly id="more_created_at"  >
          </div>
          <div class="form-group">
            <label >updated_at </label>
            <input type="text" class="form-control" readonly  id="more_updated_at"  >
          </div>
  
          <div class="form-group">
            <label >Details</label>
            <textarea class="form-control " readonly  id="more_description" rows="3"></textarea>
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
  <div class="modal fade" id="edit_sub_category_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        {{-- form start   --}}
        <form id="update_subcategory_form">

          <input type="hidden" class="form-control clear_input" name="id"  id="update_id"  >

          <div class="form-group">
            <label >name</label>
            <input type="text" class="form-control clear_input" name="name"  id="edit_name"  >
            <span id="update_name_error" class="text-danger clear_form_error"></span>
          </div>
  
          <div class="form-group">
            <label >description</label>
            <textarea class="form-control clear_input" name="description"   id="edit_description" rows="3"></textarea>
            <span id="update_description_error" class="text-danger clear_form_error"></span>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-12"> <label class="mr-3">Status</label> </div>
              <div class="col-12"> <input type="checkbox" class="mr-2"  name="subcat_status" required    id="sub_cat_status"  data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" data-width="200" data-height="30"> </div>
            </div>
          </div>
        
  
          {{-- <label >Image</label>
          <div id="display_image">
          </div> --}}
         
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="update_subcategory_btn" class="btn btn-primary">Save changes</button>
  
        </form>
        {{-- form end   --}}
  
          </div>
        </div>
      </div>
    </div>
  {{-- category edit modal end  --}}
      

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script>
    $(document).ready(function() {
     
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 


        var id =  $('#hidden_id').val();
        // var display_subcategory =  '{!! url('admin/subcategory/getdata',) !!}'+'/'+id;
        var display_subcategory =  '{!! url('admin/subcategory',) !!}'+'/'+id;

    //  view data on table start 
    $('#sub_category_list').DataTable({

        processing: true,
        serverSide: true,
        ajax: display_subcategory ,
        
        columns: [
            { data: 'id', name: 'id'},
            { data: 'sub_cat_name', name: 'sub_cat_name'},
            { data: 'status', name: 'status'},
            { data: 'more', name: 'more'},
            { data: 'action', name: 'action'},       
            { data: 'types', name: 'types'}, 
            { data: 'brands', name: 'brands'}, 

        ]
    
        });
    //  view data on table start 
        });

      </script>
        
      <script>
        // create sub caregroy start 
    $('#create_sub_category_btn').click(function () {

    $('.clear_form_error').html('');        
    var create_sub_category = $('#create_sub_category')[0];
    var create_sub_category_ajax = new FormData(create_sub_category); // get form data

    // ajax post start 
        $.ajax({

    url:"{{ route('admin.subcategory.create') }}",
    method:"POST",

    processData: false,
    contentType: false,
    data:create_sub_category_ajax,
    success: function(response){  
 
    if(response.code == "true"){
 
    Swal.fire({
    title: 'Success!',
    icon: 'success',
    text: response.msg,
    confirmButtonText: 'OK'

    })
    }
    else{
      Swal.fire({
                    title: 'Error!',
                    text: response.msg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                    })//display error msg
    }

    $('.clear_input').val('');
    $('.clear_form_error').html('');
    $('#sub_category_list').DataTable().ajax.reload(); 

    },

    error:function(error){

    //   console.log(error);

    // display validations in created admin 
    $('#sub_category_name_error').html(error.responseJSON.errors.sub_category_name);
    $('#sub_category_description_error').html(error.responseJSON.errors.sub_category_description);
    // $('#category_image_error').html(error.responseJSON.errors.category_image);
    }
    });
    });
    // create sub caregroy end 
 
    // start more details 
    $('body').on('click','.more',function(){

    var id = $(this).data('id');
     // get ajax data start 
     $.ajax({

    url:'{{ url("admin/subcategory",) }}' + '/'+ id + '/more',
    method:'GET',
    success: function(response){

    $('#more_sub_category_details').modal('show');

    var newCreateAt = new Date(response.created_at);
    var newCreateAtDisplay = moment(newCreateAt).format('LLL');
  
    $('#more_created_at').val(newCreateAtDisplay);
    $('#more_updated_at').val(response.updated_at);
    $('#more_description').val(response.sub_cat_description);

  
},
    error: function(error){  
}
});
// ajax code end

    });
     // end more details 


    // edit subcategory start 
    $('body').on('click','.edit_sub_category',function(){

      $('.clear_form_error').html('');
        
        var id = $(this).data('id');
            $.ajax({

    url:'{{ url("admin/subcategory",) }}' + '/'+ id + '/edit',
    method:'GET',
    success: function(response){

    $('#edit_sub_category_details').modal('show');

    console.log(response);
    $('#update_id').val(response.id);
    $('#edit_name').val(response.sub_cat_name);
    $('#edit_description').val(response.sub_cat_description);

    if(response.status == 0){

    $('#sub_cat_status').bootstrapToggle('off');
    }
    else{
    $('#sub_cat_status').bootstrapToggle('on');

    }


    },
    error: function(error){ 
        
        console.log(error);
    }
    });
    });
    //edit sybcategory end 


    // start update subcat 
    $('#update_subcategory_btn').click(function () { 

      $('.clear_form_error').html('');

      var update_subcategory = $('#update_subcategory_form')[0];
      var update_subcategory_ajax = new FormData(update_subcategory); // get form data
      
       // ajax post start 
       $.ajax({

        url:"{{ route('admin.subcategory.update') }}",
        method:"POST",

        processData: false,
        contentType: false,
        data:update_subcategory_ajax,
        success: function(response){  

        console.log(response);

        if(response.code == "true"){

        Swal.fire({
        title: 'Success!',
        icon: 'success',
        text: response.msg,
        confirmButtonText: 'OK'

        })
        }
        else{
          Swal.fire({
                        title: 'Error!',
                        text: response.msg,
                        icon: 'error',
                        confirmButtonText: 'OK'
                        })//display error msg
        }
        $('#edit_sub_category_details').modal('hide');
        $('.clear_input').val('');
        $('.clear_form_error').html('');
        $('#sub_category_list').DataTable().ajax.reload(); 

        },

        error:function(error){

          // console.log(error);

        // display validations in created admin 
        $('#update_name_error').html(error.responseJSON.errors.name);
        $('#update_description_error').html(error.responseJSON.errors.description);

        }
        });
        })
    // end update subcat  
    
    // delete subcategory start 
    $('body').on('click','.delete_sub_category',function(){

      var id = $(this).data('id');

      //start send delete id using ajax 
      if(confirm("Are you sure you want to delete record ? ")){

      $.ajax({

      url:'{{ url("admin/subcategory",) }}' + '/'+ id + '/delete',
      method:'GET',
      success: function(response){

      console.log(response);

            if(response.code == "true"){

          Swal.fire({
          icon: 'success',

          text: response.msg,

          })
          }
          if(response.code == "false"){

          Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: response.msg,

          })
          }
      $('#sub_category_list').DataTable().ajax.reload();
      },
          error: function(error){
      }
      });
      }
      //end send delete id using ajax 
    });
     // delete subcategory end 

       // start access subcategory types 
       $('body').on('click','.subCategoryTypes',function(){

      var id = $(this).data('id');
      let url = '{{ url('admin/subcategoryTypes') }}'+'/'+id+'/index';
      location.href = url;

      });
      // end access subcategory types


        // start access subcategory types 
        $('body').on('click','.brands',function(){

        var id = $(this).data('id');
        let url = '{{ url('admin/subcategory/brands') }}'+'/'+id+'/index';
        location.href = url;

        });
        // end access subcategory types

    






 
    </script>

    @endsection
