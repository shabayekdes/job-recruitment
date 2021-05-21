<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InsertJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobs;
    public $data;
    public $jobID;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($jobs, $data, $jobID = null)
    {
        $this->jobs = $jobs;
        $this->data = $data;
        $this->jobID = $jobID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->jobs as $job) {

            if($this->jobID == null){
                $encryption = openssl_encrypt($job['title'], "AES-128-CTR", "CareerJet", 0, "1234567891011121");
                // $decryption = openssl_decrypt($encryption, "AES-128-CTR", "GulfTalent", 0, "1234567891011121");
                $job_id = date("Y-m-d", strtotime($job['date'])) . '-' . $encryption;
            }else{
                $job_id = $job[$this->jobID];
            }

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

            if($jobExists){
                continue;
            }

            $slug = Str::slug($job[$this->data["title"]], '-');
            \DB::beginTransaction();
            $jobCreated = Job::create([
                "post_author" => 1,
                "post_date" => Carbon::parse($job[$this->data['date']]),
                "post_date_gmt" => now(),
                "post_content" => $job[$this->data["description"]],
                "post_title" => $job[$this->data["title"]],
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
                "guid" => "https://search-engine.talentsmine.net/job/{$slug}",
                "menu_order" => 0,
                "post_type" => "job_listing",
                "post_mime_type" => "",
                "comment_count" => 0,
            ]);

            Log::info('Jobs ID: ' . $jobCreated->ID . ' Jobs Key: ' . $job_id);

            $metaData = [
                [
                    "meta_key" => "jobsearch_field_location_location1",
                    "meta_value" => $this->data['country'],
                ],
                [
                    "meta_key" => "job_provider",
                    "meta_value" => $this->data['provider'],
                ],
                [
                    "meta_key" => "_application",
                    "meta_value" => "/login/" . $jobCreated->ID
                ],
                [
                    "meta_key" => "app_joburl",
                    "meta_value" => $job[$this->data['url']],
                ],
                [
                    "meta_key" => "unique_jobkey",
                    "meta_value" => $job_id,
                ]
            ];

            if(isset($this->data['company'])){
                $metaData[] = [
                    "meta_key" => "jobsearch_field_company_name",
                    "meta_value" => $job[$this->data['company']],
                ];
            }

            if(isset($this->data['salary'])){
                $metaData[] = [
                    "meta_key" => "jobsearch_field_job_salary_type",
                    "meta_value" => $job[$this->data['salary']],
                ];
            }

            if(isset($this->data['locations'])){
                $metaData[] = [
                    "meta_key" => "jobsearch_field_location_address",
                    "meta_value" => $job[$this->data['locations']],
                ];
            }

            $jobCreated->meta()->createMany($metaData);

            \DB::commit();
        }

    }
}
