@extends('web.layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-subheader" style="background: url('images/subheader-bg.jpg') no-repeat center/cover;">
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
                        <form class="careerfy-search-filter">
                            <div class="careerfy-search-filter-wrap careerfy-without-toggle">
                                <h2><a href="#">Locations</a></h2>
                                <div class="careerfy-search-box">
                                    <input value="Search" onblur="if(this.value == '') { this.value ='Search'; }"
                                        onfocus="if(this.value =='Search') { this.value = ''; }" type="text">
                                    <input type="submit" value="">
                                    <i class="careerfy-icon careerfy-search"></i>
                                </div>
                                <ul class="careerfy-checkbox">
                                    <li>
                                        <input type="checkbox" id="r1" name="rr" />
                                        <label for="r1"><span></span>San Francisco</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="r2" name="rr" />
                                        <label for="r2"><span></span>Portland</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="r3" name="rr" />
                                        <label for="r3"><span></span>London</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="r4" name="rr" />
                                        <label for="r4"><span></span>Bangalore</label>
                                    </li>
                                </ul>
                                <a href="#" class="careerfy-seemore">+see more</a>
                            </div>
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Date Posted</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="checkbox" id="r5" name="rr" />
                                            <label for="r5"><span></span>Last Hour</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r6" name="rr" />
                                            <label for="r6"><span></span>Last 24 hours</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r7" name="rr" />
                                            <label for="r7"><span></span>Last 7 days</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r8" name="rr" />
                                            <label for="r8"><span></span>Last 14 days</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r9" name="rr" />
                                            <label for="r9"><span></span>Last 30 days</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r10" name="rr" />
                                            <label for="r10"><span></span>All</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                <h2><a href="#" class="careerfy-click-btn">Categories</a></h2>
                                <div class="careerfy-checkbox-toggle">
                                    <ul class="careerfy-checkbox">
                                        <li>
                                            <input type="checkbox" id="r17" name="rr" />
                                            <label for="r17"><span></span>Accountancy</label>
                                            <small>10</small>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r18" name="rr" />
                                            <label for="r18"><span></span>Banking</label>
                                            <small>2</small>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r19" name="rr" />
                                            <label for="r19"><span></span>Charity & Voluntary</label>
                                            <small>6</small>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r20" name="rr" />
                                            <label for="r20"><span></span>Digital & Creative</label>
                                            <small>4</small>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r21" name="rr" />
                                            <label for="r21"><span></span>Estate Agency</label>
                                            <small>19</small>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r22" name="rr" />
                                            <label for="r22"><span></span>Graduate</label>
                                            <small>5</small>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="r23" name="rr" />
                                            <label for="r23"><span></span>IT Contractor</label>
                                            <small>10</small>
                                        </li>
                                    </ul>
                                    <a href="#" class="careerfy-seemore">+see more</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
                <div class="careerfy-column-9 careerfy-typo-wrap">
                    <div class="careerfy-typo-wrap">
                        <!-- FilterAble -->
                        <div class="careerfy-filterable">
                            <h2 class="jobsearch-fltcount-title">
                                {{ $jobs->total() }} Jobs Found <div class="displayed-here">Displayed Here: 1 - 12 Jobs</div>
                            </h2>
                            {{-- <ul>
                                <li>
                                    <i class="careerfy-icon careerfy-sort"></i>
                                    <div class="careerfy-filterable-select">
                                        <select>
                                            <option>Sort</option>
                                            <option>Sort</option>
                                            <option>Sort</option>
                                        </select>
                                    </div>
                                </li>
                                <li><a href="#"><i class="careerfy-icon careerfy-squares"></i> Grid</a></li>
                                <li><a href="#"><i class="careerfy-icon careerfy-list"></i> List</a></li>
                            </ul> --}}
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
                                                <h2><a href="#">{{ $job->post_title }}</a>
                                                    @if ($job->meta->where('meta_key',
                                                    '_featured')->first()->meta_value)
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
                                                        <i
                                                            class="jobsearch-icon jobsearch-calendar"></i>{{ $job->post_date }}
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
                        <div class="careerfy-pagination-blog">
                            <ul class="page-numbers">
                                <li><a class="prev page-numbers" href="#"><span><i
                                                class="careerfy-icon careerfy-arrows4"></i></span></a></li>
                                <li><span class="page-numbers current">01</span></li>
                                <li><a class="page-numbers" href="#">02</a></li>
                                <li><a class="page-numbers" href="#">03</a></li>
                                <li><a class="page-numbers" href="#">04</a></li>
                                <li><a class="next page-numbers" href="#"><span><i
                                                class="careerfy-icon careerfy-arrows4"></i></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Main Section -->

</div>
<!-- Main Content -->
@endsection