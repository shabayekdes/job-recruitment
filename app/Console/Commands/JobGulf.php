<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\Term;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobGulf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:gulf {type}';

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
        $type = $this->argument('type');

        $data = $this->getUrl($type);

        if($data == null){
            return 0;
        }

        $url = "https://www.gulftalent.com/home/canPositions-ViewList-RSS-s.php?from_search=true&" . $data;

        // Log::info('Website: Gulf Talent Country: ' . $data[1] . ' date: ' . now()->format('l jS \of F Y h:i:s A'));

        $response = Http::get($url);

        $xml_string = (string) $response->body();

        // $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);
        $xml = simplexml_load_string($xml_string);

        $json = json_encode($xml);

        $results = json_decode($json,TRUE);

        foreach ($results['channel']['item'] as $job) {

            $encryption = openssl_encrypt($job['title'], "AES-128-CTR", "GulfTalent", 0, "1234567891011121");
            // $decryption = openssl_decrypt($encryption, "AES-128-CTR", "GulfTalent", 0, "1234567891011121");
            $job_id = date("Y-m-d", strtotime($job['pubDate'])) . '-' . $encryption;

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

            if(!$jobExists){

                $slug = Str::slug($job["title"], '-');
                \DB::beginTransaction();
                $jobCreated = Job::create([
                    "post_author" => 1,
                    "post_date" => Carbon::parse($job['pubDate']),
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

                Log::info('Website: Gulf Talent - Country: ' . $data[1] . ' - Jobs ID: ' . $jobCreated->ID . ' - Jobs Key: ' . $job_id . ' - date: ' . now()->format('l jS \of F Y h:i:s A'));

                $metaData = [
                    [
                        "meta_key" => "jobsearch_field_location_location1",
                        "meta_value" => $data[1],
                    ],
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "Gulf Talent",
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

                if($job['category'] != ''){
                    // $metaData[] = [
                    //     "meta_key" => "jobsearch_field_location_address",
                    //     "meta_value" => $job['category'],
                    // ];

                    $term = Term::firstOrCreate([
                        'name' => $job['category'],
                        'slug' => Str::slug($job['category'], '-'),
                    ]);
                    $term->jobs()->attach([$jobCreated->ID => ['term_order' => 0]]);

                }

                $jobCreated->meta()->createMany($metaData);

                \DB::commit();
                // $queries = \DB::getQueryLog();

                // dd($queries);
            }

            // sleep(3);
        }
    }

    private function getUrl($type)
    {
        $index = (int) floor(now()->format('H') / 2);
        // $index = (int) floor(Carbon::parse('16:00')->format('H') / 2);

        $country = [
            ['10111111000000', 'UAE'],
            ['10111112000000', 'Saudi Arabia'],
            ['10111113000000', 'Kuwait'],
            ['10111114000000', 'Qatar'],
            ['10111115000000', 'Bahrain'],
            ['10111116000000', 'Oman'],
            ['10229411000000', 'Lebanon'],
            ['10229362000000', 'Egypt'],
            ['10229117000000', 'Jordan'],
            ['10229120000000', 'Iraq'],
        ];

        if(count($country) > $index && $type == 'frmPositionCountry'){
            return "frmPositionCountry=" . $country[$index][0];
        }

        if($index <= 8 && $type == 'jobcat_group'){
            return "jobcat_group=" . $index;
        }

        if($index <= 8 && $type == 'industry_group'){
            return "industry_group=" . $index;
        }

        return null;
    }
}
