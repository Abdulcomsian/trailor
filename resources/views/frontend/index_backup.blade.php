<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer | Home</title>

    <!-- bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font awesome 5 CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/media.css') }}">
</head>

<body>

    <!-- navbar -->
    @include('layouts.Frontend.nav')

    <!-- login/register model -->
      <!-- Modal -->
      <div class="modal fade auth_model" id="ragisterModel" tabindex="-1" aria-labelledby="ragisterModelLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                 <div class="modal-header pb-0 border-0">
                                <h5 class="modal-title invisible">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <div class="text text-center">
                                        <h3>Create an account</h3>
                                        <p>Connect with us today!</p>
                                    </div>
                                    <form class="model_form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                    <div class="input_group d-flex flex-column">
                                            <label for="email">Full Name</label>
                                            <input type="text" name="name" id="name" placeholder="Enter your fullname">
                                            <span class="text-danger name_valid">{{$errors->first('name')}}</span>
                                        </div>
                                        <div class="input_group d-flex flex-column">
                                            <label for="email">Email​ Address</label>
                                            <input type="email" name="email" id="email"  placeholder="Enter your email">
                                            <span class="text-danger name_valid">{{$errors->first('email')}}</span>
                                        </div>
                                        <div class="input_group d-flex flex-column">
                                            <label for="email">Phone Number</label>
                                            <input type="number" name="phone" id="phone" placeholder="Enter your phone number">
                                        </div>
                                        <div class="input_group  d-flex flex-column">
                                            <label for="email">Password</label>
                                            <div class="input position-relative">
                                                <input type="password" id="togglePassInput" class="w-100" class="" name="password" id="password" placeholder="Please Enter Your Password">
                                                <a href="#" class="eye" id="togglePass">
                                                    <!-- img -->
                                                    <img src="{{asset('assets/img/EyeFill.png') }}" alt="eye">
                                                </a>
                                                <span class="text-danger name_valid">{{$errors->first('password')}}</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn_blue mt-4">Sign Up</button>
                                        <!-- img -->
                                        <div class="img">
                                            <img src="{{asset('assets/img/with.png') }}" class="my-4" alt="img">
                                            <div class="social_btn d-flex justify-content-between">
                                                <a href="#">
                                                    <img src="{{asset('assets/img/google.png') }}" alt="img">
                                                </a>
                                                <a href="#">
                                                    <img src="{{asset('assets/img/facebook.png') }}" alt="img">
                                                </a>
                                            </div>
                                            <div class="mt-5 text-center">
                                                <!-- <p class="mb-0 dontaccount">Continue as a  <a href="#" class="signlink">Guest</a></p> -->
                                            </div>
                                    </form>
                                </div>
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
            </div>


            <!-- ragister -->
            <div class="modal fade auth_model" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header pb-0 border-0">
                                <h5 class="modal-title invisible">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                <div class="text text-center">
                                        <h3>Hi, Welcome Back! </h3>
                                        <p>Hello again, you’ve been missed!</p>
                                    </div>
                                    <form class="model_form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                        <div class="input_group d-flex flex-column">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Please Enter Your Email">
                                            <span class="text-danger name_valid">{{$errors->first('email')}}</span>
                                        </div>
                                        <div class="input_group  d-flex flex-column">
                                            <label for="email">Password</label>
                                            <div class="input position-relative">
                                                <input type="password" id="togglePassInput" class="w-100" class="" name="password" id="password" placeholder="Please Enter Your Password">
                                                <a href="#" class="eye" id="togglePass">
                                                    <!-- img -->
                                                    <img src="{{asset('assets/img/EyeFill.png') }}" alt="eye">
                                                </a>
                                                <span class="text-danger name_valid">{{$errors->first('password')}}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Remember me
                                                </label>
                                            </div>
                                            <a href="#" class="forgot_password" data-bs-toggle="modal" onclick="forgotPass()" >Forgot Password?</a>
                                        </div>
                                        <button type="submit" class="btn btn_blue mt-4">Login</button>
                                        <!-- img -->
                                        <div class="img">
                                            <img src="{{asset('assets/img/with.png') }}" class="my-4" alt="img">
                                            <div class="social_btn d-flex justify-content-between">
                                                <a href="#">
                                                    <img src="{{asset('assets/img/google.png') }}" alt="img">
                                                </a>
                                                <a href="#">
                                                    <img src="{{asset('assets/img/facebook.png') }}" alt="img">
                                                </a>
                                            </div>
                                            <div class="mt-5 text-center">
                                                <p class="mb-0 dontaccount">Don’t have an account? <a href="#" onclick="toggleModel()" class="signlink">Sign Up</a></p>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

             <!-- forgot password -->
             <div class="modal fade auth_model" id="ForgotPassword" tabindex="-1" aria-labelledby="loginModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                 <div class="modal-header pb-0 border-0">
                                <h5 class="modal-title invisible">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                <div class="text text-center">
                                        <h3>Reset Password </h3>
                                        <p class="mb-4">Code will be send into your email</p>
                                    </div>
                                    <form class="model_form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                        <div class="input_group d-flex flex-column">
                                            <label for="email">Enter Your Email</label>
                                            <input type="email" name="email" id="email"
                                                placeholder="Please Enter Your Email">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end">
                                            <button type="submit" class="btn mt-4 btn-secondary" onclick="forgotPass()">Cancel</button>
                                            <button type="submit" class="btn mt-4 btn-primary ms-2">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

    <div class="hero_div">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- <img src="{{asset('assets/img/hero_Car.png') }}" class="w-100" alt="hero_Car"> -->
                    <!-- Swiper -->
                    <div class="swiper mySwiper swiper1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{asset('assets/img/hero_Car.png') }}" class="w-100" alt="hero_Car">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{asset('assets/img/hero_Car.png') }}" class="w-100" alt="hero_Car">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="text">
                        <h1 class="hero_heading">
                            HIRE TRAILER FOR <span class="text_yellow">RENT!</span>
                        </h1>
                        <p class="hero_text text-white">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </p>
                        <form class="header_form mt-5" method="POST" action="{{ route('order-trailer') }}">
                            @csrf
                            <div class="input mb-5 position-relative">
                                <!-- <input type="text" class="d-block w-100" placeholder="Type of trailer"> -->
                                <select name="trailer_id" id="trailer_id" class="form_control w-100">
                                    <option value="">Type of trailer</option>
                                    <option value="1">Trailer 1</option>
                                    <option value="2">Trailer 2</option>
                                </select>
                                <!-- <span class="icon">
                                    <img src="{{asset('assets/img/drop_arrow.png') }}" alt="drop_arrow">
                                </span> -->
                            </div>
                            <div class="input mb-5 position-relative">
                                <input type="text" name="date" class="d-block form_control w-100" id="datePut"
                                    placeholder="Hire Period">
                                <span class="icon">
                                    <!-- <input type="text" name="date" id="datePicker" class="datePicker"
                                        placeholder="test"> -->

                                        <img src="{{asset('assets/img/timer-outline.png') }}" class="w-100" alt="picker">

                                </span>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="input mb-5 position-relative">
                                        <input type="text" name="start_time" class="d-block timepicker form_control w-100 pickTime" id="picktimeinput"
                                            placeholder="Pickup time">
                                            <!-- <input type="text" class="timepicker"> -->

                                        <span class="icon">
                                            <!-- <input type="time" name="start_time" id="picktime" class="datePicker"
                                                placeholder="test" step="900"> -->
                                                <!-- img -->
                                                <img src="{{asset('assets/img/timer-outline.png') }}" class="w-100" alt="picker">
                                        </span>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                 <div class="col-lg-7">
                                    <div class="input mb-5 position-relative">
                                        <input type="text" name="end_time" class="d-block timepicker form_control w-100 pickTime" id="droptimeInput"
                                            placeholder="Dropoff time">
                                        <span class="icon">
                                            <!-- <input type="time" name="end_time" id="droptime" class="datePicker"
                                                placeholder="test" step="900"> -->
                                                <img src="{{asset('assets/img/timer-outline.png') }}" class="w-100" alt="picker">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="me-3 btn btn_yellow">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section_2">
        <div class="container">
            <div class="text text-center mx-auto">
                <h2 class="section_title">Things you need <span class="text_yellow">to do</span></h2>
                <p class="section_para mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis a
                    interdum
                    lacus.</p>
            </div>
            <div class="row px-lg-4 mt-5">
                <div class="col-lg-4">
                    <div class="box">
                        <!-- <img src="img/boximg1.png" alt="box"> -->
                        <img src="{{asset('assets/img/boximg1.png') }}" alt="box">
                        <h4 class="box_head">Choose Trailer</h4>
                        <p class="box_p">Lorem ipsum dolor sit amet, consec adipiscing.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box box_2">
                        <!-- <img src="img/boximg2.png" alt="box"> -->
                        <img src="{{asset('assets/img/boximg2.png') }}" alt="box">
                        <h4 class="box_head">Make Payment</h4>
                        <p class="box_p">Lorem ipsum dolor sit amet, consec adipiscing.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box">
                        <!-- <img src="img/boximg3.png" alt="box"> -->
                        <img src="{{asset('assets/img/boximg3.png') }}" alt="box">
                        <h4 class="box_head">Pick Trailer</h4>
                        <p class="box_p">Lorem ipsum dolor sit amet, consec adipiscing.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section_3" id="trailer">
        <div class="container">
              <!-- Swiper -->
    <div class="swiper swiper3 mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="text mb-5 featureText">
                        <h2 class="section_title">Features of <span class="text_yellow">2T</span></h2>
                        <p class="section_para text-start mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Mauris
                            quis a
                            interdum
                            lacus.</p>

                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span>
                        </p>
                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span>
                        </p>
                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span>
                        </p>
                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span>
                        </p>
                    </div>
                    <!-- 2ND -->
                    <div class="text mb-5 featureText d-none">
                        <h2 class="section_title">Features of <span class="text_yellow">2.5T</span></h2>
                        <p class="section_para text-start mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Mauris
                            quis a
                            interdum
                            lacus.</p>

                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                </span>
                        </p>
                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">amet Lorem ipsum dolor sit
                                </span>
                        </p>
                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span>
                        </p>
                        <p class="list mb-3">
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem dolor sit
                                amet</span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <img src="img/section3Img.png" class="img-fluid" alt="img"> -->
                    <!-- <img src="{{asset('assets/img/section3Img.png') }}" class="img-fluid" alt="img"> -->
                    <div class="card_imgs d-flex align-items-center">
                        <div class="card_img img1 flex-column align-items-center">
                            <img src="{{asset('assets/img/feature_img_1.png') }}" class="img-fluid" alt="img">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn_book">Book Now</a>
                            </div>
                        </div>
                        <div class="card_img img2 d-none d-lg-flex flex-column align-items-center absolute">
                            <img src="{{asset('assets/img/feature_img_2.png') }}" class="img-fluid" alt="img">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn_book">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="text mb-5">
                        <h2 class="section_title">Features of <span class="text_yellow">2T</span></h2>
                        <p class="section_para text-start mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Mauris
                            quis a
                            interdum
                            lacus.</p>

                        <p class="list mb-3">
                            <!-- <img src="img/dot.png" alt="dot"> -->
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                        <span class="ms-3">Lorem ipsum dolor sit
                                amet</span></p>
                        <p class="list mb-3">
                            <!-- <img src="img/dot.png" alt="dot"> -->
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span></p>
                        <p class="list mb-3">
                            <!-- <img src="img/dot.png" alt="dot"> -->
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span></p>
                        <p class="list mb-3">
                            <!-- <img src="img/dot.png" alt="dot"> -->
                            <img src="{{asset('assets/img/dot.png') }}" alt="dot">
                            <span class="ms-3">Lorem ipsum dolor sit
                                amet</span></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <img src="img/section3Img.png" class="img-fluid" alt="img"> -->
                    <!-- <img src="{{asset('assets/img/section3Img.png') }}" class="img-fluid" alt="img"> -->
                    <div class="card_imgs d-flex align-items-center">
                        <div class="card_img img1 absolute d-none d-lg-flex flex-column align-items-center">
                            <img src="{{asset('assets/img/feature_img_1.png') }}" class="img-fluid" alt="img">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn_book">Book Now</a>
                            </div>
                        </div>
                        <div class="card_img img2 d-flex flex-column align-items-center">
                            <img src="{{asset('assets/img/feature_img_2.png') }}" class="img-fluid" alt="img">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="#" class="btn btn_book">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
          
        </div>
    </div>

    <div class="section_5 counters">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="box text-center">
                        <h3><span class="counter purecounter" data-purecounter-start="0" data-purecounter-end="22"
                                data-purecounter-duration="2" data-purecounter-once="true">22</span>+</h3>
                        <p>Equipments</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6 borderLeft">
                    <div class="box text-center">
                        <h3><span class="counter purecounter" data-purecounter-start="0" data-purecounter-end="4000"
                                data-purecounter-duration="2" data-purecounter-once="true">4000</span>+</h3>
                        <p>happy Clients</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6 borderLeft">
                    <div class="box text-center">
                        <h3><span class="counter purecounter" data-purecounter-start="0" data-purecounter-end="5"
                                data-purecounter-duration="2" data-purecounter-once="true">5</span> Years</h3>
                        <p>Service</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6 borderLeft">
                    <div class="box text-center">
                        <h3><span class="counter purecounter" data-purecounter-start="0" data-purecounter-end="8000"
                                data-purecounter-duration="2" data-purecounter-once="true">8000</span>+</h3>
                        <p> Total users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section_6" id="pricing">
        <div class="top_head">
            <h2 class="section_title text-white text-center">Pricing for <span class="text_yellow">trailers</span></h2>
        </div>
        <div class="price_table">
            <div class="price_table_head">Price table</div>
            <div class="table_box">
                <div class="row mx-0 borderBottom">
                    <div class="col-lg-6 bg-white">
                        <div class="headbox">2T Trailer</div>
                    </div>
                    <div class="col-lg-6 mobileHide bg-white borderColLeft">
                        <div class="headbox">2.8T Trailer</div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-lg-6 px-0">
                        <div class="priceBox d-flex justify-content-between align-items-center">
                            <p class="m-0"><b>Hours</b></p>
                            <p class="m-0"><b>Price</b></p>
                        </div>
                        <div class="priceBody">
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-none bg-white borderColLeft">
                        <div class="headbox">2.8T Trailer</div>
                    </div>
                    <div class="col-lg-6 px-0">
                        <div class="priceBox d-flex justify-content-between align-items-center">
                            <p class="m-0"><b>Hours</b></p>
                            <p class="m-0"><b>Price</b></p>
                        </div>
                        <div class="priceBody">
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                            <div class="priceBox d-flex justify-content-between align-items-center">
                                <p class="m-0">3 - 6 hrs</p>
                                <p class="m-0">$60</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section_7" id="feedback">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text">
                        <h2 class="section_title">What people say <br>
                            <span class="text_yellow">about Us.</span>
                        </h2>
                        <p class="section_para text-start">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Mauris
                            quis a
                            interdum
                            lacus.</p>
                        <div class="custom_pagination_in">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="img">
                        <!-- <img src="img/client_feedback.png" class="w-100" alt="client_feedback"> -->
                        <!-- <img src="{{asset('assets/img/client_feedback.png') }}" class="w-100" alt="client_feedback"> -->
                        <!-- Swiper -->
                        <div class="swiper mySwiper swiper2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="feedback shadow-sm">
                                        <div class="avatar">
                                            <img src="{{asset('assets/img/avatar.png') }}" alt="avatar png">
                                        </div>
                                        <div class="text">
                                            <p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">1John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                    <div class="feedback ghost_dev">
                                        <div class="text">
                                            <p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">1John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="feedback shadow-sm">
                                        <div class="avatar">
                                            <img src="{{asset('assets/img/avatar.png') }}" alt="avatar png">
                                        </div>
                                        <div class="text">
                                            <p>2Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">2John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                    <div class="feedback ghost_dev">
                                        <div class="text">
                                            <p>2Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">2John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="feedback shadow-sm">
                                        <div class="avatar">
                                            <img src="{{asset('assets/img/avatar.png') }}" alt="avatar png">
                                        </div>
                                        <div class="text">
                                            <p>3Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">3John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                    <div class="feedback ghost_dev">
                                        <div class="text">
                                            <p>3Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">3John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="feedback shadow-sm">
                                        <div class="avatar">
                                            <img src="{{asset('assets/img/avatar.png') }}" alt="avatar png">
                                        </div>
                                        <div class="text">
                                            <p>4Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">4John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                    <div class="feedback ghost_dev">
                                        <div class="text">
                                            <p>4Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Mauris
                                                quis a
                                                interdum
                                                lacus.</p>
                                            <h6 class="m-0">4John Doe</h6>
                                            <span class="place">Sydney, Australia</span>
                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="swiper-slide">
                                    <img src="{{asset('assets/img/client_feedback.png') }}" class="w-100" alt="client_feedback">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('assets/img/client_feedback.png') }}" class="w-100" alt="client_feedback">
                                </div> -->
                            </div>
                            <div class="pagination_custom">
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- include footer -->
    @include('layouts.Frontend.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script src="{{asset('assets/js/purecounter.js') }}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $('input[name="date"]').daterangepicker();
    </script>

    <!-- Initialize Swiper -->
    <script>
        var swiper1 = new Swiper(".swiper1", {
            direction: "vertical",
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        var swiper2 = new Swiper(".swiper2", {
            slidesPerView: 1,
            direction: "vertical",
            effect: "flip",
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            // effect: "fade",
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

      var swiper3 = new Swiper(".swiper3", {
            slidesPerView: 1,
            spaceBetween: 30,
            // autoplay
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
            el: ".swiper-pagination",
            clickable: true,
            },
      });
    //   swiper2.on('slideChange', function () {
    //     $('.custom_pagination_in').html($('.pagination_custom').html())
       
    //   });
    //   swiper event triiger on only next slide
        swiper2.on('slideChangeTransitionEnd', function () {
            $('.swiper-slide-active .ghost_dev').html($('.swiper-slide-next .feedback').html());
            // $('.swiper-slide-active .ghost_dev').html($('.swiper-slide-next .feedback').html());
        });
        //  swiper event triiger on only prev slide
        swiper2.on('slideChangeTransitionStart', function () {
            $('.swiper-slide-active .ghost_dev').html($('.swiper-slide-prev .feedback').html());
            // $('.swiper-slide-active .ghost_dev').html($('.swiper-slide-next .feedback').html());
        });

        $('.counter').counterUp()
    </script>

    <!-- load jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    @if (count($errors) > 0)
        @if($errors->first('email')=='These credentials do not match our records.')
        <script>
            $('#loginModal').modal('show');
        </script>
        @else
        <script>
            $('#ragisterModel').modal('show');
        </script>
        @endif
    @endif

    <script>
        $('#datePicker').on('change', function () {
            $('#datePut').val(this.value);
        });

        $('#droptime').on('change', function () {
            $('#droptimeInput').val(this.value);
        });

        // $('#droptimeInput').click(function(){
        //     alert(1)
        //     // focus input
        //     $('#droptime').focus()
        // })

        $('#picktime').on('change', function () {
            $('#picktimeinput').val(this.value);
        });
        $('.card_img').click(function () {
            $('.card_img').toggleClass('absolute');
            $('.featureText').toggleClass('d-none');
        });


        $('#togglePass').click(function (e) {
            e.preventDefault();
            if ($('#togglePassInput').attr('type') == 'password') {
                $('#togglePassInput').attr('type', 'text');
            } else {
                $('#togglePassInput').attr('type', 'password');
            }
        });
        // $('.card_img').click(function () {
        //     $('.card_img').toggleClass('absolute');
        // });
        
    </script>

    <script>
        function toggleModel() {
            $('#loginModal').modal('toggle');
            $('#ragisterModel').modal('toggle');
        }

        function forgotPass() {
            $('#loginModal').modal('toggle');
            $('#ForgotPassword').modal('toggle');
        }

        $('#loginModal #togglePass').on('click', function () {
            // $('#loginModal #togglePassInput').attr('type', 'text');
            // toggle type
            if ($('#loginModal #togglePassInput').attr('type') == 'password') {
                $('#loginModal #togglePassInput').attr('type', 'text');
            } else {
                $('#loginModal #togglePassInput').attr('type', 'password');
            }
            
        });
    </script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 15,
    minTime: '09:00',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '09:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
</script>
</body>
</html>