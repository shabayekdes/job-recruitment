@extends('web.layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader careerfy-subheader-without-bg" style="background: url('images/subheader-bg.jpg') no-repeat center/cover;">
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
<div class="careerfy-breadcrumb">
    <ul>
        <li><a href="https://recruitment.talentsmine.net//">Home</a></li>
        <li class="active">Jobs</li>
    </ul>
</div>

<!-- Main Content -->
<div class="careerfy-main-content">

    <!-- Main Section -->
    <div class="careerfy-main-section">
        <div class="container">
            <div class="row">

                <aside class="careerfy-column-3 careerfy-typo-wrap">
                    <div class="careerfy-typo-wrap">
                        <form class="careerfy-search-filter" action="{{ route('job.index') }}" method="GET">
                            <input type="submit" class="careerfy-filter-submit" value="Filter">

                            <div class="careerfy-search-filter-wrap careerfy-without-toggle">
                                <h2><a href="#">Locations</a></h2>
                                <ul class="careerfy-checkbox">
                                    <li>
                                        <input type="checkbox" id="egypt" {{ in_array("Egypt", request()->query('location', [])  ) ? 'checked' : '' }} name="location[]" value="Egypt" />
                                        <label for="egypt"><span></span>Egypt</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="saudi-arabia" {{ in_array("Saudi Arabia", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Saudi Arabia" />
                                        <label for="saudi-arabia"><span></span>Saudi Arabia</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="uae" {{ in_array("UAE", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="UAE" />
                                        <label for="uae"><span></span>UAE</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="kuwait" {{ in_array("Kuwait", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Kuwait" />
                                        <label for="kuwait"><span></span>Kuwait</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="bahrain" {{ in_array("Bahrain", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Bahrain" />
                                        <label for="bahrain"><span></span>Bahrain</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="qatar" {{ in_array("Qatar", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Qatar" />
                                        <label for="qatar"><span></span>Qatar</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="oman" {{ in_array("Oman", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Oman" />
                                        <label for="oman"><span></span>Oman</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="lebanon" {{ in_array("Lebanon", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Lebanon" />
                                        <label for="lebanon"><span></span>Lebanon</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="jordan" {{ in_array("Jordan", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Jordan" />
                                        <label for="jordan"><span></span>Jordan</label>
                                    </li>
                                    <li class="filter-more-fields-location">
                                        <input type="checkbox" id="iraq" {{ in_array("Iraq", request()->query('location', []) ) ? 'checked' : '' }} name="location[]" value="Iraq" />
                                        <label for="iraq"><span></span>Iraq</label>
                                    </li>
                                </ul>
                                <a href="#" id="location" class="careerfy-seemore">+see more</a>
                            </div>
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Date Posted</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="radio" id="r6" name="date" {{ request()->query('date') == now()->format('Y-m-d') ? 'checked' : '' }} value="{{ now()->format('Y-m-d') }}" />
                                            <label for="r6"><span></span>Today</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="r6" name="date" {{ request()->query('date') == now()->subDay()->format('Y-m-d') ? 'checked' : '' }} value="{{ now()->subDay()->format('Y-m-d') }}" />
                                            <label for="r6"><span></span>Yesterday</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="r7" name="date" {{ request()->query('date') == now()->subDays(7)->format('Y-m-d') ? 'checked' : '' }} value="{{ now()->subDays(7)->format('Y-m-d') }}" />
                                            <label for="r7"><span></span>Last 7 days</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="r8" name="date" {{ request()->query('date') == now()->subDays(14)->format('Y-m-d') ? 'checked' : '' }} value="{{ now()->subDays(14)->format('Y-m-d') }}" />
                                            <label for="r8"><span></span>Last 14 days</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="r9" name="date" {{ request()->query('date') == now()->subDays(30)->format('Y-m-d') ? 'checked' : '' }} value="{{ now()->subDays(30)->format('Y-m-d') }}" />
                                            <label for="r9"><span></span>Last 30 days</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Categories</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        @foreach ($terms as $term)
                                        <li class="{{ $loop->iteration > 5 ? "filter-more-fields-terms" : "" }}">
                                            <input type="checkbox" id="{{ $term->slug }}" {{ in_array($term->slug, request()->query('term', []) ) ? 'checked' : '' }} name="term[]" value="{{ $term->slug }}" />
                                            <label for="{{ $term->slug }}"><span></span>{{ $term->name }}</label>
                                            <small>{{ $term->jobs_count }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <a href="#" id="term" class="careerfy-seemore">+see more</a>
                                </div>
                            </div>
                            <a href="{{ route('job.index') }}" class="careerfy-seemore">Reset filter</a>
                        </form>
                    </div>
                </aside>
                <div class="careerfy-column-9 careerfy-typo-wrap">
                    <div class="careerfy-typo-wrap">
                        <!-- FilterAble -->
                        <div class="careerfy-filterable">
                            <h2 class="jobsearch-fltcount-title">
                                {{ $jobs->total() }} Jobs Found <div class="displayed-here">Displayed Here: {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} Jobs</div>
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
                                                <h2><a href="{{ $job->ID }}">{{ $job->post_title }}</a>
                                                    @if ($job->meta->where('meta_key', '_featured')->first()->meta_value)
                                                    <span>Featured</span>
                                                    @endif
                                                </h2>
                                                <ul>
                                                    <li><i class="careerfy-icon careerfy-maps-and-flags"></i>
                                                        {{ $job->meta->where('meta_key', '_job_location')->first()->meta_value }}
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-clock-o"></i>Published {{ $job->post_date->diffForHumans() }}
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
    });   
</script>  
@endsection