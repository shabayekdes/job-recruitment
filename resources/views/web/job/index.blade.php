@extends('web.layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-without-bg"
    style="background: url('images/subheader-bg.jpg') no-repeat center/cover;">
    <span class="careerfy-banner-transparent" style="background-color: rgba(30,49,66,0.85) !important;"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="careerfy-page-title">
                    <h1>Jobs Search Engine</h1>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- SubHeader -->

<!-- Main Content -->
<div class="careerfy-main-content">

    <!-- Main Section -->
    <div class="careerfy-main-section careerfy-subheader-form-full">
        <div class="container">
            <div class="row">

                <div class="col-md-12 careerfy-typo-wrap">
                    <!-- Sub Header Form -->
                    <div class="careerfy-subheader-form">
                        <form class="careerfy-banner-search" method="GET" action="{{ route('job.index') }}">
                            <ul>
                                <li>
                                    <input name="search" value="{{ old('search') ?? request()->query('search') }}"
                                        placeholder="Job Title, Keywords, or Company" type="text">
                                </li>
                                <li>
                                    <input name="location[]" value="{{ empty($locations) ? '' : $locations[0] }}"
                                        placeholder="City, State or ZIP" type="text">
                                    <i class="careerfy-icon careerfy-location"></i>
                                </li>
                                <li>
                                    <div class="careerfy-select-style">
                                        <select name="term[]">
                                            <option value="">Select one</option>
                                            @foreach ($terms as $term)
                                            <option value="{{ $term->term_id }}"
                                                {{ in_array($term->term_id, request()->query('term', []) ) ? 'selected' : '' }}>
                                                {{ $term->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li class="careerfy-banner-submit"> <input type="submit" value=""> <i
                                        class="careerfy-icon careerfy-search"></i> </li>
                            </ul>
                        </form>
                    </div>
                    <!-- Sub Header Form -->
                </div>

            </div>
        </div>
    </div>
    <!-- Main Section -->

    <!-- Main Section -->
    <div class="careerfy-main-section">
        <div class="container">
            <div class="row">

                <aside class="careerfy-column-3 careerfy-typo-wrap">
                    <div class="careerfy-typo-wrap">
                        <form class="careerfy-search-filter" action="{{ route('job.index') }}" method="GET">

                            <a href="{{ route('job.index') }}" class="careerfy-seemore">Reset filter</a>

                            {{-- Locations --}}
                            <div class="careerfy-search-filter-wrap careerfy-without-toggle">
                                <h2><a href="#">Locations</a></h2>
                                <ul class="careerfy-checkbox">
                                    <li>
                                        <input type="checkbox" id="egypt"
                                            {{ in_array("Egypt", request()->query('location', [])  ) ? 'checked' : '' }}
                                            name="location[]" value="Egypt" />
                                        <label for="egypt"><span></span>Egypt</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="saudi-arabia"
                                            {{ in_array("Saudi Arabia", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Saudi Arabia" />
                                        <label for="saudi-arabia"><span></span>Saudi Arabia</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="uae"
                                            {{ in_array("UAE", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="UAE" />
                                        <label for="uae"><span></span>UAE</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="kuwait"
                                            {{ in_array("Kuwait", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Kuwait" />
                                        <label for="kuwait"><span></span>Kuwait</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="bahrain"
                                            {{ in_array("Bahrain", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Bahrain" />
                                        <label for="bahrain"><span></span>Bahrain</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="qatar"
                                            {{ in_array("Qatar", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Qatar" />
                                        <label for="qatar"><span></span>Qatar</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="oman"
                                            {{ in_array("Oman", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Oman" />
                                        <label for="oman"><span></span>Oman</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="lebanon"
                                            {{ in_array("Lebanon", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Lebanon" />
                                        <label for="lebanon"><span></span>Lebanon</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="jordan"
                                            {{ in_array("Jordan", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Jordan" />
                                        <label for="jordan"><span></span>Jordan</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="iraq"
                                            {{ in_array("Iraq", request()->query('location', []) ) ? 'checked' : '' }}
                                            name="location[]" value="Iraq" />
                                        <label for="iraq"><span></span>Iraq</label>
                                    </li>
                                </ul>
                                <a href="#" id="location" class="careerfy-seemore">+see more</a>
                            </div>
                            {{-- Date Posted --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Date Posted</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" id="r5" name="date"
                                                {{ request()->query('date') == now()->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->format('Y-m-d') }}" />
                                            <label for="r5"><span></span>Today</label>
                                        </li>
                                        {{-- <li>
                                            <input type="radio" id="r6" name="date" {{ request()->query('date') == now()->subDay()->format('Y-m-d') ? 'checked' : '' }}
                                        value="{{ now()->subDay()->format('Y-m-d') }}" />
                                        <label for="r6"><span></span>Yesterday</label>
                                        </li> --}}
                                        <li>
                                            <input type="radio" id="r7" name="date"
                                                {{ request()->query('date') == now()->subDays(7)->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->subDays(7)->format('Y-m-d') }}" />
                                            <label for="r7"><span></span>Last 7 days</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="r8" name="date"
                                                {{ request()->query('date') == now()->subDays(14)->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->subDays(14)->format('Y-m-d') }}" />
                                            <label for="r8"><span></span>Last 14 days</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="r9" name="date"
                                                {{ request()->query('date') == now()->subDays(30)->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->subDays(30)->format('Y-m-d') }}" />
                                            <label for="r9"><span></span>Last 30 days</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- Job Type --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Job Type</a></h2>
                                <div class="careerfy-checkbox-toggle" style="display: block;">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" id="job_type_1" name="job_type" value="freelance">
                                            <label for="job_type_1"><span></span>Freelance </label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_2" name="job_type" value="full-time">
                                            <label for="job_type_2"><span></span>Full time </label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_3" name="job_type" value="part-time">
                                            <label for="job_type_3"><span></span>Part time </label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_4" name="job_type" value="temporary">
                                            <label for="job_type_4"><span></span>Temporary </label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_5" name="job_type" value="work-from-home">
                                            <label for="job_type_5"><span></span>Work From Home </label>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" id="job_type_1" name="job_type"
                                                {{ request()->query('job_type') == now()->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->format('Y-m-d') }}" />
                                            <label for="job_type_1"><span></span>Freelance</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_2" name="job_type"
                                                {{ request()->query('job_type') == now()->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->format('Y-m-d') }}" />
                                            <label for="job_type_2"><span></span>Part time</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_3" name="job_type"
                                                {{ request()->query('job_type') == now()->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->format('Y-m-d') }}" />
                                            <label for="job_type_3"><span></span>Full time</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_4" name="job_type"
                                                {{ request()->query('job_type') == now()->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->format('Y-m-d') }}" />
                                            <label for="job_type_4"><span></span>Temporary</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="job_type_5" name="job_type"
                                                {{ request()->query('job_type') == now()->format('Y-m-d') ? 'checked' : '' }}
                                                value="{{ now()->format('Y-m-d') }}" />
                                            <label for="job_type_5"><span></span>Work From Home</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- Career Level --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Career Level</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" id="career1" name="career-level"
                                                {{ request()->query('career-level') == "Intern" ? 'checked' : '' }}
                                                value="Intern" />
                                            <label for="career1"><span></span>Intern</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="career2" name="career-level"
                                                {{ request()->query('career-level') == "junior" ? 'checked' : '' }}
                                                value="junior" />
                                            <label for="career2"><span></span>junior</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="career3" name="career-level"
                                                {{ request()->query('career-level') == "Experienced (Non-Manager)" ? 'checked' : '' }}
                                                value="Experienced (Non-Manager)" />
                                            <label for="career3"><span></span>Experienced (Non-Manager)</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="career4" name="career-level"
                                                {{ request()->query('career-level') == "Senior Management" ? 'checked' : '' }}
                                                value="Senior Management" />
                                            <label for="career4"><span></span>Senior Management</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="career5" name="career-level"
                                                {{ request()->query('career-level') == "manager" ? 'checked' : '' }}
                                                value="manager" />
                                            <label for="career5"><span></span>manager</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- Categories --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Categories</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        @foreach ($terms as $term)
                                        <li class="{{ $loop->iteration > 5 ? "filter-more-fields-terms" : "" }}">
                                            <input type="checkbox" id="{{ $term->term_id }}"
                                                {{ in_array($term->term_id, request()->query('term', []) ) ? 'checked' : '' }}
                                                name="term[]" value="{{ $term->term_id }}" />
                                            <label for="{{ $term->term_id }}"><span></span>{{ $term->name }}</label>
                                            <small>{{ $term->jobs_count }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <a href="#" id="term" class="careerfy-seemore">+see more</a>
                                </div>
                            </div>
                            {{-- Experience --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Experience</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" name="experience" id="experience_1" value="fresh">
                                            <label for="experience_1">
                                                <span></span>Fresh </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="experience" id="experience_2"
                                                value="less-than-1-year">
                                            <label for="experience_2">
                                                <span></span>Less Than 1 Year </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="experience" id="experience_3" value="2-years">
                                            <label for="experience_3">
                                                <span></span>2 Years </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="experience" id="experience_4" value="3-years">
                                            <label for="experience_4">
                                                <span></span>3 Years </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="experience" id="experience_5" value="4-years">
                                            <label for="experience_5">
                                                <span></span>4 Years </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="experience" id="experience_6" value="5-years">
                                            <label for="experience_6">
                                                <span></span>5 Years </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- Gender --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Gender</a></h2>
                                <div class="careerfy-checkbox-toggle" style="display: none;">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" name="gender" id="gender_1" value="male">
                                            <label for="gender_1">
                                                <span></span>Male </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="gender" id="gender_2" value="female">
                                            <label for="gender_2">
                                                <span></span>Female </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="gender" id="gender_3" value="any">
                                            <label for="gender_3">
                                                <span></span>Any </label>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            {{-- Industry --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Industry</a></h2>
                                <div class="careerfy-checkbox-toggle" style="display: none;">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" name="industry" id="industry_1"
                                                value="Accounting / Finanace">
                                            <label for="industry_1">
                                                <span></span>Accounting / Finanace </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="industry" id="industry_2" value="Administration">
                                            <label for="industry_2">
                                                <span></span>Administration </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="industry" id="industry_3" value="Analyst">
                                            <label for="industry_3">
                                                <span></span>Analyst </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="industry" id="industry_4" value="Research">
                                            <label for="industry_4">
                                                <span></span>Research </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="industry" id="industry_5" value="Banking">
                                            <label for="industry_5">
                                                <span></span>Banking </label>
                                        </li>
                                        <li>
                                            <input type="radio" name="industry" id="industry_6"
                                                value="Business Development">
                                            <label for="industry_6">
                                                <span></span>Business Development </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- Qualifications --}}
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Qualifications</a></h2>
                                <div class="careerfy-checkbox-toggle" style="display: none;">
                                    <ul class="careerfy-checkbox">
                                        <li class="">
                                            <input type="radio" name="qualifications" id="qualifications_1" value="PHD">
                                            <label for="qualifications_1">
                                                <span></span>PHD </label>
                                        </li>
                                        <li class="">
                                            <input type="radio" name="qualifications" id="qualifications_2"
                                                value="Masters">
                                            <label for="qualifications_2">
                                                <span></span>Masters </label>
                                        </li>
                                        <li class="">
                                            <input type="radio" name="qualifications" id="qualifications_3"
                                                value="Diploma">
                                            <label for="qualifications_3">
                                                <span></span>Diploma </label>
                                        </li>
                                        <li class="">
                                            <input type="radio" name="qualifications" id="qualifications_4"
                                                value="Bachelor-Degree">
                                            <label for="qualifications_4">
                                                <span></span>Bachelor Degree </label>
                                        </li>
                                        <li class="">
                                            <input type="radio" name="qualifications" id="qualifications_5"
                                                value="High-School">
                                            <label for="qualifications_5">
                                                <span></span>High School </label>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <input type="submit" class="careerfy-filter-submit" value="Apply Filter">
                        </form>
                    </div>
                </aside>
                <div class="careerfy-column-9 careerfy-typo-wrap">
                    <div class="careerfy-typo-wrap">
                        <!-- FilterAble -->
                        <div class="careerfy-filterable">
                            <h2 class="careerfy-fltcount-title">
                                {{ $jobs->total() }} Jobs Found <div class="displayed-here">Displayed Here:
                                    {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} Jobs</div>
                            </h2>
                        </div>
                        <!-- FilterAble -->
                        <!-- JobGrid -->
                        <div class="careerfy-job careerfy-joblisting-classic">
                            <ul class="careerfy-row">
                                @foreach ($jobs as $job)
                                {{-- {{ dd($job) }} --}}
                                <li class="careerfy-column-12">
                                    <div class="careerfy-joblisting-classic-wrap">
                                        <figure><a href="#"><img src="extra-images/job-listing-logo-1.png" alt=""></a>
                                        </figure>
                                        <div class="careerfy-joblisting-text">
                                            <div class="careerfy-list-option">
                                                <h2><a
                                                        href="{{ route('job.show', ['id' => $job->ID, 'job' => $job->post_name]) }}">{{ $job->post_title }}</a>
                                                    @if ($job->meta->where('meta_key', '_featured')->first())
                                                    <span>Featured</span>
                                                    @endif
                                                </h2>
                                                <ul>
                                                    <li><i class="careerfy-icon careerfy-maps-and-flags"></i>
                                                        {{ $job->meta->where('meta_key', 'careerfy_field_location_location1')->first()->meta_value ?? "" }}
                                                        {{ $job->meta->where('meta_key', 'careerfy_field_location_address')->first()->meta_value ?? "" }}
                                                    </li>
                                                    <li><i class="careerfy-icon careerfy-maps-and-flags"></i>
                                                        {{ $job->meta->where('meta_key', 'careerfy_field_company_name')->first()->meta_value ?? "" }}
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-clock-o"></i>Published
                                                        {{ $job->post_date->diffForHumans() }}
                                                    </li>
                                                    @if ($job->term->first())
                                                    <li><i class="careerfy-icon careerfy-filter-tool-black-shape"></i>
                                                        {{ $job->term->first()->name ?? '' }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            {{-- <div class="careerfy-job-userlist">
                                                <a href="#" class="careerfy-option-btn">Freelance</a>
                                                <a href="#" class="careerfy-job-like"><i class="fa fa-heart"></i></a>
                                            </div> --}}
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Pagination -->
                        {{ $jobs->links('web.view.paginate') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Main Section -->

</div>
<!-- Main Content -->
@endsection

@section('footer-js')
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#location" ).click(function(e) {
            e.preventDefault();
            $( ".filter-more-fields-location" ).removeClass()
        });
        $( "#term" ).click(function(e) {
            e.preventDefault();
            $( ".filter-more-fields-terms" ).removeClass()
        });

                // Remove empty fields from GET forms
        // Author: Bill Erickson
        // URL: http://www.billerickson.net/code/hide-empty-fields-get-form/
        
            // Change 'form' to class or ID of your specific form
            $("form").submit(function() {
                $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
                return true; // ensure form still submits
            });
            
            // Un-disable form fields when page loads, in case they click back after submission
            $( "form" ).find( ":input" ).prop( "disabled", false );
    });  
</script>
@endsection