<?php

use App\Models\JobMeta;
use Illuminate\Database\Seeder;

class MigrateJobSearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobMeta::where('meta_key', '_job_location')->update([
            "meta_key" => "jobsearch_field_location_location1"
        ]);

        JobMeta::where('meta_key', '_company_name')->update([
            "meta_key" => "jobsearch_field_company_name"
        ]);

    }
}
