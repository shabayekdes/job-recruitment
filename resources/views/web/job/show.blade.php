@extends('web.layouts.app')

@section('content')
<!-- SubHeader -->
<div class="careerfy-job-subheader">
    <span class="careerfy-banner-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</div>
<!-- SubHeader -->

<!-- Main Content -->
<div class="careerfy-main-content">

    <!-- Main Section -->
    <div class="careerfy-main-section">
        <div class="container">
            <div class="row">

                <!-- Job Detail List -->
                <div class="careerfy-column-12">
                    <div class="careerfy-typo-wrap">
                        <figure class="careerfy-jobdetail-list">
                            <span class="careerfy-jobdetail-listthumb">
                                <img src="{{ $thumbUrl != null ? $thumbUrl : '/images/company-logo.png' }}" alt=""></span>
                            <figcaption>
                                <h2>{{ $job->post_title }}</h2>
                                @if ($job->term->first())
                                <span>{{ $job->term->first()->name ?? '' }}</span>
                                @endif
                                <ul class="careerfy-jobdetail-options">
                                    <li><i class="fa fa-map-marker"></i>
                                        {{ $job->meta->where('meta_key', 'jobsearch_field_location_location1')->first()->meta_value ?? "" }}
                                    </li>
                                    <li><i class="careerfy-icon careerfy-calendar"></i> Post Date:
                                        {{ $job->post_date->diffForHumans() }}</li>
                                    {{-- <li><i class="careerfy-icon careerfy-summary"></i> Applications 4</li> --}}
                                    {{-- <li><a href="#"><i class="careerfy-icon careerfy-view"></i> Views 3806</a></li> --}}
                                </ul>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- Job Detail List -->

                <!-- Job Detail Content -->
                <div class="careerfy-column-8">
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-jobdetail-content">
                            <div class="careerfy-content-title">
                                <h2>Job Detail</h2>
                            </div>
                            <div class="careerfy-jobdetail-services">
                                <ul class="careerfy-row">
                                    <li class="careerfy-column-4">
                                        <i class="careerfy-icon careerfy-network"></i>
                                        <div class="careerfy-services-text">Industry
                                            <small>{{ $job->term->first()->name ?? '' }}</small></div>
                                    </li>
                                    <li class="careerfy-column-4">
                                        <i class="careerfy-icon careerfy-social-media"></i>
                                        <div class="careerfy-services-text">Career Level
                                            <small>{{ $job->meta->where('meta_key', 'career-level')->first()->meta_value ?? '-' }}</small>
                                        </div>
                                    </li>
                                    <li class="careerfy-column-4">
                                        <i class="careerfy-icon careerfy-briefcase"></i>
                                        <div class="careerfy-services-text">Experience
                                            <small>{{ $job->meta->where('meta_key', 'experience')->first()->meta_value ?? '-' }}</small>
                                        </div>
                                    </li>
                                    {{-- <li class="careerfy-column-4">
                                        <i class="careerfy-icon careerfy-user"></i>
                                        <div class="careerfy-services-text">Gender <small>Male</small></div>
                                    </li> --}}
                                    {{-- <li class="careerfy-column-4">
                                        <i class="careerfy-icon careerfy-mortarboard"></i>
                                        <div class="careerfy-services-text">Qualification <small>Master’s Degree</small>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="careerfy-content-title">
                                <h2>Job Description</h2>
                            </div>
                            <div class="careerfy-description">
                                <p>{!! $job->post_content !!}</p>
                            </div>
                        </div>
                        <div class="careerfy-section-title">
                            <h2>Other jobs you may like</h2>
                        </div>
                        <div class="careerfy-job careerfy-joblisting-classic careerfy-jobdetail-joblisting">
                            <ul class="careerfy-row">
                                @foreach ($relatedJobs as $relatedJob)

                                <li class="careerfy-column-12">
                                    <div class="careerfy-joblisting-classic-wrap">
                                        <figure><a href="#"><img src="/images/company-logo.png" alt=""></a>
                                        </figure>
                                        <div class="careerfy-joblisting-text">
                                            <div class="careerfy-list-option">
                                                <h2><a
                                                        href="{{ route('job.show', ['id' => $relatedJob->ID, 'job' => $relatedJob->post_name]) }}">{{ $relatedJob->post_title }}</a>
                                                    @if ($job->meta->where('meta_key', '_featured')->first())
                                                    <span>Featured</span>
                                                    @endif
                                                </h2>
                                                <ul>
                                                    <li><i class="careerfy-icon careerfy-maps-and-flags"></i>
                                                        {{ $relatedJob->meta->where('meta_key', 'jobsearch_field_location_location1')->first()->meta_value ?? '' }}
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-clock-o"></i>Published
                                                        {{ $relatedJob->post_date->diffForHumans() }}
                                                    </li>
                                                    @if ($relatedJob->term->first())
                                                    <li><i class="careerfy-icon careerfy-filter-tool-black-shape"></i>
                                                        {{ $relatedJob->term->first()->name ?? '' }}</li>
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
                    </div>
                </div>
                <!-- Job Detail Content -->
                <!-- Job Detail SideBar -->
                <aside class="careerfy-column-4">
                    <div class="careerfy-typo-wrap">
                        <div class="widget widget_apply_job">
                            <div class="widget_apply_job_wrap">
                                @guest
                                <a href="{{ route('login.show', [$job]) }}" class="careerfy-applyjob-btn">Login to Apply to Job </a>
                                @else
                                @if ($job->post_type == 'job')
                                <!-- Button trigger modal -->
                                <button type="button" class="careerfy-applyjob-btn" {{ $candidateApplied ? 'disabled' : ''}} data-toggle="modal"
                                    data-target="#applyJobModal">
                                    {{ $candidateApplied ? 'Already applied!!' : 'Apply for the job'}}
                                </button>
                                @else
                                <a href="{{ $job->meta->where('meta_key', 'app_joburl')->first()->meta_value }}"
                                    class="careerfy-applyjob-btn">Apply for the job</a>
                                @endif
                                @endguest
                            </div>
                        </div>

                        <div class="widget widget_add">
                            <img src="extra-images/jobdetail-add.jpg" alt="">
                        </div>
                        {{-- <div class="widget widget_view_jobs">
                            <div class="careerfy-widget-title">
                                <h2>More Jobs from {{ $job->term->first()->name ?? '' }}</h2>
                    </div>
                    <ul>
                        @foreach ($termJobs as $termJob)
                        <li>
                            <h6><a
                                    href="{{ route('job.show', ['id' => $termJob->ID, 'job' => $termJob->post_name]) }}">{{ $termJob->post_title }}</a>
                            </h6>
                            <small>
                                {{ $termJob->meta->where('meta_key', 'jobsearch_field_location_location1')->first()->meta_value ?? ""}}</small>
                        </li>
                        @endforeach
                    </ul>
                    <a href="#" class="widget_view_jobs_btn">View all jobs <i
                            class="careerfy-icon careerfy-arrows32"></i></a>
            </div> --}}
        </div>
        </aside>
        <!-- Job Detail SideBar -->

    </div>
</div>
</div>

<!-- Main Section -->

<!-- Modal -->
<div class="modal fade" id="applyJobModal" tabindex="-1" role="dialog" aria-labelledby="applyJobModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('candidate.apply', [$job])}}" method="post">
                @csrf
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Cover letter</label>
                        <textarea class="form-control" name="cover_letter" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="careerfy-applyjob-btn">Apply for the job</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Main Content -->
@endsection

@section('footer-js')
<script type="text/javascript">
    $( document ).ready(function() {

    });
</script>
@endsection
