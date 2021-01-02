<?php

namespace App\Http\Controllers;

use App\Models\JobMeta;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JobController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm($job)
    {
        return view('job.login', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:wpqs_users,user_email',
            'password' => 'required'
        ]);

        $candidate = Candidate::where('user_email', $request->get('email'))->first();

        $auth = Hash::driver('wp')->check($request->get('password'), $candidate->user_pass);

        if($auth){
            $application = JobMeta::where('post_id', $request->get('job_id'))->where('meta_key', '_joburl')->first();
            return redirect($application->meta_value);
        }

        return back()->withInput()->with("status", "Sorry, your password not correct<br> <a href='#' >forget password</a>");


    }

}
