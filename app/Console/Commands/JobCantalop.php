<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\Term;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobCantalop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:cantalop';

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
        Log::info('Website: Cantalop date: ' . now()->format('l jS \of F Y h:i:s A'));

        $url = "https://www.cantalop.com/jobs/all_rss";

        $response = Http::get($url);

        $xml_string = (string) $response->body();

        // $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);
        $xml = simplexml_load_string($xml_string);

        $json = json_encode($xml);

        $results = json_decode($json,TRUE);

        // Log::info('Jobs: ' . $response->json()['totalresults'] . ' actually job count ' . count($results));

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

                Log::info('Website: Cantalop - Country: Egypt - Jobs ID: ' . $jobCreated->ID . ' - Jobs Key: ' . $job_id . ' - date: ' . now()->format('l jS \of F Y h:i:s A'));

                $metaData = [
                    [
                        "meta_key" => "job_provider",
                        "meta_value" => "Cantalop",
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

                $jobCreated->meta()->createMany($metaData);

                \DB::commit();
                // $queries = \DB::getQueryLog();

                // dd($queries);
            }

            // sleep(3);
        }
    }
}
