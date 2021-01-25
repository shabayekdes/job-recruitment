<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Term;
use GuzzleHttp\Client;
use App\Models\JobMeta;
use App\Models\Candidate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $jobs = Job::with(['meta' => function ($query){
            $query->where('meta_key', '_application');

        }])
        ->whereHas('meta' , function ($query){
            $query->where('meta_key', '_application');

        })
        ->where('post_type', 'job_listing')->get();

        foreach ($jobs as $job) {

            $data = $job->meta->first()->toArray();

            dd($data);

            // $metaUrl = [
            //     "meta_key" => "app_joburl",
            //     "meta_value" => "/login/" . $job->ID,
            // ];

            JobMeta::where('meta_id', $data['meta_id'])->update([
                "meta_value" => "/login/" . $job->ID
            ]);

        }
        // $candidate = Candidate::find(1);

        // auth()->login($candidate);

        dd(auth()->user());
        // dd(intval(15.25));
        // $hour = (int) Carbon::parse('01:05')->format('H') * 15;
        // $minut = (int) Carbon::parse('00:04')->format('i') / 4;
        // dd($hour+ $minut);
        // dd(Carbon::parse('23:10')->format('H:i'));
        //                                                12*0=0
        // 1   2   3   4   5   6   7   8   9   10  11  12 12*1=12
        // 13  14  15  16  17  18  19  20  21  22  23  24 12*2=24
        // 25  26  27  28  29  30  31  32  33  34  35  36 12*3=36
        // 37  38  39  40  41  42  43  44  45  46  47  48 12*4=48

        // dd(now()->subDays(7));

        // // dd(strtotime("Thu, 14 January 2021"));
        // dd(date("Y-m-d", strtotime("Thu, 14 January 2021")));
        // // Store a string into the variable which 
        // // need to be Encrypted 
        // $simple_string = "Welcome to GeeksforGeeks"; 

        // // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
        
        // // Use OpenSSl Encryption method 
        $options = 0; 
        
        // // Non-NULL Initialization Vector for encryption 
        // $encryption_iv = '1234567891011121'; 
        
        // // Store the encryption key 
        // $encryption_key = "GeeksforGeeks"; 
        
        // // Use openssl_encrypt() function to encrypt the data 
        // $encryption = openssl_encrypt($simple_string, $ciphering, 
        //             $encryption_key, $options, $encryption_iv); 
        
        // dump($encryption . '-' .time());

        // // Non-NULL Initialization Vector for decryption 
        $decryption_iv = '1234567891011121'; 
        
        // // Store the decryption key 
        $decryption_key = "GulfTalent"; 
        
        // // Use openssl_decrypt() function to decrypt the data 
        // $decryption=openssl_decrypt ("sEsXWgNkaOCclBn+OHrB03mj3p1yMazMsYqB8drmToMIgXAAuPHZXygXqQjBwCs===", $ciphering,  
        //         $decryption_key, $options, $decryption_iv); 
        

        // dd($decryption);

        // dump(Hash::check('Digital Marketing Lead – Retail | Quest Search &amp; Selection', '$2y$10$fqVMh81rcJnmYSMCVs2EUOzHGAjLS2Tqu9Tld7rmkIofHJFzqO.pW'));
        // dump(Hash::check('Digital Marketing Lead – Retail | Quest Search &amp; Selection', '$2y$10$vb0DFD8tzJj4Pk5z.QVMsOGBUiR7AZ8m0J9YXONvHXozzuTCnfBHO'));
        // dump(Hash::make('Digital Marketing Lead – Retail | Quest Search &amp; Selection'));
        // dd(Hash::make('Digital Marketing Lead – Retail | Quest Search &amp; Selection'));

        // $index = (int) floor(Carbon::parse('06:00')->format('H') / 2);

        // $country = [
        //     '10111111000000',
        //     '10111112000000'
        // ];

        // dd("https://www.gulftalent.com/home/canPositions-ViewList-RSS-s.php?from_search=true&frmPositionCountry=" . $country[$index]);
        // dd($country[$index]);
        // $results = Job::where('post_type', 'job_listing')->get()->groupBy('post_name');


        // foreach ($results as $key => $jobs) {

        //     if($jobs->count() > 1){
        //         foreach ($jobs as $key => $job) {

        //             $name = $job->post_name . ($key == 0 ? '' : '-' . $key);

        //             $job->update([
        //                 'post_name' => $name 
        //             ]);

        //         }
        //     }
        // }
        // dd('fgf');

        // dd(Str::slug('Engineering | Civil & Construction', '-'));
        $url = "https://neuvoo.com/services/feeds/generatesV3/generate.php?partner=talentsmine_bulk&country=eg&page=1&of=200";

        $response = Http::get($url);

        $xml_string = (string) $response->body();
        // $json = $response->json()['jobs'];

        // dd($json);
        // dd($xml_string);

        $xml = simplexml_load_string($xml_string, null, LIBXML_NOCDATA);
        // $xml = simplexml_load_string($xml_string);

        $json = json_encode($xml);

        $array = json_decode($json,TRUE);
        dd($array);



        $jobs = Job::with(['meta' => function ($query){
            $query->where('meta_key', '_application');

        }])->where('post_type', 'job_listing')->get();

        foreach ($jobs as $job) {

            $data = $job->meta->first()->toArray();

            $metaUrl = [
                "meta_key" => "_joburl",
                "meta_value" => $data['meta_value'],
            ];

            JobMeta::where('meta_id', $data['meta_id'])->update([
                "meta_value" => url('job/login/'. $job->ID)
            ]);


            $job->meta()->create($metaUrl);

        }
        $meta = JobMeta::where('post_id', 808)->get();

        dd($meta->toJson());

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

        $data = [
            [
                "meta_key" => "nickname",
                "meta_value" => $request->get('user_login'),
            ],
            [
                "meta_key" => "description",
                "meta_value" => "",
            ],
            [
                "meta_key" => "rich_editing",
                "meta_value" => "true",
            ],
            [
                "meta_key" => "syntax_highlighting",
                "meta_value" => "true",
            ],
            [
                "meta_key" => "comment_shortcuts",
                "meta_value" => "false",
            ],
            [
                "meta_key" => "admin_color",
                "meta_value" => "fresh",
            ],
            [
                "meta_key" => "use_ssl",
                "meta_value" => "0",
            ],
            [
                "meta_key" => "show_admin_bar_front",
                "meta_value" => "false",
            ],
            [
                "meta_key" => "locale",
                "meta_value" => "",
            ],
            [
                "meta_key" => "wpqs_capabilities",
                "meta_value" => 'a:1:{s:18:"jobsearch_employer";b:1;}',
            ],
            [
                "meta_key" => "wpqs_user_level",
                "meta_value" => "0",
            ],
            [
                "meta_key" => "last_update",
                "meta_value" => "1577022807",
            ],
            [
                "meta_key" => "jobsearch_employer_id",
                "meta_value" => "424",
            ],
            [
                "meta_key" => "jobsearch_field_user_phone",
                "meta_value" => $request->get('mobile'),
            ],
            [
                "meta_key" => "jobsearch_field_candidate_jobtitle",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_candidate_salary",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_facebook_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_twitter_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_google_plus_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_linkedin_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_user_dribbble_url",
                "meta_value" => "",
            ],
            [
                "meta_key" => "jobsearch_field_location_address",
                "meta_value" => "",
            ],
            [
                "meta_key" => "academic-level",
                "meta_value" => "",
            ],
            [
                "meta_key" => "Age",
                "meta_value" => "",
            ],
            [
                "meta_key" => "salary",
                "meta_value" => "",
            ],
            [
                "meta_key" => "gender",
                "meta_value" => "",
            ],
            [
                "meta_key" => "industry",
                "meta_value" => "",
            ],
            [
                "meta_key" => "founded-since",
                "meta_value" => "1850",
            ],
            [
                "meta_key" => "wpqs_show_admin_bar_front",
                "meta_value" => "",
            ],
            [
                "meta_key" => "dismissed_wp_pointers",
                "meta_value" => "",
            ],
            [
                "meta_key" => "wc_last_active",
                "meta_value" => "1576972800",
            ],
            [
                "meta_key" => "careerfy_user_facebook",
                "meta_value" => "",
            ],
            [
                "meta_key" => "careerfy_user_google",
                "meta_value" => "",
            ],
            [
                "meta_key" => "careerfy_user_linkedin",
                "meta_value" => "",
            ],
            [
                "meta_key" => "careerfy_user_twitter",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_first_name",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_last_name",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_company",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_address_1",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_address_2",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_city",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_postcode",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_country",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_state",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_phone",
                "meta_value" => "",
            ],
            [
                "meta_key" => "billing_email",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_first_name",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_last_name",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_company",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_address_1",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_address_2",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_city",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_postcode",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_country",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_state",
                "meta_value" => "",
            ],
            [
                "meta_key" => "shipping_method",
                "meta_value" => "",
            ],
            [
                "meta_key" => "paying_customer",
                "meta_value" => "",
            ]
        ];
    }
}
