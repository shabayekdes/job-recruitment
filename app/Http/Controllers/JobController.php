<?php

namespace App\Http\Controllers;

use App\Models\JobMeta;
use App\Models\Candidate;
use App\Models\CandidateMeta;
use App\Models\Job;
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
            $application = JobMeta::where('post_id', $request->get('job_id'))->where('meta_key', 'app_joburl')->first();
            return redirect($application->meta_value);
        }

        return back()->withInput()->with("status", "Sorry, your password not correct<br> <a href='#' >forget password</a>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm($job)
    {
        return view('job.register', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'meta.*.meta_key' => 'required|string',
            'meta.*.meta_value' => 'required|string',
            'user_login' => 'required|string|unique:wpqs_users,user_login',
            'user_email' => 'required|email|unique:wpqs_users,user_email',
            'user_pass' => 'required|string|min:5|confirmed',
            'sector' => 'required',
            'mobile' => 'required|string',
        ],[
            'meta.0.meta_value.required' => 'The first name field is required.',
            'meta.1.meta_value.required' => 'The last name field is required.',

        ]);
        
        $fullName = $request->input('meta.0.meta_value') . " " . $request->input('meta.1.meta_value');
        $hash = Hash::driver('wp')->make($request->get('password'));

        $candidate = Candidate::create([
            "user_login" => $request->get('user_login'),
            "user_pass" =>  $hash,
            "user_nicename" => $request->get('user_login'),
            "user_email" => $request->get('user_email'),
            "user_url" => "",
            "user_registered" => now(),
            "user_activation_key" => "",
            "user_status" => 0,
            "display_name" => $fullName,
        ]);

        $job = Job::create([
            "post_author" => $candidate->ID,
            "post_date" => now(),
            "post_date_gmt" => now(),
            "post_content" => "",
            "post_title" => $fullName,
            "post_excerpt" => "",
            "post_status" => "publish",
            "comment_status" => "closed",
            "ping_status" => "closed",
            "post_password" => "",
            "post_name" => $request->get('user_login'),
            "to_ping" => "",
            "pinged" => "",
            "post_modified" => now(),
            "post_modified_gmt" => now(),
            "post_content_filtered" => "",
            "post_parent" => 0,
            "guid" => "http://recruitment.talentsmine.net/candidate/{$candidate->ID}",
            "menu_order" => 0,
            "post_type" => "candidate",
            "post_mime_type" => "",
            "comment_count" => 0,
        ]);

        $candidate->meta()->createMany($request->get('meta'));

        $candidateMeta = [
            [
                "meta_value" => $request->get('mobile'),
                "meta_key" => "mobile-number3804497",
            ],
            [
                "meta_value" => "",
                "meta_key" => "mobile-number",
            ],
            [
                "meta_value" => $job->ID,
                "meta_key" => "jobsearch_candidate_id",
            ],
            [
                "meta_key" => "nickname",
                "meta_value" => $request->get('user_login'),
            ],
            [
                "meta_key" => "description",
                "meta_value" => "",
            ],
            [
                "meta_key" => "rich_editing",
                "meta_value" => "true",
            ],
            [
                "meta_key" => "syntax_highlighting",
                "meta_value" => "true",
            ],
            [
                "meta_key" => "comment_shortcuts",
                "meta_value" => "false",
            ],
            [
                "meta_key" => "admin_color",
                "meta_value" => "fresh",
            ],
            [
                "meta_key" => "use_ssl",
                "meta_value" => "0",
            ],
            [
                "meta_key" => "show_admin_bar_front",
                "meta_value" => "false",
            ],
            [
                "meta_key" => "locale",
                "meta_value" => "",
            ],
            [
                "meta_key" => "wpqs_capabilities",
                "meta_value" => 'a:1:{s:18:"jobsearch_employer";b:1;}',
            ],
            [
                "meta_key" => "wpqs_user_level",
                "meta_value" => "0",
            ],
            [
                "meta_key" => "last_update",
                "meta_value" => "1577022807",
            ],

            [
                "meta_key" => "jobsearch_field_candidate_jobtitle",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_candidate_salary",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_facebook_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_twitter_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_google_plus_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_linkedin_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_dribbble_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_location_address",
                "meta_value" => "",
            ],
            [
                "meta_key" => "academic-level",
                "meta_value" => "",
            ],
            [
                "meta_key" => "age",
                "meta_value" => "",
            ],
            [
                "meta_key" => "gender",
                "meta_value" => "",
            ],
            [
                "meta_key" => "industry",
                "meta_value" => "",
            ],
            [
                "meta_key" => "wpqs_show_admin_bar_front",
                "meta_value" => "",
            ],
            [
                "meta_key" => "wc_last_active",
                "meta_value" => "1576972800",
            ]
        ];
        $candidate->meta()->createMany($candidateMeta);

        $jobMeta = [
            [
                'meta_key' => 'action',
                'meta_value' => 'jobsearch_register_member_submit',
            ],
            [
                'meta_key' => 'register-security',
                'meta_value' => 'd9dffe7034',
            ],
            [
                'meta_key' => '_wp_http_referer',
                'meta_value' => '/',
            ],
            [
                'meta_key' => 'jobsearch_user_id',
                'meta_value' => $candidate->ID,
            ],
            [
                'meta_key' => 'jobsearch_field_user_email',
                'meta_value' => $request->get('user_email'),
            ],
            [
                'meta_key' => 'post_date',
                'meta_value' => '1585494141',
            ],
            [
                'meta_key' => 'jobsearch_field_candidate_approved',
                'meta_value' => 'on',
            ],
            [
                'meta_key' => 'overall_skills_percentage',
                'meta_value' => '20',
            ],
            [
                'meta_key' => 'member_display_name',
                'meta_value' => $fullName,
            ],
            [
                'meta_key' => 'jobsearch_candidate_views_count',
                'meta_value' => '0',
            ],
            [
                'meta_key' => 'mobile-number3804497',
                'meta_value' => $request->get('mobile'),
            ],
            [
                'meta_key' => '_edit_lock',
                'meta_value' => '1586178930:1',
            ],
            [
                'meta_key' => 'jobsearch_field_notific_newjobpost',
                'meta_value' => 'yes',
            ],
            [
                'meta_key' => 'jobsearch_field_notific_shortforinter',
                'meta_value' => 'yes',
            ],
            [
                'meta_key' => 'jobsearch_field_notific_rejctforinter',
                'meta_value' => 'yes',
            ],
        ];

        if($request->hasFile('resume')){

            $filePath = $request->file('resume')->store('upload/resume/','public');

            $jobMeta[] = [
                'meta_key' => 'jobsearch_field_user_cv_attachment',
                'meta_value' => url('/storage/'. $filePath),
            ];
        }

        $job->meta()->createMany($jobMeta);

        $application = JobMeta::where('post_id', $request->get('job_id'))->where('meta_key', 'app_joburl')->first();
        return redirect($application->meta_value);
    }

}
