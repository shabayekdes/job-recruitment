<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\JobMeta;
use App\Mail\TermCreated;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class JobNeuvoo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:neuvoo {country} {--hour=} {--minute=}';

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
        $countryCode = $this->argument('country');

        $country = [
            'eg' => 'Egypt',
            'sa' => 'Saudi Arabia',
            'ae' => 'United Arab Emirates',
            'qa' => 'Qatar',
            'kw' => 'Kuwait',
            'om' => 'Oman',
            'lb' => 'Lebanon',
            'bh' => 'Bahrain',
            'dz' => 'Algeria',
            'tn' => 'Tunisia',
            'ma' => 'Morocco',
        ];

        $url = "https://neuvoo.com/services/feeds/generatesV3/generate.php?partner=talentsmine_bulk&country=$countryCode&of=256&page=$page";

        // Log::info('Website: Neuvoo Country: ' . $country[$countryCode] .' page: ' . $page . ' date: ' . now()->format('l jS \of F Y h:i:s A'));

        $response = Http::get($url);

        $xml_string = (string) $response->body();

        // $arr = json_decode($xml_string, true);

        if ($response->failed() || $response->serverError()) {

            return 0;
        }

        $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);

        $json = json_encode($xml);

        $jobs = json_decode($json,TRUE);

        foreach ($jobs['job'] as $job) {

            $job_id = $job['jobid'];

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

            if(!$jobExists){

                $title = Str::limit($job["title"], 190);

                $slug = Str::slug($title, '-');

                \DB::beginTransaction();
                $jobCreated = Job::create([
                    "post_author" => 1,
                    "post_date" => Carbon::parse($job['date']),
                    "post_date_gmt" => now(),
                    "post_content" => $job["description"],
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

                Log::info('Website: Neuvoo - Country: ' . $country[$countryCode] . ' - Jobs ID: ' . $jobCreated->ID . ' - Jobs Key: ' . $job_id . ' - date: ' . now()->format('l jS \of F Y h:i:s A'));

                $metaData = [
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "Neuvoo",
                    ],
                    [
                        "meta_key" => "jobsearch_field_location_location1",
                        "meta_value" => $country[$countryCode],
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
                        "meta_value" => $job['url'],
                    ]
                ];

                if($job['company'] != ""){
                    $metaData[] = [
                        "meta_key" => "jobsearch_field_company_name",
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
                    $termId = $this->getType($job['jobtype'], $jobCreated);

                    if ($termId) {
                        $jobCreated->term()->attach([
                            $termId => ['term_order' => 0],
                            1114 => ['term_order' => 0]
                        ]);
                        DB::table(env('PREFIX_TABLE', 'wpqs_') . 'term_taxonomy')->whereIn('term_taxonomy_id', [$termId, 1114])->increment('count');
                    } else {
                        $metaData[] = [
                            "meta_key" => "job_type",
                            "meta_value" => $job['jobtype'],
                        ];
                    }
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

    private function getType($search, $jobCreated)
    {
        $type = collect(config('jobtype'));

        $typeFiltered = collect($type)->filter(function ($item) use ($search) {
            return false !== stripos($item["key"], $search);
            // return $item["key"] == $search;
        })->values();

        if($typeFiltered->isNotEmpty()){
            return $typeFiltered->first()['term_id'];
        }

        Mail::to('talentsmine2021@gmail.com')->send(new TermCreated($search, $jobCreated));
        return null;
    }
}
