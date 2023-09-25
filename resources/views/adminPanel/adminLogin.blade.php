<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Agro</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.svg') }}" />
        <!-- Template CSS -->
        <link href="{{ asset('assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <main>


            <section class="content-main  ">
                <h3 class="text-center m-3">Project Name</h3>
                <div class="card mx-auto card-login">

                    
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign in</h4>
                        <form  id="adminLoginForm">

                            @csrf
                          
                            <div class="mb-3 mt-3">
                                <input class="form-control input_clear" @if(Cookie::has('multivendor_username')) value="{{ Cookie::get('multivendor_emailname') }}" @endif  name="email"   placeholder="email" type="text" />
                                <span class="text-danger error" id="email_error"></span>
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <input class="form-control input_clear" @if(Cookie::has('multivendor_password')) value="{{ Cookie::get('multivendor_password') }}" @endif  name="password"   placeholder="Password" type="password" />
                                <span class="text-danger error" id="password_error"></span>
                            </div>
                            <!-- form-group// -->
                            <div class="m-3">
                                {{-- <a href="" class="float-end font-sm text-muted mb-4">Forgot password?</a> --}}
                                <label class="form-check">

                                    <input type="checkbox" name="remember_me" class="form-check-input" checked="" />
                                    <span class="form-check-label">Remember</span>

                                </label>
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="m-4">
                                <button type="button" id="login_admin" class="btn btn-primary w-100 ">Login</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                       

                    </div>
                </div>
            </section>
            <footer class="main-footer text-center">
                <p class="font-xs">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                   
                </p>
                <p class="font-xs mb-30">All rights reserved</p>
            </footer>
        </main>
     


        <script>

          // to get csrf
          $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });  
                
           

        $('#login_admin').click(function () { //login check start

            $('.error').html('');

            var loginData = $('#adminLoginForm')[0]; //get form dta
            var loginDataAjax = new FormData(loginData);

        $.ajax({

        url:"{{ route('admin.login') }}",
        method:"POST",

        processData: false,
        contentType: false,
        data:loginDataAjax,
        success: function(response){  

            console.log(response);
            
            $('.input_clear').val('');
            $('.error').html('');

           if(response.code=="error"){

            Swal.fire({
                    title: 'Error!',
                    text: response.msg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                    })//display error msg
           }
           if(response.code=="success"){

            location.href = "{{ route('admin.dashboard') }}";

           }


        },

        error:function(error){

            $('#email_error').html(error.responseJSON.errors.email);
            $('#password_error').html(error.responseJSON.errors.password);

        }
        });
        }); //login check ends

        

        </script>
        <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
        <!-- Main Script -->
        <script src="{{ asset('assets/js/main.js?v=1.1') }}" type="text/javascript"></script>
    </body>
</html>



























