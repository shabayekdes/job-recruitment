<?php

use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = "Tunisia";

        $url = "https://neuvoo.com/services/api-new/search?ip=1.1.1.1&useragent=123asd&country=tn&contenttype=organic&format=json&publisher=d42894fa&start=30";

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
                "meta_key" => "_job_expires",
                "meta_value" => "",
            ],
            [ 
                "meta_key" => "_edit_last",
                "meta_value" => "1",
            ],
            [
                "meta_key" => "rs_page_bg_color",
                "meta_value" => "",
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
                "meta_key" => "originalaction",
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
                "meta_key" => "_job_expires-datepicker",
                "meta_value" => "",
            ],
            [
                "meta_key" => "post_author",
                "meta_value" => "1",
            ],
            [
                "meta_key" => "post_mime_type",
                "meta_value" => "",
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
            ],
            [
                "meta_key" => "_company_website",
                "meta_value" => "",
            ],
            [
                "meta_key" => "_company_tagline",
                "meta_value" => "",
            ],
            [
                "meta_key" => "_company_twitter",
                "meta_value" => "",
            ],
            [
                "meta_key" => "_company_video",
                "meta_value" => "",
            ],
            [
                "meta_key" => "slide_template",
                "meta_value" => "",
            ],



        ];

        $results = $response->json()['results'];

        Log::info('Jobs: ' . $response->json()['totalresults'] . ' actually job count ' . count($results));

        foreach ($results as $job) {

            $jobExists = JobMeta::where('meta_value', $job['jobkey'])->exists();

            Log::info('Jobs Key: ' . $job['jobkey']);


            if(!$jobExists){
                $slug = Str::slug($job["jobtitle"], '-');

                $jobCreated = Job::create([
                    "post_author" => 1,
                    "post_date" => now(),
                    "post_date_gmt" => now(),
                    "post_content" => $job["description"],
                    "post_title" => $job["jobtitle"],
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

                Log::info('Jobs ID: ' . $jobCreated->id . 'Jobs Key: ' . $job['jobkey']);

                $metaData = $meta;
    
                $metaData[] = [
                    "meta_key" => "_job_location",
                    "meta_value" => $city,
                ];
    
    
                $metaData[] = [
                    "meta_key" => "_wp_old_slug",
                    "meta_value" =>  $slug,
                ];
    
                $metaData[] = [
                    "meta_key" => "ID",
                    "meta_value" => $jobCreated->id,
                ];
    
                $metaData[] = [
                    "meta_key" => "post_ID",
                    "meta_value" => $jobCreated->id,
                ];
    
                $metaData[] = [
                    "meta_key" => "_wp_http_referer",
                    "meta_value" => "/wp-admin/post.php?post={$jobCreated->id}&action=edit",
                ];

                $arr=explode("&", $job['url']);
                $puid = Str::replaceFirst('puid=', '', $arr[9]);

                $url = "https://eg.neuvoo.com/view/?id={$job['jobkey']}&source=api&publisher=d42894fa&utm_source=api&utm_medium=d42894fa&subid=default&chnl1=default&chnl2=default&chnl3=default&puid={$puid}&testid=champion&eligible=yes&context=api&initiator=&send_group=challenger";
        
                $metaData[] = [
                    "meta_key" => "_application",
                    "meta_value" => $url,
                ];
    
                $metaData[] = [
                    "meta_key" => "_company_name",
                    "meta_value" => $job['company'],
                ];
    
                $metaData[] = [
                    "meta_key" => "_wpnonce",
                    "meta_value" => "78e67f11a6",
                ];
    
                $metaData[] = [
                    "meta_key" => "unique_jobkey",
                    "meta_value" => $job['jobkey'],
                ];
    
                
    
                $job = Job::find($jobCreated->id);
    
                $job->meta()->createMany($metaData);
            }

            // sleep(3);
        }
    }
}
