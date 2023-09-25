@extends('web.layout.webLayout')

@section('content')


    <!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
        <section class="single-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>contact us</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">contact</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                  SINGLE BANNER PART END
        =======================================-->


        <!--=====================================
                    CONTACT PART START
        =======================================-->
        <section class="contact-part">
            <div class="container">
                <div class="row m-3">
                    <div class="col-lg-4">
                        <div class="contact-info">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>Find us</h3>
                            <p>1Hd- 50, 010 Avenue, NY <span> 90001 United States</span></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-info">
                            <i class="fas fa-phone-alt"></i>
                            <h3>Make a Call</h3>
                            <p>009-215-5596 (toll free) <span>009-215-5595</span></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-info">
                            <i class="fas fa-envelope"></i>
                            <h3>Send Mail</h3>
                            <p>contact@example.com <span>info@example.com</span></p>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-lg-6">
                        <div class="contact-map">
                            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3654.3406974350205!2d90.48469931445422!3d23.663771197998262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b0d5983f048d%3A0x754f30c82bcad3cd!2sJalkuri%20Bus%20Stop!5e0!3m2!1sen!2sbd!4v1605354966349!5m2!1sen!2sbd"></iframe> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form id="contact_form" class="contact-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="name" name="name"  class="form-control input" placeholder="Your Name">
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control input" placeholder="Your Email">
                                        <span class="text-danger"  id="email_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="subject" name="subject" class="form-control input" placeholder="Your Subject">
                                        <span class="text-danger" id="subject_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control input" id="message" name="message" placeholder="Your Message"></textarea>
                                        <span class="text-danger" id="message_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-btn">
                                        <button id="send_message" type="button" class="btn btn-inline">
                                            <i class="fas fa-paper-plane"></i>
                                            <span>send message</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    CONTACT PART END
        =======================================-->


        <script>
       

       $('#send_message').click(function(){

        // to get csrf
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });  

        var contactData = $('#contact_form')[0]; //get form dta
        var contactDataAjax = new FormData(contactData);  
        
                $.ajax({

        url:"{{ route('web.sendContactMail') }}",
        method:"POST",

        processData: false,
        contentType: false,
        data:contactDataAjax,
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

        $('.input').val("");


        },

        error:function(error){

        console.log(error);    
            $('#email_error').html(error.responseJSON.errors.email);
            $('#name_error').html(error.responseJSON.errors.name);
            $('#message_error').html(error.responseJSON.errors.message);
            $('#subject_error').html(error.responseJSON.errors.subject);
        

        }
        });



       });

        </script>



@endsection

















