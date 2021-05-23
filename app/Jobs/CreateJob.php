<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $job;
    public $meta;
    public $title;
    public $description;
    public $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($job, $meta, $title, $description, $date)
    {
        $this->job = $job;
        $this->meta = $meta;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();

        $slug = Str::slug($this->title, '-') . Str::random(10);

        $jobCreated = Job::create([
            "post_author" => 1,
            "post_date" => Carbon::parse($this->date),
            "post_date_gmt" => now(),
            "post_content" => $this->description,
            "post_title" => $this->title,
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
            "guid" => "https://search-engine.talentsmine.net/job/{$slug}",
            "menu_order" => 0,
            "post_type" => "job_listing",
            "post_mime_type" => "",
            "comment_count" => 0,
        ]);

        $this->meta[] = [
            "meta_key" => "_application",
            "meta_value" => "/login/" . $jobCreated->ID
        ];

        $jobCreated->meta()->createMany($this->meta);

        DB::commit();
    }
}
