<?php

use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SlugifyCandidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidates = Job::where('post_type', 'candidate')->get();

        foreach ($candidates as $candidate){
            $slug = Str::slug($candidate->post_title, '-');
            $candidate->update(['post_name' => $slug]);
        }

    }
}
