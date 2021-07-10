<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Monster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:monster';

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
        Log::info('Website: Monster date: ' . now()->format('l jS \of F Y h:i:s A'));

        $ids = $this->getSector();

        $url = "https://www.monstergulf.com/jobsearch/rss_jobs.html?cat=" . $ids['cat_id'];

        $response = Http::get($url);

        $xml_string = (string) $response->body();

        // $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);
        $xml = simplexml_load_string($xml_string);

        $json = json_encode($xml);

        $results = json_decode($json,TRUE);

        // Log::info('Jobs: ' . $response->json()['totalresults'] . ' actually job count ' . count($results));

        foreach ($results['channel']['item'] as $job) {

            $encryption = openssl_encrypt($job['title'], "AES-128-CTR", "Monster", 0, "1234567891011121");
            // $decryption = openssl_decrypt($encryption, "AES-128-CTR", "GulfTalent", 0, "1234567891011121");
            $job_id = date("Y-m-d", time()) . '-' . $encryption;

            $jobExists = JobMeta::where('meta_value', $job_id)->exists();

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

                Log::info('Website: Monster - Country: Egypt - Jobs ID: ' . $jobCreated->ID . ' - Jobs Key: ' . $job_id . ' - date: ' . now()->format('l jS \of F Y h:i:s A'));

                $metaData = [
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "Monster",
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
                        "meta_key" => "_application",
                        "meta_value" => "/login/" . $jobCreated->ID
                    ],
                    [
                        "meta_key" => "app_joburl",
                        "meta_value" => $job['link'],
                    ],
                    [
                        "meta_key" => "unique_jobkey",
                        "meta_value" =>$job_id,
                    ]
                ];

                $jobCreated->term()->attach([
                    $ids['term_id'] => ['term_order' => 0],
                    1114 => ['term_order' => 0]
                ]);
                DB::table(env('PREFIX_TABLE', 'wpqs_') . 'term_taxonomy')->whereIn('term_taxonomy_id', [$ids['term_id'], 1114])->increment('count');

                $jobCreated->meta()->createMany($metaData);

                \DB::commit();
                // $queries = \DB::getQueryLog();

                // dd($queries);
            }

            // sleep(3);
        }
    }
    public function getSector()
    {
        $index = Cache::get('monstercat_id', 0);

        $ids = [
            ['cat_id' => 22, 'term_id' => 103], //IT/ Software Development
            ['cat_id' => 14, 'term_id' => 115], // Marketing/PR/Advertising
            ['cat_id' => 3, 'term_id' => 77],//Customer Service/Support
            ['cat_id' => 907, 'term_id' => 34],
            ['cat_id' => 18, 'term_id' => 110],
            ['cat_id' => 17, 'term_id' => 113],
            ['cat_id' => 23, 'term_id' => 145],
            ['cat_id' => 19, 'term_id' => 143],
            ['cat_id' => 16, 'term_id' => 132],
            ['cat_id' => 5, 'term_id' => 107],
            ['cat_id' => 6, 'term_id' => 1180],
            ['cat_id' => 15, 'term_id' => 1180],
            ['cat_id' => 1284, 'term_id' => 143],
            ['cat_id' => 1266, 'term_id' => 103],
            ['cat_id' => 1280, 'term_id' => 143],
            ['cat_id' => 1271, 'term_id' => 1180],
            ['cat_id' => 1253, 'term_id' => 87],
            ['cat_id' => 1267, 'term_id' => 103],
            ['cat_id' => 1281, 'term_id' => 143],
            ['cat_id' => 1272, 'term_id' => 115],
            ['cat_id' => 1254, 'term_id' => 113],
            ['cat_id' => 1268, 'term_id' => 103],
            ['cat_id' => 1250, 'term_id' => 113],
            ['cat_id' => 1273, 'term_id' => 85],
            ['cat_id' => 1255, 'term_id' => 88],
            ['cat_id' => 1246, 'term_id' => 107],
            ['cat_id' => 1260, 'term_id' => 103],
            ['cat_id' => 1283, 'term_id' => 143],
            ['cat_id' => 1265, 'term_id' => 103],
            ['cat_id' => 1279, 'term_id' => 113],
            ['cat_id' => 1270, 'term_id' => 107],
            ['cat_id' => 20, 'term_id' => 61],
            ['cat_id' => 7, 'term_id' => 36],
            ['cat_id' => 11, 'term_id' => 101],
            ['cat_id' => 13, 'term_id' => 108],
            ['cat_id' => 2, 'term_id' => 58],
            ['cat_id' => 786, 'term_id' => 74],
            ['cat_id' => 1000, 'term_id' => 82],
            ['cat_id' => 785, 'term_id' => 123],
            ['cat_id' => 9, 'term_id' => 99],
            ['cat_id' => 1071, 'term_id' => 142],
            ['cat_id' => 10, 'term_id' => 100],
            ['cat_id' => 24, 'term_id' => 151],
            ['cat_id' => 1252, 'term_id' => 85],
            ['cat_id' => 1275, 'term_id' => 56],
            ['cat_id' => 1257, 'term_id' => 103],
            ['cat_id' => 1248, 'term_id' => 56],
            ['cat_id' => 1262, 'term_id' => 103],
            ['cat_id' => 1276, 'term_id' => 99],
            ['cat_id' => 1258, 'term_id' => 103],
            ['cat_id' => 1249, 'term_id' => 115],
            ['cat_id' => 1263, 'term_id' => 103],
            ['cat_id' => 1277, 'term_id' => 103],
            ['cat_id' => 1259, 'term_id' => 103],
            ['cat_id' => 1282, 'term_id' => 143],
            ['cat_id' => 1264, 'term_id' => 103],
            ['cat_id' => 1278, 'term_id' => 115],
            ['cat_id' => 1269, 'term_id' => 103],
            ['cat_id' => 1251, 'term_id' => 85],
            ['cat_id' => 1274, 'term_id' => 125],
            ['cat_id' => 1256, 'term_id' => 144],
            ['cat_id' => 1247, 'term_id' => 74],
            ['cat_id' => 1261, 'term_id' => 103],
        ];

        if($index == 64){
            Cache::put('cat_id', 0);
        }else{
            ++$index;
            Cache::put('cat_id', $index);
        }


        return $ids[$index];
    }
}
