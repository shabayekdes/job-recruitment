<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobNeuvoo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:neuvoo {country}';

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
        $hour = (int) now()->format('H') * 12;
        $minut = (int) now()->format('i') / 5;
        $page = intval($hour + $minut);
        $countryCode = $this->argument('country');

        $country = [
            'eg' => 'Egypt'
        ];

        $url = "https://neuvoo.com/services/feeds/generatesV3/generate.php?partner=talentsmine_bulk&country=$countryCode&of=256&page=$page";

        Log::info('Website: Neuvoo Country: ' . $country[$countryCode] .' page: ' . $page . ' date: ' . now()->format('l jS \of F Y h:i:s A'));

        $response = Http::get($url);

        $meta = [
            [
                "meta_key" => "_filled",
                "meta_value" => "0",
            ],
            [
                "meta_key" => "_featured",
                "meta_value" => "0",
            ],
            [ 
                "meta_key" => "_edit_lock",
                "meta_value" => "1608244810:1",
            ],
            [  
                "meta_key" => "_tracked_submitted",
                "meta_value" => "1607169413",
            ],
            [
                "meta_key" => "user_ID",
                "meta_value" => "1",
            ],
            [
                "meta_key" => "action",
                "meta_value" => "editpost",
            ],
            [
                "meta_key" => "post_type",
                "meta_value" => "job_listing",
            ],
            [
                "meta_key" => "original_post_status",
                "meta_value" => "publish",
            ],
            [
                "meta_key" => "auto_draft",
                "meta_value" => "1",
            ],
 
            [
                "meta_key" => "meta-box-order-nonce",
                "meta_value" => "facb9b8f5f",
            ],
            [
                "meta_key" => "closedpostboxesnonce",
                "meta_value" => "06cd9359b9",
            ],
            [
                "meta_key" => "samplepermalinknonce",
                "meta_value" => "c13bcc9b4c",
            ],
            [
                "meta_key" => "job_manager_nonce",
                "meta_value" => "1e98fa4d7a",
            ],
            [
                "meta_key" => "_job_author",
                "meta_value" => "1",
            ],
            [
                "meta_key" => "post_author",
                "meta_value" => "1",
            ],
            [
                "meta_key" => "post_status",
                "meta_value" => "publish",
            ],
            [
                "meta_key" => "comment_status",
                "meta_value" => "closed",
            ],
            [
                "meta_key" => "ping_status",
                "meta_value" => "closed",
            ],
            [
                "meta_key" => "careerfy_post_views_count",
                "meta_value" => "0",
            ],
            [
                "meta_key" => "tax_input",
                "meta_value" => 'a:1:{s:16:"job_listing_type";s:4:"0";}',
            ]
        ];

        $xml_string = (string) $response->body();

        $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);

        $json = json_encode($xml);

        $jobs = json_decode($json,TRUE);

        foreach ($jobs['job'] as $job) {

            $job_id = $job['jobid'];

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

            if(!$jobExists){

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

                Log::info('Jobs ID: ' . $jobCreated->ID . ' Jobs Key: ' . $job_id);

                $metaData = $meta;
    
                $metaData[] = [
                    "meta_key" => "_job_location",
                    "meta_value" => $country[$countryCode],
                ];
    
                $metaData[] = [
                    "meta_key" => "_wp_old_slug",
                    "meta_value" =>  $slug,
                ];
    
                $metaData[] = [
                    "meta_key" => "_wp_http_referer",
                    "meta_value" => "/wp-admin/post.php?post={$jobCreated->ID}&action=edit",
                ];

                $metaData[] = [
                    "meta_key" => "_application",
                    "meta_value" => "/login/" . $jobCreated->ID
                ];

                $metaData[] = [
                    "meta_key" => "app_joburl",
                    "meta_value" => $job['url'],
                ];

                if($job['company'] != ""){
                    $metaData[] = [
                        "meta_key" => "_company_name",
                        "meta_value" => $job['company'],
                    ];
                }

                if($job['logo'] != ""){
                    $metaData[] = [
                        "meta_key" => "_company_logo",
                        "meta_value" => $job['logo'],
                    ];
                }

                if(is_string($job['salary'])){
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_job_salary_type",
                        "meta_value" => $job['salary'],
                    ];
                }

                if(is_string($job['jobtype'])){
                    $metaData[] = [
                        "meta_key" => "job_type",
                        "meta_value" => $job['jobtype'],
                    ];
                }

                $metaData[] = [
                    "meta_key" => "_wpnonce",
                    "meta_value" => "78e67f11a6",
                ];
                
                $metaData[] = [
                    "meta_key" => "unique_jobkey",
                    "meta_value" => $job_id,
                ];

                $metaData[] = [
                    "meta_key" => "job_provider",
                    "meta_value" => "Neuvoo",
                ];
    
                // $metaData[] = [
                //     "meta_key" => "career-level",
                //     "meta_value" => $job['career_level'],
                // ];

                // $metaData[] = [
                //     "meta_key" => "jobsearch_field_job_salary_type",
                //     "meta_value" => Str::after($job['salary'], 'Salary: '),
                // ];
                
                // $metaData[] = [
                //     "meta_key" => "experience",
                //     "meta_value" => $job['experience'],
                // ];

                if(is_string($job['city'])){
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_location_address",
                        "meta_value" => $job['city'],
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
