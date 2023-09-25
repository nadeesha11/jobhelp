<!DOCTYPE html>
<html lang="en">
    <head>
        <!--=====================================
                    META-TAG PART START
        =======================================-->
        <!-- REQUIRE META -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- AUTHOR META -->
        <meta name="author" content="Mironcoder">
        <meta name="email" content="mironcoder@gmail.com">
        <meta name="profile" content="https://themeforest.net/user/mironcoder">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- TEMPLATE META -->
        <meta name="name" content="Classicads">
        <meta name="type" content="Classified Advertising">
        <meta name="title" content="Classicads - Classified Ads HTML Template">
        <meta name="keywords" content="classicads, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
        <!--=====================================
                    META-TAG PART END
        =======================================-->

        <!-- FOR WEBPAGE TITLE -->
        <title>Classicads - User Form</title>

        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE TITLE ICON -->
        <link rel="icon" href="{{ asset('images/favicon.png') }}">

        <!-- FOR FONTAWESOME -->
        <link rel="stylesheet" href="{{ asset('fonts/font-awesome/fontawesome.css') }}">

        <!-- FOR BOOTSTRAP -->
        <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">

        <!-- FOR COMMON STYLE -->
        <link rel="stylesheet" href="{{ asset('css/custom/main.css') }}">

        <!-- FOR USER FORM PAGE STYLE -->
        <link rel="stylesheet" href="{{ asset('css/custom/user-form.css') }}">
        <!--=====================================
                    CSS LINK PART END
        =======================================-->
        <link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
        <link rel="stylesheet" href="{{ asset('build/css/demo.css') }}">

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- custom css start --}}
        <style>
       
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }

            .iti {
            width: 100%;
            display: block;
            }
       </style>
     

      
           <!-- FOR BOOTSTRAP -->
           <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
           <script src="{{ asset('js/vendor/popper.min.js') }}"></script>
           <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>


        {{-- custom css start --}}

    </head>
    <body>
        <!--=====================================
                    USER-FORM PART START
        =======================================-->
        <section class="user-form-part">
            <div class="user-form-banner">
                <div class="user-form-content">
                    <a href="#"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                    <h1>Advertise your assets <span>Buy what are you needs.</span></h1>
                    <p>Biggest Online Advertising Marketplace in the World.</p>
                </div>
            </div>

            <div class="user-form-category">
                <div class="user-form-header">
                    <a href="#"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                    <a href="{{ route('web.index') }}"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="user-form-category-btn">
                    <ul class="nav nav-tabs">
                        {{-- <li><a href="#login-tab" class="nav-link active" data-toggle="tab">sign in</a></li>
                        <li><a href="#register-tab" class="nav-link" data-toggle="tab">sign up</a></li> --}}
                    </ul>
                </div>

                <div class="tab-pane " id="login-tab">
                    <div class="user-form-title">
                        <h2>Welcome!</h2>
                        <p>Use credentials to access your account.</p>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Phone number">
                                    <small class="form-alert">Please follow this example - 01XXXXXXXXX</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                    <button type="button" class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">Password must be 6 characters</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-check">
                                        <label class="custom-control-label" for="signin-check">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-right">
                                    <a href="#" class="form-forgot">Forgot password?</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-unlock"></i>
                                        <span>Enter your account</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="user-form-direction">
                        <p>Don't have an account? click on the <span>( sign up )</span> button above.</p>
                    </div>
                </div>

                <div class="tab-pane active" id="register-tab">
                    <div class="user-form-title">
                        <h2>Login</h2>
                        <p>Setup a new account in a minute.</p>
                    </div>

                    <div class="user-form-devider">
                        <p>otp</p>
                    </div>

                   
                    <form id="register_by_otp" >
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input  id="phone_number" name="phone_number" type="text" class="form-control "  style="background: rgb(239, 239, 235) !important; " placeholder="Phone number ">
                                   
                                    <span style="color: red !important;" id="phone_number_error"></span>
                                </div>
                            </div>
                       
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signup-check">
                                        <label class="custom-control-label" for="signup-check">I agree to the all <a href="#">terms & consitions</a> of bebostha.</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="button"  id="opt_button" class="btn btn-inline">
                                        <i class="fas fa-user-check"></i>
                                        <span>Send OTP</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="user-form-devider">
                        <p>or</p>
                    </div>

                    <ul class="user-form-option">
                        <li>
                            <a href="{{ route('facebook') }}">
                                <i class="fab fa-facebook-f"></i>
                                <span>facebook</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                                <span>twitter</span>
                            </a>
                        </li> --}}
                        <li>
                            <a  href="{{ route('google') }}">
                                <i class="fab fa-google"></i>
                                <span>google</span>
                            </a>
                        </li>
                    </ul>
                 






                    {{-- <div class="user-form-direction">
                        <p>Already have an account? click on the <span>( sign in )</span> button above.</p>
                    </div> --}}
                </div>
            </div>
        </section>
        <!--=====================================
                    USER-FORM PART END
        =======================================-->

        
        <!--=====================================
                    JS LINK PART START
        =======================================-->

        <!--start Modal for type otp message -->
<div class="modal fade" id="otp_number_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Enter OTP code </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form id="enter_otp_form" >
            <input id="user_id" name="user_id" type="text">
            <input id="otp_test" name="test_otp" type="text">
            <input id="expire_at" name="expire_at" type="text">
             {{-- remove this after sms --}}
            <input type="number" id="otp" name="otp" class="form-control" max="6" placeholder="opt code"> 
            <span style="color: red !important;" id="otp_error"></span>

            <div>
               <p >otp expired at</p> <h3 id="clock" ></h3> 
            </div>

          </div>
          <div class="modal-footer">

          <button type="button" id="otp_enter_btn" class="btn btn-primary p-1">Verify</button>
          </form>

        </div>
      </div>
    </div>
  </div>
   <!--end Modal for type otp message -->




       
    <script src="{{ asset("build/js/intlTelInput.js") }}"></script>
    <script>
    var input = document.querySelector("#phone_number");
    window.intlTelInput(input, {
      allowDropdown: false,
      autoPlaceholder: "off",
      onlyCountries: ['lk'],
      separateDialCode: true,
    //   utilsScript: "build/js/utils.js", 
    });

      // to get csrf
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // start enter otp modal 
   $('#otp_enter_btn').click(function(){
   $('#otp_error').html('');
   
   

     //start send otp and user id to cntroller 
      var enter_otp = $('#enter_otp_form')[0];
      var enter_otp_ajax = new FormData(enter_otp);

            //   start send otp to controller 
            $.ajax({

        url:"{{ route('web.checkOtp') }}",
        method:"POST",

        processData: false,
        contentType: false,
        data:enter_otp_ajax,
        success: function(response){

           
            
            if(response.code == "error"){
                Swal.fire({
                    title: 'Error!',
                    text: response.msg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                    })

            }
            if(response.code== "success"){

                $('#otp_number_modal').modal('hide'); //return another page

                let user_id = response.user_id;

               
                let url = '{{ url('/web/vendorDashboard') }}'+'/'+user_id;
                location.href = url; //redirect vendor to dash board


            }

        },
        error:function(error){

            if(error){
            $('#otp_error').html(error.responseJSON.errors.otp);
            }
        }
        });

    //   end send otp to controller 
   

   });

    // end enter otp modal 


    $('#opt_button').click(function(){
         
   
        



      //start send phone number to cntroller 
      var register_by_otp = $('#register_by_otp')[0];
      var register_by_otp_ajax = new FormData(register_by_otp);

      $('#otp').val('');

    $.ajax({

    url:"{{ route('web.registerByOtp') }}",
    method:"POST",
    
    processData: false,
    contentType: false,
    data:register_by_otp_ajax,
    success: function(response){
         
        
          console.log(response);
          if(response.code == "popup_otp_enter_modal"){// display popup if success
            $('#phone_number').val("");
            $('#phone_number_error').html("");

            $('#user_id').val(response.otp.user_id);
            $('#otp_test').val(response.otp.otp);  // only testing purpose
            $('#expire_at').val(response.otp.expire_at);

                // clock start 
            const startMinitues = 15;
            let time = startMinitues * 60;

            setInterval(updateCountDown, 1000);

            var countdownELE = document.getElementById('clock');
          

            function updateCountDown(){

                const minites = Math.floor(time/60);
                let seconds = time % 60;

                countdownELE.innerHTML = `${minites}:${seconds}`;
                time--;
                time = time < 0 ? 0 : time; 
            }

           

          // clock end


            $('#otp_number_modal').modal('show');
         }
    },
    error:function(error){

        if(error){
      
            $('#phone_number_error').html(error.responseJSON.errors.phone_number);
        

        }
    }
    });
});
    //end send phone number to cntroller 






  </script>


      



     

        <!-- FOR INTERACTION -->
        <script src="{{ asset('js/custom/main.js') }}"></script>
        <!--=====================================
                    JS LINK PART END
        =======================================-->
    </body>
</html>


























