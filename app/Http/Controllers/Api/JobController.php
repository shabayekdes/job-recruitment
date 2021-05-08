<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('post_type' , 'job_listing')->paginate(1);

        return (new JobCollection($jobs))
                ->additional([
                    'success' => true,
                    'code' => 200,
                ]);

        dd(new JobCollection($jobs));
        return response()->json([
                'success' => true,
                'code' => 200,
                'data' => new JobCollection($jobs)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::with(['term','meta' => function ($query) {
            $query->where('meta_key' , 'jobsearch_field_location_location1')
            ->orWhere('meta_key' , 'jobsearch_field_company_name')
            ->orWhere('meta_key' , 'career-level')
            ->orWhere('meta_key' , 'experience')
            ->orWhere('meta_key' , 'career-level')
            ->orWhere('meta_key' , 'career-level')
            ->orWhere('meta_key' , 'career-level')
            ;
        }])->find($id);

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => new JobResource($job)
        ]);
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
        //
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
