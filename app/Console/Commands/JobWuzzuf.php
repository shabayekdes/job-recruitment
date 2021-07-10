<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\JobMeta;
use App\Models\Term;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobWuzzuf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:wuzzuf';

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

        // Log::info('Website: Wuzzuf date: ' . now()->format('l jS \of F Y h:i:s A'));

        $url = "https://wuzzuf.net/feeds/all-jobs.xml";

        $response = Http::get($url);

        $xml_string = (string) $response->body();

        $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);
        // $xml = simplexml_load_string($xml_string);

        $json = json_encode($xml);

        $results = json_decode($json,TRUE);

        // Log::info('Jobs: ' . $response->json()['totalresults'] . ' actually job count ' . count($results));

        foreach ($results['channel']['item'] as $job) {

            $jobExists = JobMeta::where('meta_value', $job['job_id'])->exists();

            if(!$jobExists){

                $slug = Str::slug($job["title"], '-');
                \DB::beginTransaction();
                $jobCreated = Job::create([
                    "post_author" => 1,
                    "post_date" => now(),
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

                Log::info('Website: Wuzzuf - Country: Egypt - Jobs ID: ' . $jobCreated->ID . ' - Jobs Key: ' . $job['job_id'] . ' - date: ' . now()->format('l jS \of F Y h:i:s A'));


                $metaData = [
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "Wuzzuf",
                    ],
                    [
                        "meta_key" => "jobsearch_field_location_location1",
                        "meta_value" => "Egypt",
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
                        "meta_key" => "jobsearch_field_company_name",
                        "meta_value" => $job['source'],
                    ],
                    [
                        "meta_key" => "_wpnonce",
                        "meta_value" => "78e67f11a6",
                    ],
                    [
                        "meta_key" => "unique_jobkey",
                        "meta_value" => $job['job_id'],
                    ],
                    [
                        "meta_key" => "career-level",
                        "meta_value" => $job['career_level'],
                    ],
                    [
                        "meta_key" => "jobsearch_field_job_salary_type",
                        "meta_value" => Str::after($job['salary'], 'Salary: '),
                    ],
                    [
                        "meta_key" => "experience",
                        "meta_value" => $job['experience'],
                    ]
                ];

                if(!is_array($job['area'])){
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_location_address",
                        "meta_value" => $job['area'],
                    ];
                }

                $roles = str_replace('/', ' ', $job['roles']);

                $term = Term::firstOrCreate([
                    'name' => $roles,
                    'slug' => Str::slug($roles, '-'),
                ]);
                $term->jobs()->attach([$jobCreated->ID => ['term_order' => 0]]);

                $jobCreated->meta()->createMany($metaData);

                \DB::commit();
                // $queries = \DB::getQueryLog();

                // dd($queries);
            }

            // sleep(3);
        }
    }
}
