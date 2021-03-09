<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Term;
use App\Models\JobMeta;
use Illuminate\Http\Request;
use App\Models\CandidateMeta;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request()->all());
        $locations = request()->query('location');
        $term = request()->query('term');
        $date = request()->query('date');
        $career = request()->query('career-level');
        $provider = request()->query('provider');


        $terms = Term::withCount(['jobs' => function($query){
                            $query->where('post_type', 'job_listing');
                        }])
                        ->whereHas('jobs', function($query){
                            $query->where('post_type', 'job_listing');
                        })
                        ->limit(20)
                        // ->having('jobs_count', '>', 0)
                        ->get();
        // dd($terms);
       
        $jobs = Job::with([
                    'term', 
                    'meta' => function($query) use($locations){
                        // if(request()->has('location')){
                        //     $query->whereIn('meta_value', $locations);
                        // }
                    }])
                    ->whereHas('meta', function($query) use($locations){
                        if(request()->has('location')){
                            $query->whereIn('meta_value', $locations);
                        }
                    })
                    ->whereHas('meta', function($query) use($career){
                        if(request()->has('career-level')){
                            $query->where('meta_value', 'LIKE' , "%{$career}%");
                        }
                    });

        if(request()->has('term')){
            $jobs->whereHas('term', function($query) use($term){
                $query->whereIn('slug', $term);
            });
        }

        if (request()->has('provider')) {
            $jobs->whereHas('meta', function($query) use($provider){
                $query->where('meta_value', $provider);
            });
        }

        if(request()->has('date')){
            $jobs->whereBetween('post_date', [Carbon::parse($date), now()]);
            // dd(Carbon::parse($date));

        }

        $jobs = $jobs->whereIn('post_type', ['job_listing', 'job'])
                    ->orderByDesc('post_date')
                    ->paginate()->onEachSide(1);

        // dd($jobs->first());
        return view('web.job.index', compact('jobs', 'terms'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id, Job $job)
    {
        $job->load('term', 'meta');

        // dd(auth()->user());
        $relatedJobs = Job::with([
                'term', 
                'meta'
            ])
            ->where('post_type', 'job_listing')
            ->limit(5)
            ->inRandomOrder()
            ->get();

        // $termJobs = collect([]);

        // if($job->term->first()){
        //     $termJobs = $job->term->first()->jobs()->limit(5)->get();
        // }    


        return view('web.job.show', compact('job', 'relatedJobs'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidateId = auth()->user()->ID;

        $candidate = Job::where('post_type', 'candidate')->where('post_author', $candidateId)->first();

        if($candidate == null){
            return redirect()->route('job.index');
        }


        if($request->get('cover_letter') != null){
            $jobCvrs = JobMeta::where('post_id', $id)
                    ->where('meta_key', 'jobsearch_job_apply_cvrs')
                    ->first();

            if($jobCvrs){
                $cvrs = unserialize($jobCvrs->meta_value);
                // if (array_key_exists($candidate->ID, $cvrs)) {
                    $cvrs[$candidate->ID] = $request->get('cover_letter');
                    $jobCvrs->update(['meta_value' => serialize($cvrs)]);
                // }

            }else {
                $cvrs = [$candidate->ID => $request->get('cover_letter')];

                $jobCvrs = JobMeta::create([
                            'post_id' => $id,
                            'meta_key' => 'jobsearch_job_apply_cvrs',
                            'meta_value' => serialize($cvrs)
                        ]);
            }
        }

        $jobApplicants = JobMeta::where('post_id', $id)
                            ->where('meta_key', 'jobsearch_job_applicants_list')
                            ->first();

        if($jobApplicants){
            $applicants = explode(",", $jobApplicants->meta_value);
            if(!array_search($candidate->ID , $applicants)){
                $applicants[] = $candidate->ID;
                $jobApplicants->update(['meta_value' => implode(",", $applicants)]);
            }
        }else {
            $cvrs = [$candidate->ID => $request->get('cover_letter')];

            $jobCvrs = JobMeta::create([
                        'post_id' => $id,
                        'meta_key' => 'jobsearch_job_applicants_list',
                        'meta_value' => $candidate->ID
                    ]);
        }

        $candidateMeta = CandidateMeta::where('user_id', $candidateId)
                                        ->where('meta_key', 'jobsearch-user-jobs-applied-list')
                                        ->first();

        if($candidateMeta){
            $candidateMetaAppliedList = unserialize($candidateMeta->meta_value);

            if(!array_search($id , $candidateMetaAppliedList)){
                $candidateMetaAppliedList[] = [
                    'post_id' => $id,
                    'date_time' => time()
                ];
                $candidateMeta->update(['meta_value' => serialize($candidateMetaAppliedList)]);
            }

        }



        return redirect()->to('https://recruitment.talentsmine.net/candidate/' . $candidate->post_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
