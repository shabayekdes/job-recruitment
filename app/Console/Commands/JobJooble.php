<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobJooble extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:jooble {country}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = "https://eg.jooble.org/api/";
        $key = "048acc6b-2b1c-4c10-afc4-974121097328";

        $country = $this->argument('country');

        //create request object
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url."".$key);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "keywords": "it", "location": "' . $country. '"}');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close ($ch);

        $result = json_decode($server_output, TRUE);

        if($result == null){

            return null;
        }

        foreach ($result['jobs'] as $key => $job) {

            $job_id = $job['id'];

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

            if(!$jobExists){

                $title = Str::limit($job["title"], 190);

                $slug = Str::slug($title, '-');

                \DB::beginTransaction();
                $jobCreated = Job::create([
                    "post_author" => 1,
                    "post_date" => Carbon::parse($job['updated']),
                    "post_date_gmt" => now(),
                    "post_content" => $job["snippet"],
                    "post_title" => $title,
                    "post_excerpt" => "",
                    "post_status" => "publish",
                    "comment_status" => "closed",
                    "ping_status" => "closed",
                    "post_password" => "",
                    "post_name" => $slug,
                    "to_ping" => "",
                    "pinged" => "",
                    "post_modified" => now(),
                    "post_modified_gmt" => now(),
                    "post_content_filtered" => "",
                    "post_parent" => 0,
                    "guid" => "https://recruitment.talentsmine.net/job/{$slug}",
                    "menu_order" => 0,
                    "post_type" => "job_listing",
                    "post_mime_type" => "",
                    "comment_count" => 0,
                ]);

                Log::info('Jobs ID: ' . $jobCreated->ID . ' Jobs Key: ' . $job_id);

                $metaData = [
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "Jooble",
                    ],
                    [
                        "meta_key" => "jobsearch_field_location_location1",
                        "meta_value" => $job["location"],
                    ],
                    [
                        "meta_key" => "_wp_old_slug",
                        "meta_value" =>  $slug,
                    ],
                    [
                        "meta_key" => "_wp_http_referer",
                        "meta_value" => "/wp-admin/post.php?post={$jobCreated->ID}&action=edit",
                    ],
                    [
                        "meta_key" => "_application",
                        "meta_value" => "/login/" . $jobCreated->ID
                    ],
                    [
                        "meta_key" => "app_joburl",
                        "meta_value" => $job['link'],
                    ],
                    [
                        "meta_key" => "unique_jobkey",
                        "meta_value" => $job_id,
                    ]
                ];

                if($job['company'] != ""){
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_company_name",
                        "meta_value" => $job['company'],
                    ];
                }

                if(is_string($job['salary'])){
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_job_salary_type",
                        "meta_value" => $job['salary'],
                    ];
                }


                $jobCreated->meta()->createMany($metaData);

                \DB::commit();
                // $queries = \DB::getQueryLog();

                // dd($queries);
            }
        }

    }
}
