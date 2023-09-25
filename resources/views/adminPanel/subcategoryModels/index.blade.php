@extends('adminPanel.layout.adminLayout')

@section('content')

<div>
    <h4 class="text-center mb-1">Models Management</h4>
    </div>
  
  
    <div class="row">
      {{-- start create new admin  --}}
      <div class="col-12 ">
          <div class="card" >
              <div style="height: 10px;" class="card-header ">
                <p class="mt-3">Create model</p>
              </div>
              <div class="card-body">
  
                    <form id="create_model">
                    
                        <input type="hidden" name="id" id="hidden_id" value="{{ $id }}">
                        <div class="form-group">
                          <input type="text" class="form-control input clear_input"  name="name" id="model_name"   placeholder="Enter Model Name">
                          <span id="model_error" class="text-danger clear_form_error">    </span>
                        </div>

                      <button type="button" id="create_model_btn" class="btn btn-primary">Create</button>
                    </form>
                
              </div>
            </div>
      </div>
      {{-- end create new admin   --}}
  
      <div class="col-12 ">
  
        {{-- table for view update delete admins  --}}
  
          <div class="card">
          <div class="card-header">
          Models list
          </div>
          <div class="card-body m-1">
  
            
  
        <table id="model_list" class="table table-striped">
          <thead>
            <tr>
  
              <th >id</th>
              <th >name </th>
              <th >created_at</th>
              <th >updated_at</th>
              <th >status</th>
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
  <div class="modal fade" id="edit_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form id="update_model_form">
          <input type="hidden" class="form-control clear_input" name="id"  id="update_id"  >
          <div class="form-group">
            <label >name</label>
            <input type="text" class="form-control clear_input" name="name"  id="update_name"  >
            <span id="update_name_error" class="text-danger clear_form_error"></span>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-12"> <label class="mr-3">Status</label> </div>
              <div class="col-12"> <input type="checkbox" class="mr-2"  name="brand_status" required  id="brand_status"  data-toggle="toggle" data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="danger" data-width="200" data-height="30"> </div>
            </div>
          </div>
         
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="update_model_btn" class="btn btn-primary">Save changes</button>
  
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
   //  view data on table start 
         var id =  $('#hidden_id').val();
         var brands =  '{!! url('admin/BrandModels/getData',) !!}'+'/'+id;

      // view data on table start 
     $('#model_list').DataTable({
 
         processing: true,
         serverSide: true,
         ajax: brands,
         columns: [
             { data: 'id', name: 'id'},
             { data: 'model_name', name: 'model_name'},
             { data: 'created_at', name: 'created_at'},
             { data: 'updated_at', name: 'updated_at'},
             { data: 'status', name: 'status'},       
             { data: 'action', name: 'action'}, 
 
         ]
     
         });
     //  view data on table end 
         });
  </script>
  <script>

      //   create model start 
    $('#create_model_btn').click(function () {

    $('.clear_form_error').html('');        
    var create_model = $('#create_model')[0];
    var create_model_ajax = new FormData(create_model); // get form data

// ajax post start 
            $.ajax({

        url:"{{ route('admin.subcategoryBrandModel.create') }}",
        method:"POST",

        processData: false,
        contentType: false,
        data:create_model_ajax,
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
        $('#model_list').DataTable().ajax.reload(); 
        },
        error:function(error){
        console.log(error);
        $('#model_error').html(error.responseJSON.errors.name);
        }
        });
        });
     // create model end 

     // *** delete record start 
     $('body').on('click','.delete_model',function(){

        var id = $(this).data('id');
        if(confirm("Are you sure you want to delete record ? ")){

        $.ajax({
        url:'{{ url("admin/Brand/Model",) }}' + '/'+ id + '/delete',
        method:'GET',
        success: function(response){

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
        $('#model_list').DataTable().ajax.reload();
        },
            error: function(error){
        }
        });
        }
    });
     // *** delete record end 


    //  edit model data start 
    $('body').on('click','.edit_model',function(){
        var id = $(this).data('id');
        $('.clear_form_error').html('');
      var id = $(this).data('id');
      $.ajax({

      url:'{{ url("admin/subCategory/brands/model",) }}'+'/'+ id + '/edit',
      method:'GET',
      success: function(response){

        // console.log(response);

      $('#edit_model').modal('show');
      $('#update_id').val(response.id);
      $('#update_name').val(response.model_name);

      if(response.status == 0){
      $('#brand_status').bootstrapToggle('off');
      }
      else{
      $('#brand_status').bootstrapToggle('on');
      }
      },
      error: function(error){  
          console.log(error);
      }
      });
    });
    //  edit model data end 

    // update model start 
    $('#update_model_btn').click(function () { 
    $('.clear_form_error').html('');

  var update_model = $('#update_model_form')[0];
  var update_model_ajax = new FormData(update_model); // get form data

  // ajax post start 
  $.ajax({

    url:"{{ route('admin.subcategorymodel.update') }}",
    method:"POST",

    processData: false,
    contentType: false,
    data:update_model_ajax,
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
    $('#edit_model').modal('hide');
    $('.clear_input').val('');
    $('.clear_form_error').html('');
    $('#model_list').DataTable().ajax.reload(); 
    },
    error:function(error){
    $('#update_name_error').html(error.responseJSON.errors.name);
    }
    });
   
     });
    // update model end 

  </script>

@endsection









