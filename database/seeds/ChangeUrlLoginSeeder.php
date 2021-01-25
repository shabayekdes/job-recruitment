<?php

use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Database\Seeder;

class ChangeUrlLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

            JobMeta::where('meta_id', $data['meta_id'])->update([
                "meta_value" => "/login/" . $job->ID
            ]);

        }
    }
}
