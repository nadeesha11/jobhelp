@extends('web.layout.webLayout')

@section('content')

<style>

.iti {
  width: 100%;
  display: block;
}

option:empty
{
  display:none;
}

.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

</style>

     <!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
        <section class="single-banner dashboard-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>dashboard</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">dashboard</li>
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
                DASHBOARD HEADER PART START
        =======================================-->
        <section class="dash-header-part">
            <div class="container">
                <div class="dash-header-card">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="dash-header-left">
                             
                                <div class="dash-intro">
                                    <h4><a href="#">gackon Honson</a></h4>
                                    <h5>new seller</h5>
                                    <ul class="dash-meta">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span>(123) 000-1234</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <span>gackon@gmail.com</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Los Angeles, West America</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="dash-header-right">
                                <div class="dash-focus dash-list">
                                    <h2>2433</h2>
                                    <p>listing ads</p>
                                </div>
                                <div class="dash-focus dash-book">
                                    <h2>2433</h2>
                                    <p>total follower</p>
                                </div>
                                <div class="dash-focus dash-rev">
                                    <h2>2433</h2>
                                    <p>total review</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-header-alert alert fade show">
                                <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and Edit your password and account details.</p>
                                <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-menu-list">
                                <ul>
                                    <li><button class="tablinks"  onclick="openCity(event,'dashboard')">dashboard</button></li>
                                    <li><button class="tablinks" onclick="openCity(event, 'ad_post')" >ad post</button></li>
                                    <li><button class="tablinks" id="defaultOpen" onclick="openCity(event, 'settings')" >settings</button></li>
                                    <li><button class="tablinks" onclick="openCity(event, 'myads')" >my ads</button></li>
                                    <li><button  onclick="window.location='{{ route('web.vendor.logout') }}'">logout</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                DASHBOARD HEADER PART END
        =======================================-->


        <!--=====================================
                    DASHBOARD PART START
        =======================================-->
        <section class="dashboard-part" id="page-2">


              <div id="dashboard" class="tabcontent" >

                <div class="row">
                    <div class="col-lg-2">
                   
                    </div>
                    <div class="col-lg-8">
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Membership</h3>
                             
                            </div>
                            <ul class="account-card-list">
                                <li><h5>Status</h5><p>Premium</p></li>
                                <li><h5>Joined</h5><p>February 02, 2021</p></li>
                                <li><h5>Spand</h5><p>4,587</p></li>
                                <li><h5>Earn</h5><p>97,325</p></li>
                            </ul>
                        </div>
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Current Info</h3>
                         
                            </div>
                            <ul class="account-card-list">
                                <li><h5>Active Ads</h5><h6>3</h6></li>
                                <li><h5>Booking Ads</h5><h6>0</h6></li>
                                <li><h5>Rental Ads</h5><h6>1</h6></li>
                                <li><h5>Sales Ads</h5><h6>2</h6></li>
                            </ul>
                        </div>

                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Contact Info</h3>
                                <button >edit</button>
                            </div>
                            
                            <ul class="account-card-list">
                                <li><h5>Status</h5><p>Premium</p></li>
                                <li><h5>Joined</h5><p>February 02, 2021</p></li>
                                <li><h5>Spand</h5><p>4,587</p></li>
                                <li><h5>Earn</h5><p>97,325</p></li>
                            </ul>
                        </div>
                      
                    </div>
                    <div class="col-lg-2">
                   
                    </div>
                </div>
    
                </div>

            <div id="ad_post" class="tabcontent">

                <div >
              {{-- ad post start  --}}

              <div class="m-3">
            

              <div class="card">
                <div class="card-body ">
                <div class="row">
                <div class="col-6 ">
                    <h5 class="text-center">Choose Category  </h5>

                    <div >
                     @foreach ($category as $item)
                     <div class="border-bottom border-primary m-2" > 
                     <div onMouseOver="this.style.color='#0000FF'"  onMouseOver="this.style.font-size=120%" onMouseOut="this.style.color='#000000'" style=" cursor:pointer; "> <div > <a   onclick="getSubCategory('{{$item->id}}')" >{{ $item->cat_name }}</a></div>   </div>
                    </div>
                    {{-- <div class="float-left"><span> <i class="fa-solid fa-arrow-right"></i> </span></div> --}}
                     @endforeach     
                   </div>

                
                </div>

                <div class="col-6 ">
                    <h5 class="text-center">Choose SubCategory</h5>
                    <div id="subCategoryDiv" >

                      
                        {{-- <div> <a href="#" class="d-flex justify-content-center"  >category 1</a></div>
                        <div> <a href="#" class="d-flex justify-content-center"  >category 1</a></div>
                        <div> <a href="#" class="d-flex justify-content-center"  >category 1</a></div> --}}
    
                    </div>
            
                </div>
               </div>
                </div>
              </div>

              </div>

                 {{-- ** this is original code  --}}
                    {{-- <div class="col-lg-1">
                     </div>   
                    <div class="col-lg-10">
                        <form class="adpost-form">
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>Ad Information</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Product Title</label>
                                            <input type="text" class="form-control" placeholder="Type your product title here">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">product image</label>
                                            <input type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Product Category</label>
                                            <select class="form-control custom-select">
                                                <option selected>Select Category</option>
                                                <option value="1">property</option>
                                                <option value="2">electronics</option>
                                                <option value="3">automobiles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" placeholder="Enter your pricing amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">price condition</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="fix-check">
                                                    <label for="fix-check" class="form-check-text">fixed</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="nego-check">
                                                    <label for="nego-check" class="form-check-text">negotiable</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="day-check">
                                                    <label for="day-check" class="form-check-text">daily</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="week-check">
                                                    <label for="week-check" class="form-check-text">weekly</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="month-check">
                                                    <label for="month-check" class="form-check-text">monthly</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="year-check">
                                                    <label for="year-check" class="form-check-text">yearly</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">ad category</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="sale-check">
                                                    <label for="sale-check" class="flat-badge sale">sale</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="rent-check">
                                                    <label for="rent-check" class="flat-badge rent">rent</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="book-check">
                                                    <label for="book-check" class="flat-badge booking">booking</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">product condition</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="use-check">
                                                    <label for="use-check" class="form-check-text">used</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="new-check">
                                                    <label for="new-check" class="form-check-text">new</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">ad description</label>
                                            <textarea class="form-control" placeholder="Describe your message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">ad tag</label>
                                            <textarea class="form-control" placeholder="Maximum of 15 keywords"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>Author Information</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Number</label>
                                            <input type="number" class="form-control" placeholder="Your Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" placeholder="Your Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>Plan Information</h3>
                                </div>
                                <ul class="adpost-plan-list">
                                    <li>
                                        <div class="adpost-plan-content">
                                            <h6>Free Plan - <span>Submit 5 Ad Listings</span></h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Delectus minus Eaque corporis accusantium incidunt officiis deleniti.</p>
                                        </div>
                                        <div class="adpost-plan-meta">
                                            <h3>$00.00</h3>
                                            <button class="btn btn-outline">
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="adpost-plan-content">
                                            <h6>Standerd Plan - <span>Submit 10 Ad Listings</span></h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Delectus minus Eaque corporis accusantium incidunt officiis deleniti.</p>
                                        </div>
                                        <div class="adpost-plan-meta">
                                            <h3>$23.00</h3>
                                            <button class="btn btn-outline">
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="adpost-plan-content">
                                            <h6>Premium Plan - <span>Unlimited Ad Listings</span></h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Delectus minus Eaque corporis accusantium incidunt officiis deleniti.</p>
                                        </div>
                                        <div class="adpost-plan-meta">
                                            <h3>$43.00</h3>
                                            <button class="btn btn-outline">
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="adpost-card pb-2">
                                <div class="adpost-agree">
                                    <div class="form-group">
                                        <input type="checkbox" class="form-check">
                                    </div>
                                    <p>Send me Trade Email/SMS Alerts for people looking to buy mobile handsets in www By clicking "Post", you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a> and acknowledge that you are the rightful owner of this item and using Trade to find a genuine buyer.</p>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>published your ad</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                    {{-- <div class="col-lg-4">
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Safety Tips</h3>
                                <button data-dismiss="alert">close</button>
                            </div>
                            <ul class="account-card-text">
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Custom Offer</h3>
                                <button data-dismiss="alert">close</button>
                            </div>
                            <form class="account-card-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-paper-plane"></i>
                                        <span>send Message</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-1">
                    </div> --}}
                 {{-- ** this is original code  --}}

                {{-- ad post end  --}}
                </div>

            </div>

            <div id="myads" class="tabcontent">

            <h1>this is ad post</h1>
       
            </div>

            <div id="settings" class="tabcontent">

               <div class="m-3">
                

              <div class="card">
                <div class="card-body ">
                <h5 class="text-center" id="accountSettings">Account Settings  </h5>   
              

                    <form id="settings_from">


                        <div class="row mt-3">
                        <div class="form-group col-lg-6">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="text" name="first_name" class="form-control" value="{{ $user_data->first_name }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name">
                          <span id="first_name_error" class="text-danger clear_form_error"></span>
                          {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                    
                        <div class="form-group col-lg-6">
                          <label for="exampleInputPassword1">Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="{{ $user_data->last_name }}" id="exampleInputPassword1" placeholder="Enter Last Name">
                          <span id="last_name_error" class="text-danger clear_form_error"></span>
                        </div>
                       </div>


                       <div class="row mt-3">
                        <div class="form-group col-lg-6">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" name="email" class="form-control" value="{{ $user_data->email }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                          <span id="email_error" class="text-danger clear_form_error"></span>
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                    
                        <div class="form-group col-lg-6">
                          <label for="exampleInputPassword1">Phone Number</label><br>
                          <input type="text" name="phone_number" class="form-control" value="{{ $user_data->phone_number }}" id="tel_phone_number" placeholder="Enter Phone Number">
                          <span id="phone_number_error" class="text-danger clear_form_error"></span>
                        </div>
                       </div>

                       <div class="row mt-3">
                        <div class="form-group col-lg-6">
                          <label  for="exampleInputEmail1">Location (current location : <span class="font-weight-bold"  id="location_inner"> {{ $user_data->location }}   </span> )</label>
                        
                          <select required style="height:50px !important;"  id="location"  name="location"   class="form-control location" >
                            <option  value="" selected>select your location</option> 
                            @foreach ($dirstrict as $one)
                            <option value="{{ $one->id }}" onblur="getSubLocation('{{$one->id}}')" >{{ $one->name_en }}</option>    
                            @endforeach
                          </select>
                          <span id="location_error" class="text-danger clear_form_error"></span>

                        </div>
                    
                        <div class="form-group col-lg-6">
                          <label for="exampleInputPassword1">Sub Location (current sub location : <span class="font-weight-bold" id="sublocation_inner"> {{ $user_data->sub_location }}   </span> )</label>
                          <select required style="height:50px !important;" name="sub_location"  id="subLocation"   class="form-control " >
                          </select>
                          <span id="sub_location_error" class="text-danger clear_form_error"></span>
                        </div>
                       </div>

                        <button type="button" id="settings_btn" class="btn btn-primary">Update</button>
                      </form>
           
               
                </div>
              </div>

              </div>
       
            </div>




        </section>
        <!--=====================================
                    DASHBOARD PART END
        =======================================-->
       
        <script src="{{ asset("build/js/intlTelInput.js") }}"></script>
        <script>
        var input = document.querySelector("#tel_phone_number");
        window.intlTelInput(input, {
          allowDropdown: false,
          autoPlaceholder: "off",
          onlyCountries: ['lk'],
          separateDialCode: true,
        //   utilsScript: "build/js/utils.js", 
        });
       </script>

        <script> 
        $(document).ready(function() { 
            $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        }); 

        $('#settings_btn').click(function() { 

            $('.clear_form_error').html('');
            var settings_from = $('#settings_from')[0];
            var settings_from_ajax = new FormData(settings_from); // get form data

            var location_inner =  document.getElementById('location_inner');
            var sublocation_inner =  document.getElementById('sublocation_inner');

            var location_append = '';
            var sublocation_append = '';
                        // ajax post start 
                        $.ajax({
            url:"{{ route('web.dashboard.setting.create') }}",
            method:"POST",

            processData: false,
            contentType: false,
            data:settings_from_ajax,
            success: function(response){  
                
                console.log(response);
                if(response.code == "true"){

                    // check null or not 
                    if(response.location){

                    location_append = response.location;
                    location_inner.innerHTML = location_append;//append location
                    }
                    if(response.sublocation){

                    sublocation_append = response.sublocation;
                    sublocation_inner.innerHTML = sublocation_append;//append sub location
                        }
                    // check null or not 


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

                    // $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    
                    },
                    error:function(error){

                    $('#first_name_error').html(error.responseJSON.errors.first_name);
                    $('#last_name_error').html(error.responseJSON.errors.last_name);
                    $('#email_error').html(error.responseJSON.errors.email);
                    $('#phone_number_error').html(error.responseJSON.errors.phone_number);
                    $('#location_error').html(error.responseJSON.errors.location);
                    $('#sub_location_error').html(error.responseJSON.errors.sub_location);
                    }
                    });
                });

      </script>
       <script>


   function getSubCategory(id){
        $.ajax({

    url:'{{ url("web/dashboard",) }}' + '/'+ id + '/getSubCategory',
    method:'GET',
    success: function(data){

        var pro = JSON.parse(data);
        var subCategoryDiv =  document.getElementById('subCategoryDiv');
        var cat  = '';

    for (var i in pro) {

        //   let url = '{{ url('web/dashboard') }}'+'/'+pro[i].id+'/createPost';
        //   var url = web/dashboard/'+pro[i].id+'/createPost;
          cat+=' <div    style=" cursor:pointer;"  class="border-bottom border-primary m-2">  <div> <a   onclick="newPage('+pro[i].id+')" class=" custom_btn" >'+pro[i].sub_cat_name+'</a> </div> </div>';
    }
      subCategoryDiv.innerHTML = cat; 

   

    },
        error: function(error){  
    }
    });
	}


       function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();


    </script>
    <script type='text/javascript'>

    function newPage(id)
    {
     console.log(id);
      let url = '{{ url('web/dashboard/createPost') }}'+id;
      location.href = url;
    }
    </script>

<script>
    $(".location").on('click',function(){

    var selectedlocation =$(this).val();
    console.log(selectedlocation);

        $.ajax({
        url:"{{ url('web/dashboard/setting') }}/"+selectedlocation,
        dataType:'json',
        success:function(res){
          
            var _html='';
            $.each(res.sublocation,function(index,row){
            _html+='<option  value="'+row.id+'" >'+row.name_en+'<option>'
            });
            $("#subLocation").html(_html);
    }
    });

}); 
 </script>


@endsection