<?php

use App\Models\Job;
use App\Models\JobMeta;
use Illuminate\Database\Seeder;

class JobMetaSeeder extends Seeder
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

            $metaUrl = [
                "meta_key" => "app_joburl",
                "meta_value" => $data['meta_value'],
            ];

            JobMeta::where('meta_id', $data['meta_id'])->update([
                "meta_value" => url('job/login/'. $job->ID)
            ]);


            $job->meta()->create($metaUrl);

        }
    }
}
