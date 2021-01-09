<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Talents Mine - Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>

<body class="text-center" new-gr-c-s-check-loaded="14.990.0" gr-ext-installed="">

    <form class="form-signup" action="{{ route('job.register.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <img src="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/logox300.png" width="122" height="76"
            alt="Recruitment Talents Mine">
        <h1 class="h3 mt-5 font-weight-normal">Please sign up</h1>
        <p class="mb-3 text-muted mt-3">
            OR <a class="login-register-switch-link" href="{{ route('job.login.show', [$job]) }}">Login</a>
        </p>
        @if (session('status'))
        <div class="alert alert-danger">
            {!! session('status') !!}
        </div>
        @endif

        <input type="hidden" name="job_id" value="{{ $job }}">

        <div class="form-row">
            <div class="form-group col-md-6 text-left">
                <label for="fname">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="meta[0][meta_value]" id="fname">
                <input type="hidden" value="first_name" name="meta[0][meta_key]">
            </div>
            <div class="form-group col-md-6 text-left">
                <label for="lnam">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="meta[1][meta_value]" id="lnam">
                <input type="hidden" value="last_name" name="meta[1][meta_key]">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 text-left">
                <label for="user_login">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="user_login" id="user_login">
            </div>
            <div class="form-group col-md-6 text-left">
                <label for="user_email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="user_email" id="user_email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 text-left">
                <label for="user_pass">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="user_pass" id="user_pass">
            </div>
            <div class="form-group col-md-6 text-left">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" name="user_pass_confirmation" id="password_confirmation">
            </div>
        </div>
        <div class="form-group text-left">
            <label for="sector">Select Sector</label>
            <select class="form-control" name="sector" id="sector">
                <option value="">select one</option>
                <option value="36">Accounting and Auditing Services</option>
                <option value="34">Administration</option>
                <option value="41">Advertising</option>
                <option value="44">Aerospace Engineering</option>
                <option value="40">Agricultural / Fishing / Farming</option>
                <option value="37">Airlines / Aviation</option>
                <option value="43">Alternative Medicine</option>
                <option value="54">Animation</option>
                <option value="55">Architectural and Design Services</option>
                <option value="56">Arts and Crafts</option>
                <option value="57">Automotive</option>
                <option value="58">Banking</option>
                <option value="59">Biotechnology</option>
                <option value="60">Broadcasting and Film</option>
                <option value="61">Business Development</option>
                <option value="62">Business Supplies and Equipments</option>
                <option value="63">Capital Markets</option>
                <option value="64">Chemicals</option>
                <option value="65">Chemistry</option>
                <option value="66">Communication</option>
                <option value="68">Computer and Network Security</option>
                <option value="67">Computer Education</option>
                <option value="69">Computer Games</option>
                <option value="70">Computer Hardware</option>
                <option value="71">Computer Networking</option>
                <option value="72">Computer Software</option>
                <option value="73">Construction – Industrial Facilities and Infrastructure</option>
                <option value="74">Construction – Residential &amp; Commercial</option>
                <option value="75">Consultation</option>
                <option value="76">Consumer Electronics</option>
                <option value="77">Consumer Services</option>
                <option value="78">Cosmetics</option>
                <option value="39">Dairy</option>
                <option value="80">Decoration/Design</option>
                <option value="81">Dentistry</option>
                <option value="79">E-Learning</option>
                <option value="82">Education</option>
                <option value="83">Electronics</option>
                <option value="84">Energy &amp; Utilities</option>
                <option value="85">Engineering Services</option>
                <option value="86">Entertainment</option>
                <option value="87">Environmental Services</option>
                <option value="88">Fashion</option>
                <option value="90">Financial Analyst</option>
                <option value="89">Financial Services</option>
                <option value="91">Fine Arts</option>
                <option value="92">FMCG</option>
                <option value="93">Food and Beverage Production</option>
                <option value="94">Food Services / Restaurants / Catering</option>
                <option value="95">Furniture</option>
                <option value="96">Geology</option>
                <option value="97">Graphic Design</option>
                <option value="98">Health / Wellness and Fitness</option>
                <option value="99">Healthcare and Medical Services</option>
                <option value="100">Hospitality / Hotels</option>
                <option value="101">Human Resources</option>
                <option value="102">Import and Export</option>
                <option value="103">Information Technology Services</option>
                <option value="104">Insurance</option>
                <option value="105">Internet / E-Commerce</option>
                <option value="106">Investment Banking</option>
                <option value="107">Journalism</option>
                <option value="108">Legal Services</option>
                <option value="109">Libraries</option>
                <option value="110">Logistics and Supply Chain</option>
                <option value="111">Luxury Goods and Jewelry</option>
                <option value="112">Management Consulting</option>
                <option value="113">Manfacturing</option>
                <option value="114">Market Research</option>
                <option value="115">Marketing and Advertising</option>
                <option value="116">Media Production</option>
                <option value="117">Medical Devices and Supplies</option>
                <option value="118">Military</option>
                <option value="119">Mining and Metals</option>
                <option value="120">Nanotechnology</option>
                <option value="121">National Society Organization</option>
                <option value="122">Non-Profit Organizations</option>
                <option value="123">Oil &amp; Gas</option>
                <option value="124">Online Media</option>
                <option value="125">Operations</option>
                <option value="126">Outsourcing / Offshoring</option>
                <option value="127">Package / Freight Delivery</option>
                <option value="128">Packaging and Containers</option>
                <option value="129">Paper Products</option>
                <option value="130">Performing and Fine Arts</option>
                <option value="131">Personal Care and Services</option>
                <option value="132">Pharmaceuticals</option>
                <option value="133">Photography</option>
                <option value="134">Plastics</option>
                <option value="135">Printing</option>
                <option value="136">Procurement</option>
                <option value="137">Public Relations and Communications</option>
                <option value="138">Publishing/Publication</option>
                <option value="139">Real Estate / Property Management</option>
                <option value="140">Recreational Facilities and Services</option>
                <option value="141">Recruitment and Staffing</option>
                <option value="142">Research</option>
                <option value="143">Retail</option>
                <option value="144">Security</option>
                <option value="145">Telecommunications</option>
                <option value="147">Telemarketing</option>
                <option value="146">Textile and Clothing</option>
                <option value="148">Training and Coaching</option>
                <option value="149">Translation and Localization</option>
                <option value="150">Transportation</option>
                <option value="151">Travel and Tourism</option>
                <option value="152">Warehousing</option>
                <option value="153">Waste Management</option>
                <option value="154">Writing and Editing</option>
            </select>
        </div>

        <div class="form-group text-left">
            <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
        </div>

        <div class="form-group text-left">
            <label for="resume">Upload Resume <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" name="resume" id="resume">
            <small id="passwordHelpBlock" class="form-text text-muted">
                Drop a resume file or click to upload. To upload file size is <b>(Max 5Mb)</b> and allowed file types are <b>(.doc, .docx, .pdf)</b>
              </small>
          </div>

        <button type="submit" class="btn btn-primary">Sign in</button>

        <p class="mb-2 text-muted mt-3">
            <a href="https://recruitment.talentsmine.net/my-account/lost-password/">Lost your password?</a>
        </p>

        <p class="mt-5 mb-2 text-muted mt-3">Recruitment Talents Mine 2021</p>
    </form>

</body>

</html>