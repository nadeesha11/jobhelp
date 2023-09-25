@extends('adminPanel.layout.adminLayout')

@section('content')
    

<style>

    ::placeholder {
      font-size: 0.8em;
      padding: 2px;
    }
    </style>
    
    
    <div>
      <h3 class="text-center mb-3">Admin Management</h3>
    </div>
    
    <div class="row">
    
       
    
        {{-- start create new admin  --}}
        <div class="col-4 ">
            <div class="card">
                <div class="card-header">
                  <p>create Admin</p>
                </div>
                <div class="card-body">
    
                      <form id="create_admin">
                      
    
                          <div class="form-group">
                            <input type="email" class="form-control input"  name="admin_email" id="admin_email"   placeholder="Enter Email">
                            <span id="admin_email_error" class="text-danger clear_form_error">    </span>
                          </div>
    
                        <div class="form-group">
                          <input type="password" name="admin_password" class="form-control input" id="admin_password"   placeholder="Password">
                          <span  class="text-info mb-1"><p style="font-size: 0.7em !important;">*require least one uppercase,lowercase,number, special character</p>   </span>
                          <span id="admin_password_error" class="text-danger clear_form_error">    </span>
                        </div>
                     
                        <button type="button" id="create_admin_btn" class="btn btn-primary">Create</button>
                      </form>
                  
    
    
                </div>
              </div>
        </div>
        {{-- end create new admin   --}}
    
        <div class="col-8 ">
    
          {{-- table for view update delete admins  --}}
    
          <div class="card">
            <div class="card-header">
              Admin list
            </div>
            <div class="card-body m-3">
    
              
    
          <table id="admin_list" class="table table-striped">
            <thead>
              <tr>
                <th >id</th>
                <th >email</th>
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
    
    {{-- admin edit modal start  --}}
    <div class="modal fade" id="edit_admin_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
    
    
          {{-- form start   --}}
          <form id="edit_admin_form">
    
            <input type="hidden" name="id" id="admin_id">
    
            <div class="form-group">
              <label >Current User Name </label>
              <input type="text" class="form-control" name="name" id="edit_admin_name"  placeholder="Enter User Name">
              <span id="name_update_error" class="text-danger clear_form_error">    </span>
            </div>
    
            <div class="form-group">
              <label > New User Name </label>
              <input type="text" class="form-control" name="new_name" id="new_admin_name"  placeholder="not required">
              <span id="new_name_update_error" class="text-danger clear_form_error">    </span>
            </div>
    
            <div class="form-group">
              <label >Email</label>
              <input type="text" class="form-control" name="email" id="edit_admin_email"   placeholder="Enter Email Name">
              <span id="email_update_error" class="text-danger clear_form_error">    </span>
            </div>
    
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" name="password" id="current_password"   placeholder="required">
              <span id="password_error" class="text-danger clear_form_error">    </span>
            </div>
    
            <div class="form-group">
              <label for="exampleInputPassword1">New Password</label>
              <input type="password" class="form-control" name="new_password" id="new_password"  placeholder="not required">
              <span  class="text-info mb-1"><p style="font-size: 0.7em !important;">*reqireat least one uppercase,lowercase,number, special character</p>   </span>
              <span id="new_password_error" class="text-danger mb-1 clear_form_error"><p style="font-size: 0.7em !important;"></span>
            </div>
    
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="edit_admin_btn" class="btn btn-primary">Save changes</button>
    
          </form>
          {{-- form end   --}}
    
    
    
            </div>
          </div>
        </div>
      </div>
    {{-- admin edit modal end  --}}

    <script>
    $(document).ready( function () {

        // $('#admin_list').DataTable();
        //start display data using datatbles through yajra 
        $('#admin_list').DataTable({
        
          
         
          processing: true,
          serverSide: true,
         
          ajax: '{!! route('admin.recieveAdmin') !!}',
        
          columns: [
              { data: 'id', name: 'id'},
              { data: 'email', name: 'email'},
              { data: 'action', name: 'action'},  
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


    $('#create_admin_btn').click(function(){

     $('.clear_form_error').html('');   

    var create_admin = $('#create_admin')[0];
    var create_adminAjax = new FormData(create_admin); // get form data

        $.ajax({

    url:"{{ route('admin.create_admin') }}",
    method:"POST",

    processData: false,
    contentType: false,
    data:create_adminAjax,
    success: function(response){  

        $('.clear_form_error').html('');
        $('.input').val('');
    
        if(response.code == "true"){

        Swal.fire({
        icon: 'success',
        title: response.msg,
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
        $('#admin_list').DataTable().ajax.reload();

    },

    error:function(error){

        // display validations in created admin 
        $('#admin_email_error').html(error.responseJSON.errors.admin_email);
        $('#admin_password_error').html(error.responseJSON.errors.admin_password);

    }
    });
    });


    // delete admin start 
    $('body').on('click','.delete_admin',function(){
   
    var id = $(this).data('id');
    
        //start send admin id to controller to delete by ajax
        if(confirm("Are you sure you want to delete record ? ")){
    $.ajax({

    url:'{{ url("admin",) }}' + '/'+ id + '/delete',
    method:'GET',
    success: function(response){

     if(response.code == "superadmin"){//check superadmin response
        Swal.fire({
                    title: 'Error!',
                    text: response.msg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                    })//display error msg

        }  

     if(response.code == "true"){//delete success
        Swal.fire({
        icon: 'success',
        title: response.msg,
        text: response.msg,
       
        })
       } 

     if(response.code == "false"){//delete false
        Swal.fire({
                    title: 'Error!',
                    text: response.msg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                    })//display error msg
       } 

   
      $('#admin_list').DataTable().ajax.reload();

},
    error: function(error){
    
    console.log(error);
}
});
}; 
// delete admin 

    });
  

    // delete admin end 






    </script>


@endsection