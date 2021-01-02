<?php

namespace App\Http\Controllers;

use App\Models\Job;
use GuzzleHttp\Client;
use App\Models\JobMeta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {


        $city = "Egypt";

        $url = "https://neuvoo.com/services/api-new/search?ip=1.1.1.1&useragent=123asd&country=eg&contenttype=sponsored&format=json&publisher=d42894fa";

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


        foreach ($results as $job) {

            dump($job['jobkey']);

            // $jobExists = JobMeta::where('meta_value', $job['jobkey'])->exists();

            // if(!$jobExists){
            //     $slug = Str::slug($job["jobtitle"], '-');

            //     $jobCreated = Job::create([
            //         "post_author" => 1,
            //         "post_date" => "2020-12-05 11:56:53",
            //         "post_date_gmt" => "2020-12-05 11:56:53",
            //         "post_content" => $job["description"],
            //         "post_title" => $job["jobtitle"],
            //         "post_excerpt" => "",
            //         "post_status" => "publish",
            //         "comment_status" => "closed",
            //         "ping_status" => "closed",
            //         "post_password" => "",
            //         "post_name" => $slug,
            //         "to_ping" => "",
            //         "pinged" => "",
            //         "post_modified" => "2020-12-05 12:05:35",
            //         "post_modified_gmt" => "2020-12-05 12:05:35",
            //         "post_content_filtered" => "",
            //         "post_parent" => 0,
            //         "guid" => "https://recruitment.talentsmine.net/job/{$slug}",
            //         "menu_order" => 0,
            //         "post_type" => "job_listing",
            //         "post_mime_type" => "",
            //         "comment_count" => 0,
            //     ]);
    
    
            //     $metaData = $meta;
    
            //     $metaData[] = [
            //         "meta_key" => "_job_location",
            //         "meta_value" => $city,
            //     ];
    
    
            //     $metaData[] = [
            //         "meta_key" => "_wp_old_slug",
            //         "meta_value" =>  $slug,
            //     ];
    
            //     $metaData[] = [
            //         "meta_key" => "ID",
            //         "meta_value" => $jobCreated->id,
            //     ];
    
            //     $metaData[] = [
            //         "meta_key" => "post_ID",
            //         "meta_value" => $jobCreated->id,
            //     ];
    
            //     $metaData[] = [
            //         "meta_key" => "_wp_http_referer",
            //         "meta_value" => "/wp-admin/post.php?post={$jobCreated->id}&action=edit",
            //     ];

            //     $arr=explode("&", $job['url']);
            //     $puid = Str::replaceFirst('puid=', '', $arr[9]);

            //     $url = "https://eg.neuvoo.com/view/?id={$job['jobkey']}&source=api&publisher=d42894fa&utm_source=api&utm_medium=d42894fa&subid=default&chnl1=default&chnl2=default&chnl3=default&puid={$puid}&testid=champion&eligible=yes&context=api&initiator=&send_group=challenger";
        
            //     $metaData[] = [
            //         "meta_key" => "_application",
            //         "meta_value" => $url,
            //     ];
    
            //     $metaData[] = [
            //         "meta_key" => "_company_name",
            //         "meta_value" => $job['company'],
            //     ];
    
            //     $metaData[] = [
            //         "meta_key" => "_wpnonce",
            //         "meta_value" => "78e67f11a6",
            //     ];
    
            //     $metaData[] = [
            //         "meta_key" => "unique_jobkey",
            //         "meta_value" => $job['jobkey'],
            //     ];
    
                
    
            //     $job = Job::find($jobCreated->id);
    
            //     $job->meta()->createMany($metaData);
            // }
        }

        dd($meta);


        $random = Str::random(10);

        $i = ceil( time() / ( 86400 / 2 ) );

        dd(substr( hash_hmac( 'md5', $i . '|-1|1|nonce', 'auth' ), -12, 10 ));


        foreach ($results as $key => $job) {
            dd($results);

        }





//         $jobs = unserialize('a:20:{s:9:"post_type";s:11:"job_listing";s:11:"post_author";s:1:"1";s:9:"tax_input";a:1:{s:16:"job_listing_type";s:9:"freelance";}s:15:"smart_tax_input";s:0:"";s:4:"meta";a:14:{s:12:"_application";s:0:"";s:12:"_job_expires";s:0:"";s:13:"_job_location";s:0:"";s:13:"_company_name";s:0:"";s:13:"_company_logo";s:0:"";s:16:"_company_website";s:0:"";s:29:"geolocation_formatted_address";s:0:"";s:16:"geolocation_city";s:0:"";s:15:"geolocation_lat";s:0:"";s:16:"geolocation_long";s:0:"";s:24:"geolocation_country_long";s:0:"";s:25:"geolocation_country_short";s:0:"";s:23:"geolocation_state_short";s:0:"";s:22:"geolocation_state_long";s:0:"";}s:9:"from_date";s:0:"";s:7:"to_date";s:0:"";s:5:"limit";s:2:"25";s:8:"keywords";s:0:"";s:19:"keywords_comparison";s:2:"OR";s:16:"keywords_exclude";s:0:"";s:27:"keywords_exclude_comparison";s:2:"OR";s:13:"import_images";b:1;s:7:"special";s:0:"";s:14:"field_mappings";a:24:{s:11:"description";s:12:"post_content";s:6:"author";s:11:"post_author";s:7:"creator";s:11:"post_author";s:4:"city";s:16:"geolocation_city";s:8:"location";s:13:"_job_location";s:7:"country";s:25:"geolocation_country_short";s:5:"state";s:23:"geolocation_state_short";s:8:"latitude";s:15:"geolocation_lat";s:3:"lat";s:15:"geolocation_lat";s:9:"longitude";s:16:"geolocation_long";s:4:"long";s:16:"geolocation_long";s:3:"lng";s:16:"geolocation_long";s:7:"company";s:13:"_company_name";s:12:"company_name";s:13:"_company_name";s:7:"website";s:16:"_company_website";s:4:"site";s:16:"_company_website";s:11:"company_url";s:16:"_company_website";s:12:"company_site";s:12:"company_site";s:8:"job_type";s:16:"job_listing_type";s:4:"type";s:16:"job_listing_type";s:12:"job_category";s:20:"job_listing_category";s:8:"category";s:20:"job_listing_category";s:4:"logo";s:13:"_company_logo";s:9:"logo_html";s:9:"logo_html";}s:6:"source";a:5:{s:4:"name";s:46:"Jobs in Canada 【 Now Hiring 】 Job Listings";s:7:"website";s:9:"neuvoo.ca";s:4:"logo";s:0:"";s:4:"args";a:0:{}s:8:"feed_url";s:55:"https://rss.app/feeds/YJwwnhysZ35DQpov.xml%20%20%20Copy";}s:15:"rss_feed_import";s:55:"https://rss.app/feeds/YJwwnhysZ35DQpov.xml%20%20%20Copy";s:5:"logos";s:0:"";s:9:"operation";s:6:"insert";s:4:"post";a:1:{s:12:"post_content";s:0:"";}}');
// dd($jobs);

    $data = [
        "post_author" => 1,
        "post_date" => "2020-12-05 11:56:53",
        "post_date_gmt" => "2020-12-05 11:56:53",
        "post_content" => "",
        "post_title" => "Job two",
        "post_excerpt" => "",
        "post_status" => "publish",
        "comment_status" => "closed",
        "ping_status" => "closed",
        "post_password" => "",
        "post_name" => "job2",
        "to_ping" => "",
        "pinged" => "",
        "post_modified" => "2020-12-05 12:05:35",
        "post_modified_gmt" => "2020-12-05 12:05:35",
        "post_content_filtered" => "",
        "post_parent" => 0,
        "guid" => "http://talentsmine.net/test/?post_type=job_listing&#038;p=5146",
        "menu_order" => 0,
        "post_type" => "job_listing",
        "post_mime_type" => "",
        "comment_count" => 0,
    ];


    // $job = Job::create($data);
    $job = Job::find(5160);

    // $job->meta()->createMany($test);

    // dd($job->meta);


        $jobs = Job::where('post_type', 'job_listing')->where('ID', 5160)->first();
        // dd($jobs->toArray());

        dd($jobs->meta->toArray() );
    }
}
