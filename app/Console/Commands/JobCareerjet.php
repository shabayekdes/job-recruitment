<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Term;
use App\Jobs\CreateJob;
use App\Models\JobMeta;
use App\Jobs\InsertJobs;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobCareerjet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:careerjet {country} {--hour=} {--minute=}';

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
        // \DB::connection()->enableQueryLog();
        $hourRate = $this->option('hour') ?? 15;
        $minutRate = $this->option('minute') ?? 4;

        $hour = (int) now()->format('H') * $hourRate;
        $minut = (int) now()->format('i') / $minutRate;
        $page = intval($hour + $minut);
        $country = $this->argument('country');

        $url = "http://public.api.careerjet.net/search?affid=7bd38e0476bfc2ea5ba865d62515d396&user_ip=REMOTE_ADDR&user_agent=HTTP_USER_AGENT&location=$country&pagesize=99&page=$page";

        // Log::info('Website: CareerJet Country: ' . $country . ' page: ' . $page . ' date: ' . now()->format('l jS \of F Y h:i:s A'));

        $response = Http::get($url);

        $results = $response->json();
        $jobs = $results['jobs'];

        if ($results['pages'] < $page) {
            return 0;
        }

        // $data = [
        //     'provider' => 'CareerJet',
        //     'title' => 'title',
        //     'description' => 'description',
        //     'date' => 'date',
        //     'url' => 'url',
        //     'company' => 'company',
        //     'salary' => 'salary',
        //     'locations' => 'locations',
        //     'country' => ucfirst($country),
        // ];

        // InsertJobs::dispatch($jobs, $data);

        // foreach ($jobs as $job) {
        //     $encryption = openssl_encrypt($job['title'], "AES-128-CTR", "CareerJet", 0, "1234567891011121");
        //     // $decryption = openssl_decrypt($encryption, "AES-128-CTR", "GulfTalent", 0, "1234567891011121");
        //     $job_id = date("Y-m-d", strtotime($job['date'])) . '-' . $encryption;

        //     $jobExists = JobMeta::where('meta_value', $job_id)->exists();

        //     if($jobExists){
        //         continue;
        //     }

        //     Log::info('Jobs Key: ' . $job_id);
        //     $metaData = [
        //         [
        //             "meta_key" => "jobsearch_field_location_location1",
        //             "meta_value" => $data['country'],
        //         ],
        //         [
        //             "meta_key" => "job_provider",
        //             "meta_value" => $data['provider'],
        //         ],
        //         [
        //             "meta_key" => "app_joburl",
        //             "meta_value" => $job[$data['url']],
        //         ],
        //         [
        //             "meta_key" => "unique_jobkey",
        //             "meta_value" => $job_id,
        //         ]
        //     ];

        //     if(isset($data['company'])){
        //         $metaData[] = [
        //             "meta_key" => "jobsearch_field_company_name",
        //             "meta_value" => $job[$data['company']],
        //         ];
        //     }

        //     if(isset($data['salary'])){
        //         $metaData[] = [
        //             "meta_key" => "jobsearch_field_job_salary_type",
        //             "meta_value" => $job[$data['salary']],
        //         ];
        //     }

        //     if(isset($data['locations'])){
        //         $metaData[] = [
        //             "meta_key" => "jobsearch_field_location_address",
        //             "meta_value" => $job[$data['locations']],
        //         ];
        //     }

        //     CreateJob::dispatch($job, $metaData, $job[$data["title"]], $job[$data["description"]], $job[$data['date']]);

        // }
        foreach ($jobs as $job) {


            $encryption = openssl_encrypt($job['title'], "AES-128-CTR", "CareerJet", 0, "1234567891011121");
            // $decryption = openssl_decrypt($encryption, "AES-128-CTR", "GulfTalent", 0, "1234567891011121");
            $job_id = date("Y-m-d", strtotime($job['date'])) . '-' . $encryption;

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

            if (!$jobExists) {

                $slug = Str::slug($job["title"], '-');
                \DB::beginTransaction();
                $jobCreated = Job::create([
                    "post_author" => 1,
                    "post_date" => Carbon::parse($job['date']),
                    "post_date_gmt" => now(),
                    "post_content" => $job["description"],
                    "post_title" => $job["title"],
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

                Log::info('Website: CareerJet - Country: ' . $country . ' - Jobs ID: ' . $jobCreated->ID . ' - Jobs Key: ' . $job_id . ' - date: ' . now()->format('l jS \of F Y h:i:s A'));

                $metaData = [
                    [
                        "meta_key" => "jobsearch_field_location_location1",
                        "meta_value" => ucfirst($country),
                    ],
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "CareerJet",
                    ],
                    [
                        "meta_key" => "app_joburl",
                        "meta_value" => $job['url'],
                    ],
                    [
                        "meta_key" => "unique_jobkey",
                        "meta_value" => $job_id,
                    ],
                    [
                        "meta_key" => "_application",
                        "meta_value" => "/login/" . $jobCreated->ID
                    ]
                ];

                if ($job['company'] != "") {
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_company_name",
                        "meta_value" => $job['company'],
                    ];
                }

                if ($job['salary'] != "") {
                    $salary = $job['salary_currency_code'] . ' ' . $job['salary'];

                    $metaData[] = [
                        "meta_key" => "jobsearch_field_job_salary_type",
                        "meta_value" => $salary,
                    ];
                }

                if (isset($job['locations'])) {
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_location_address",
                        "meta_value" => $job['locations'],
                    ];
                }

                $jobCreated->meta()->createMany($metaData);

                \DB::commit();
                // $queries = \DB::getQueryLog();

                // dd($queries);
            }

            // sleep(3);
        }
    }
}
