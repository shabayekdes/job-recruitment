<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Recruitment Talents Mine</title>

    <link rel="icon" href="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/cropped-logox300-32x32.png"
        sizes="32x32" />
    <link rel="icon" href="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/cropped-logox300-192x192.png"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/cropped-logox300-180x180.png" />
    <meta name="msapplication-TileImage"
        content="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/cropped-logox300-270x270.png" />

    <!-- Css -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin-css/fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin-css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic-ext,vietnamese"
        rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Wrapper -->
    <div class="careerfy-wrapper">

        <!-- Header -->
        <header id="careerfy-header" class="careerfy-header-one">
            <!-- TopStrip -->
            <div class="careerfy-topstrip">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-envelope"></i> <a
                                    href="mailto:recruitment@talentsmine.net">recruitment@talentsmine.net</a>
                            </p>
                            <p><i class="fa fa-phone"></i><a href="tel: +201022-606-247"> +201022-606-247</a></p>
                            <ul class="careerfy-stripuser">
                                @guest

                                <li><a href="{{ route('login.show') }}"
                                        class="careerfy-open-signup-tab jobsearch-open-signin-tab"><i
                                            class="careerfy-icon careerfy-user-plus"></i>{{ __('Login') }} </a></li>
                                <li><a href="{{ route('register.show') }}"
                                        class="careerfy-open-signup-tab jobsearch-open-register-tab"><i
                                            class="careerfy-icon careerfy-multimedia"></i>{{ __('Register') }} </a></li>

                                @else
                                <li class="jobsearch-userdash-menumain">
                                    <a href="https://recruitment.talentsmine.net/"
                                        class="jobsearch-color active">Home</a>

                                    <ul class="nav-item-children sub-menu">
                                        <li class="active">
                                            <a href="https://recruitment.talentsmine.net/user-dashboard/">
                                                <i class="jobsearch-icon jobsearch-group"></i>
                                                Dashboard </a>
                                        </li>
                                        <li>
                                            <a
                                                href="https://recruitment.talentsmine.net/user-dashboard/?tab=dashboard-settings">
                                                <i class="jobsearch-icon jobsearch-user"></i>
                                                My Profile </a>
                                        </li>
                                        <li>
                                            <a href="https://recruitment.talentsmine.net/user-dashboard/?tab=my-resume">
                                                <i class="jobsearch-icon jobsearch-resume"></i>
                                                My Resume </a>
                                        </li>
                                        <li>
                                            <a
                                                href="https://recruitment.talentsmine.net/user-dashboard/?tab=cv-manager">
                                                <i class="jobsearch-icon jobsearch-id-card"></i>
                                                CV Manager </a>
                                        </li>
                                        <li>
                                            <a
                                                href="https://recruitment.talentsmine.net/user-dashboard/?tab=applied-jobs">
                                                <i class="jobsearch-icon jobsearch-briefcase-1"></i>
                                                Applied Jobs </a>
                                        </li>
                                        <li>
                                            <a
                                                href="https://recruitment.talentsmine.net/user-dashboard/?tab=favourite-jobs">
                                                <i class="jobsearch-icon jobsearch-heart"></i>
                                                Favorite Jobs </a>
                                        </li>
                                        <li>
                                            <a
                                                href="https://recruitment.talentsmine.net/user-dashboard/?tab=change-password">
                                                <i class="jobsearch-icon jobsearch-multimedia"></i>
                                                Change Password </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TopStrip -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a class="careerfy-logo" title="Recruitment Talents Mine"
                            href="https://recruitment.talentsmine.net/"><img
                                src="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/logox300.png"
                                width="122" height="76" alt="Recruitment Talents Mine"></a>
                        <div class="careerfy-right">
                            <nav class="jobsearch-navigation">

                                <div class="collapse navbar-collapse" id="jobsearch-navbar-collapse-1">
                                    <!-- Navigation -->
                                    <a href="#menu" class="menu-link active"><span></span></a>
                                    <nav id="menu" class="careerfy-navigation menu">
                                        <ul id="menu-talents-mine" class="level-1 navbar-nav">
                                            <li id="menu-item-414"
                                                class="menu-item  menu-item-type-post_type  menu-item-object-page  menu-item-home  current-menu-item  page_item  page-item-145  current_page_item">
                                                <a href="https://recruitment.talentsmine.net/">Home</a></li>
                                            <li id="menu-item-420"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children submenu-addicon">
                                                <a href="{{ route('job.index') }}">Jobs</a>
                                                <ul class="sub-menu">
                                                    <li id="menu-item-615"
                                                        class="menu-item  menu-item-type-post_type  menu-item-object-page">
                                                        <a href="{{ route('job.index') }}">Job search engine</a></li>
                                                    <li id="menu-item-615"
                                                        class="menu-item  menu-item-type-post_type  menu-item-object-page">
                                                        <a href="https://recruitment.talentsmine.net/jobs-by-sectors/">Jobs
                                                            By Sectors</a></li>
                                                    <li id="menu-item-633"
                                                        class="menu-item  menu-item-type-post_type  menu-item-object-page">
                                                        <a href="https://recruitment.talentsmine.net/jobs-by-location/">Jobs
                                                            By Location</a></li>
                                                    <li id="menu-item-614"
                                                        class="menu-item  menu-item-type-post_type  menu-item-object-page">
                                                        <a href="https://recruitment.talentsmine.net/jobs-by-type/">Jobs
                                                            By Type</a></li>
                                                </ul>

                                            </li>
                                            <li id="menu-item-419"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children submenu-addicon">
                                                <a href="https://recruitment.talentsmine.net/employers/">Employers</a>
                                                <ul class="sub-menu">
                                                    <li id="menu-item-632"
                                                        class="menu-item  menu-item-type-post_type  menu-item-object-page">
                                                        <a
                                                            href="https://recruitment.talentsmine.net/employer-by-sector/">Employer
                                                            By Sector</a></li>
                                                    <li id="menu-item-631"
                                                        class="menu-item  menu-item-type-post_type  menu-item-object-page">
                                                        <a
                                                            href="https://recruitment.talentsmine.net/employer-by-location/">Employer
                                                            By Location</a></li>
                                                </ul>

                                            </li>
                                            <li id="menu-item-421"
                                                class="menu-item  menu-item-type-post_type  menu-item-object-page"><a
                                                    href="https://recruitment.talentsmine.net/candidates/">Candidates</a>
                                            </li>
                                            <li id="menu-item-415"
                                                class="menu-item  menu-item-type-post_type  menu-item-object-page"><a
                                                    href="https://recruitment.talentsmine.net/company-packages/">Packages</a>
                                            </li>
                                            <li id="menu-item-438"
                                                class="menu-item  menu-item-type-post_type  menu-item-object-page"><a
                                                    href="https://recruitment.talentsmine.net/career-coaching/">Career
                                                    Coaching</a></li>
                                            <li id="menu-item-518"
                                                class="menu-item  menu-item-type-post_type  menu-item-object-page"><a
                                                    href="https://recruitment.talentsmine.net/career-advising/">Career
                                                    Advising</a></li>
                                        </ul>
                                    </nav>
                                    <!-- Navigation -->
                                </div>
                            </nav>
                            <a href="https://recruitment.talentsmine.net/post-new-job/"
                                class="careerfy-headernine-btn">Post New Job</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Main Content -->

        @yield('content')
        <!-- Main Content -->

        <!-- Footer -->
        <footer id="careerfy-footer" class="careerfy-footer-one">
            <div class="container">
                <div class="careerfy-footer-widget">
                    <div class="row">
                        <div class="col-md-3">
                            <aside id="text-2" class="widget widget_text">
                                <div class="textwidget">
                                    <p><img loading="lazy" class="alignnone size-full wp-image-581"
                                            src="https://recruitment.talentsmine.net/wp-content/uploads/2020/03/logo-2.png"
                                            alt="" width="200px" height=""></p>
                                    <p>As today’s market competition becomes very aggressive, Talents Mining is the
                                        science of sorting of large amounts of human capitals and identifying their
                                        potential</p>
                                    <p>&nbsp;</p>
                                    <p><a class="careerfy-classic-btn jobsearch-bgcolor"
                                            href="http://talentsmine.net/about-us/" target="_blank" rel="noopener">About
                                            Us</a></p>
                                </div>
                            </aside>
                        </div>
                        <div class="col-md-3">
                            <aside id="nav_menu-2" class="widget widget_nav_menu">
                                <div class="footer-widget-title">
                                    <h2>Jobs</h2>
                                </div>
                                <div class="menu-for-jobs-container">
                                    <ul id="menu-for-jobs" class="menu">

                                        <li id="menu-item-310"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-310">
                                            <a href="https://recruitment.talentsmine.net/post-new-job/">Post New Job</a>
                                        </li>
                                        <li id="menu-item-310"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-310">
                                            <a href="{{ route('job.index') }}">Job search engine</a>
                                        </li>
                                        <li id="menu-item-308"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-308">
                                            <a href="https://recruitment.talentsmine.net/jobs-listing/">Jobs Listing</a>
                                        </li>
                                        <li id="menu-item-650"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-650">
                                            <a href="https://recruitment.talentsmine.net/jobs-by-location/">Jobs By
                                                Location</a></li>
                                        <li id="menu-item-651"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-651">
                                            <a href="https://recruitment.talentsmine.net/jobs-by-type/">Jobs By Type</a>
                                        </li>
                                        <li id="menu-item-652"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-652">
                                            <a href="https://recruitment.talentsmine.net/jobs-by-sectors/">Jobs By
                                                Sectors</a></li>
                                        <li id="menu-item-658"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-658">
                                            <a href="https://recruitment.talentsmine.net/user-dashboard/">User
                                                Dashboard</a></li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-md-3">
                            <aside id="nav_menu-4" class="widget widget_nav_menu">
                                <div class="footer-widget-title">
                                    <h2>Employers</h2>
                                </div>
                                <div class="menu-for-employer-container">
                                    <ul id="menu-for-employer" class="menu">
                                        <li id="menu-item-298"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-298">
                                            <a href="https://recruitment.talentsmine.net/post-new-job/">Post New Job</a>
                                        </li>
                                        <li id="menu-item-295"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-295">
                                            <a href="https://recruitment.talentsmine.net/employer-listing/">Employer
                                                Listing</a></li>
                                        <li id="menu-item-653"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-653">
                                            <a href="https://recruitment.talentsmine.net/employer-by-location/">Employer
                                                By Location</a></li>
                                        <li id="menu-item-654"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-654">
                                            <a href="https://recruitment.talentsmine.net/employer-by-sector/">Employer
                                                By Sector</a></li>
                                        <li id="menu-item-642"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-642">
                                            <a href="https://recruitment.talentsmine.net/company-packages/">Company
                                                Packages</a></li>
                                        <li id="menu-item-657"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-657">
                                            <a href="https://recruitment.talentsmine.net/user-dashboard/">User
                                                Dashboard</a></li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>

                </div>
                <!-- CopyRight Section -->
                <div class="careerfy-copyright">

                    <p>Copyright © 2021 Talents Mine
                        <br>
                        Designed and Developed with by <a href="https://shabayekdes.netlify.app/">Shabayekdes</a>
                    </p>

                    <ul class="careerfy-social-network">
                        <li><a href="https://www.facebook.com/talentsmine/" target="_blank" class="fa fa-facebook"></a>
                        </li>
                        <li><a href="https://twitter.com/TalentsMine" target="_blank" class="fa fa-twitter"></a></li>
                        <li><a href="https://www.youtube.com/channel/UCJmssxo9dQhhcaqjZ6ATr4w" target="_blank"
                                class="fa fa-youtube"></a></li>
                        <li><a class="fa fa-linkedin" href="http://www.linkedin.com/company/talents-mine"
                                target="_blank"></a>
                        </li>
                        <li><a href="https://www.instagram.com/talentsmine/" target="_blank"
                                class="fa fa-instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>


        </footer>
        <!-- Footer -->

    </div>
    <!-- Wrapper -->

    {{-- <!-- ModalLogin Box -->
    <div class="careerfy-modal fade careerfy-typo-wrap" id="JobSearchModalSignup">
        <div class="modal-inner-area">&nbsp;</div>
        <div class="modal-content-area">
            <div class="modal-box-area">

                <div class="careerfy-modal-title-box">
                    <h2>Login to your account</h2>
                    <span class="modal-close"><i class="fa fa-times"></i></span>
                </div>
                <form>
                    <div class="careerfy-box-title">
                        <span>Choose your Account Type</span>
                    </div>
                    <div class="careerfy-user-options">
                        <ul>
                            <li class="active">
                                <a href="#">
                                    <i class="careerfy-icon careerfy-user"></i>
                                    <span>Candidate</span>
                                    <small>I want to discover awesome companies.</small>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="careerfy-icon careerfy-building"></i>
                                    <span>Employer</span>
                                    <small>I want to attract the best talent.</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="careerfy-user-form">
                        <ul>
                            <li>
                                <label>Email Address:</label>
                                <input value="Enter Your Email Address"
                                    onblur="if(this.value == '') { this.value ='Enter Your Email Address'; }"
                                    onfocus="if(this.value =='Enter Your Email Address') { this.value = ''; }"
                                    type="text">
                                <i class="careerfy-icon careerfy-mail"></i>
                            </li>
                            <li>
                                <label>Password:</label>
                                <input value="Enter Password"
                                    onblur="if(this.value == '') { this.value ='Enter Password'; }"
                                    onfocus="if(this.value =='Enter Password') { this.value = ''; }" type="text">
                                <i class="careerfy-icon careerfy-multimedia"></i>
                            </li>
                            <li>
                                <input type="submit" value="Sign In">
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="careerfy-user-form-info">
                            <p>Forgot Password? | <a href="#">Sign Up</a></p>
                            <div class="careerfy-checkbox">
                                <input type="checkbox" id="r50" name="rr" />
                                <label for="r50"><span></span> Remember Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="careerfy-box-title careerfy-box-title-sub">
                        <span>Or Sign In With</span>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="careerfy-login-media">
                        <li><a href="#"><i class="fa fa-facebook"></i> Sign In with Facebook</a></li>
                        <li><a href="#" data-original-title="google"><i class="fa fa-google"></i> Sign In with
                                Google</a></li>
                        <li><a href="#" data-original-title="twitter"><i class="fa fa-twitter"></i> Sign In with
                                Twitter</a></li>
                        <li><a href="#" data-original-title="linkedin"><i class="fa fa-linkedin"></i> Sign In with
                                LinkedIn</a></li>
                    </ul>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal Signup Box -->
    <div class="careerfy-modal fade careerfy-typo-wrap" id="JobSearchModalLogin">
        <div class="modal-inner-area">&nbsp;</div>
        <div class="modal-content-area">
            <div class="modal-box-area">

                <div class="careerfy-modal-title-box">
                    <h2>Signup to your account</h2>
                    <span class="modal-close"><i class="fa fa-times"></i></span>
                </div>
                <form>
                    <div class="careerfy-box-title">
                        <span>Choose your Account Type</span>
                    </div>
                    <div class="careerfy-user-options">
                        <ul>
                            <li class="active">
                                <a href="#">
                                    <i class="careerfy-icon careerfy-user"></i>
                                    <span>Candidate</span>
                                    <small>I want to discover awesome companies.</small>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="careerfy-icon careerfy-building"></i>
                                    <span>Employer</span>
                                    <small>I want to attract the best talent.</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="careerfy-user-form careerfy-user-form-coltwo">
                        <ul>
                            <li>
                                <label>First Name:</label>
                                <input value="Enter Your Name"
                                    onblur="if(this.value == '') { this.value ='Enter Your Name'; }"
                                    onfocus="if(this.value =='Enter Your Name') { this.value = ''; }" type="text">
                                <i class="careerfy-icon careerfy-user"></i>
                            </li>
                            <li>
                                <label>Last Name:</label>
                                <input value="Enter Your Name"
                                    onblur="if(this.value == '') { this.value ='Enter Your Name'; }"
                                    onfocus="if(this.value =='Enter Your Name') { this.value = ''; }" type="text">
                                <i class="careerfy-icon careerfy-user"></i>
                            </li>
                            <li>
                                <label>Email Address:</label>
                                <input value="Enter Your Email Address"
                                    onblur="if(this.value == '') { this.value ='Enter Your Email Address'; }"
                                    onfocus="if(this.value =='Enter Your Email Address') { this.value = ''; }"
                                    type="text">
                                <i class="careerfy-icon careerfy-mail"></i>
                            </li>
                            <li>
                                <label>Phone Number:</label>
                                <input value="Enter Your Phone Number"
                                    onblur="if(this.value == '') { this.value ='Enter Your Phone Number'; }"
                                    onfocus="if(this.value =='Enter Your Phone Number') { this.value = ''; }"
                                    type="text">
                                <i class="careerfy-icon careerfy-technology"></i>
                            </li>
                            <li class="careerfy-user-form-coltwo-full">
                                <label>Categories:</label>
                                <div class="careerfy-profile-select">
                                    <select>
                                        <option>Sales & Marketing</option>
                                        <option>Sales & Marketing</option>
                                    </select>
                                </div>
                            </li>
                            <li class="careerfy-user-form-coltwo-full">
                                <img src="extra-images/login-robot.png" alt="">
                            </li>
                            <li class="careerfy-user-form-coltwo-full">
                                <input type="submit" value="Sign Up">
                            </li>
                        </ul>
                    </div>
                    <div class="careerfy-box-title careerfy-box-title-sub">
                        <span>Or Sign Up With</span>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="careerfy-login-media">
                        <li><a href="#"><i class="fa fa-facebook"></i> Sign In with Facebook</a></li>
                        <li><a href="#" data-original-title="google"><i class="fa fa-google"></i> Sign In with
                                Google</a></li>
                        <li><a href="#" data-original-title="twitter"><i class="fa fa-twitter"></i> Sign In with
                                Twitter</a></li>
                        <li><a href="#" data-original-title="linkedin"><i class="fa fa-linkedin"></i> Sign In with
                                LinkedIn</a></li>
                    </ul>
                </form>

            </div>
        </div>
    </div> --}}

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/script/jquery.js"></script>
    <script src="/script/bootstrap.js"></script>
    <script src="/script/slick-slider.js"></script>
    <script src="/plugin-script/counter.js"></script>
    <script src="/plugin-script/fancybox.pack.js"></script>
    <script src="/plugin-script/isotope.min.js"></script>
    <script src="/plugin-script/functions.js"></script>
    {{-- <script src="/script/functions.js"></script> --}}
    @yield('footer-js')

</body>

</html>