@extends('adminPanel.layout.adminLayout')

@section('content')

<div>
    <h4 class="text-center mb-1">Subcategory Types Management</h4>
    </div>
  
  
    <div class="row">
      
      {{-- start create new admin  --}}
      <div class="col-12 ">
          <div class="card" >
              <div style="height: 10px;" class="card-header ">
                <p class="mt-3">Create sub category types</p>
              </div>
              <div class="card-body">
  
                    <form id="create_sub_category_types">
                    
                        <input type="hidden" name="id" id="hidden_id" value="{{ $id }}">
                        <div class="form-group">
                          <input type="text" class="form-control input clear_input"  name="name" id="name"   placeholder="Enter Sub Category Type">
                          <span id="name_error" class="text-danger clear_form_error">    </span>
                        </div>

                      <button type="button" id="create_sub_category_types_btn" class="btn btn-primary">Create</button>
                    </form>
                
  
  
              </div>
            </div>
      </div>
      {{-- end create new admin   --}}
  
      <div class="col-12 ">
  
        {{-- table for view update delete admins  --}}
  
          <div class="card">
          <div class="card-header">
          Sub Category types list
          </div>
          <div class="card-body m-1">
  
            
  
        <table id="sub_categoryTypes_list" class="table table-striped">
          <thead>
            <tr>
              <th >id</th>
              <th >type </th>
              <th >created_at</th>
              <th >updated_at</th>
              <th >action</th>
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



  {{-- category edit modal start  --}}
  <div class="modal fade" id="edit_sub_category_types" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory Types</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        {{-- form start   --}}
        <form id="update_sub_category_types">

          <input type="hidden" class="form-control clear_input" name="id"  id="edit_id"  >

          <div class="form-group">
            <label >name</label>
            <input type="text" class="form-control clear_input" name="name"  id="edit_name"  >
            <span id="name_update_error" class="text-danger clear_form_error"></span>
          </div>

         
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
        var display_subcategory_types =  '{!! url('admin/subcategoryTypes',) !!}'+'/'+id;

        //  view data on table start 
        $('#sub_categoryTypes_list').DataTable({

        processing: true,
        serverSide: true,
        ajax: display_subcategory_types ,
        
        columns: [
            { data: 'id', name: 'id'},
            { data: 'sct_name', name: 'sct_name'}, 
            { data: 'created_at', name: 'created_at'},  
            { data: 'updated_at', name: 'updated_at'},  
            { data: 'action', name: 'action'},      
           

        ]
    
        });

    }); 

  </script>  


  <script>
  $('#create_sub_category_types_btn').click(function () { 

    $('.clear_form_error').html('');
    var sub_category_types = $('#create_sub_category_types')[0];
    var sub_category_types_ajax = new FormData(sub_category_types); // get form data

        // send post data start 
    $.ajax({

    url:"{{ route('admin.subcategoryTypes.create') }}",
    method:"POST",

    processData: false,
    contentType: false,
    data:sub_category_types_ajax,
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

        $('.clear_input').val('');
        $('.clear_form_error').html('');
        $('#sub_categoryTypes_list').DataTable().ajax.reload(); 
        },
        error:function(error){
        $('#name_error').html(error.responseJSON.errors.name);
        }
        });
        // send post data end 
    });

    $('body').on('click','.edit_types',function(){

      $('.clear_form_error').html('');
      var id = $(this).data('id');
      // get ajax data start 
      $.ajax({

        url:'{{ url("admin/subcategoryTypes",) }}' + '/'+ id + '/edit',
        method:'GET',
        success: function(response){

        $('#edit_sub_category_types').modal('show');

        console.log(response);
        $('#edit_name').val(response.sct_name);
        $('#edit_id').val(response.id);
        },
        error: function(error){  
        }
        });
// ajax code end
   });


   $('#update_subcategory_btn').click(function () { 

     $('.clear_form_error').html('');

    var types_update = $('#update_sub_category_types')[0];
    var types_update_ajax = new FormData(types_update); // get form data
    
           // send post data start 
                $.ajax({

        url:"{{ route('admin.subcategoryTypes.update') }}",
        method:"POST",

        processData: false,
        contentType: false,
        data:types_update_ajax,
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

            $('#edit_sub_category_types').modal('hide');
            $('.clear_input').val('');
            $('.clear_form_error').html('');
            $('#sub_categoryTypes_list').DataTable().ajax.reload(); 
            },

            error:function(error){
            $('#name_update_error').html(error.responseJSON.errors.name);
            }
            });

    });

    // start delete types 
    $('body').on('click','.delete_types',function(){


    var id = $(this).data('id');
    if(confirm("Are you sure you want to delete record ? ")){
    $.ajax({
    url:'{{ url("admin/subcategoryTypes",) }}' + '/'+ id + '/delete',
    method:'GET',
    success: function(response){
    $('#sub_categoryTypes_list').DataTable().ajax.reload(); 
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
   


    },
    error: function(error){  
    }
    });
    };


    });

    // end delete types 



  </script>
  @endsection