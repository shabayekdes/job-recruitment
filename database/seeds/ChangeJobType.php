<?php

use App\Models\Job;
use App\Mail\TermCreated;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ChangeJobType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = Job::with(['meta' => function ($query) {
            $query->where('meta_key', 'job_type');
        }])
        ->whereHas('meta' , function ($query) {
            $query->where('meta_key', 'job_type');
        })
        ->where('post_type', 'job_listing')
        ->get();
        foreach ($jobs as $key => $job) {

            $termId = $this->getType($job->meta->first()->meta_value);

            if($termId){
                $job->term()->attach([
                    $termId => ['term_order' => 0],
                    1114 => ['term_order' => 0]
                ]);
                DB::table(env('PREFIX_TABLE') . 'term_taxonomy')->whereIn('term_taxonomy_id', [$termId, 1114])->increment('count');
            }else{
                Log::error('The term name: '. $job->meta->first()->meta_value . ' The post ID: ' . $job->ID);
            }

        }

    }

    private function getType($search)
    {
        $type = collect([
            //Freelance
            ["key" => "freelance", "term_id" => 23],
            ["key" => "Freelance / Project", "term_id" => 23],
            ["key" => "Freelance / Project Work From Home", "term_id" => 23],
            ["key" => "Part Time Freelance / Project Shift Based", "term_id" => 23],
            ["key" => "Freelancer", "term_id" => 23],
            ["key" => "Freelance / Project Shift Based", "term_id" => 23],
            //Part time
            ["key" => "part-time", "term_id" => 35],
            ["key" => "Part Time Employee", "term_id" => 35],
            ["key" => "Parttime", "term_id" => 35],
            ["key" => "Regular Part-Time", "term_id" => 35],
            //Temporary
            ["key" => "temporary", "term_id" => 42],
            ["key" => "Fixed term", "term_id" => 42],
            ["key" => "Fixed-term contract", "term_id" => 42],
            ["key" => "Intérim", "term_id" => 42],
            ["key" => "Temporary/Contract/Project", "term_id" => 42],
            ["key" => "Project contract", "term_id" => 42],
            ["key" => "CDI - CDD - Intérim", "term_id" => 42],
            ["key" => "Temp", "term_id" => 42],
            ["key" => "CDI - Intérim", "term_id" => 42],
            ["key" => "Temporary Employee Hire", "term_id" => 42],
            //Full Time
            ["key" => "full-time", "term_id" => 38],
            ["key" => "Full Time", "term_id" => 38],
            ["key" => "Regular/Permanent - Full-Time", "term_id" => 38],
            ["key" => "In the field / Off-site", "term_id" => 38],
            ["key" => "Full Time Employee", "term_id" => 38],
            ["key" => "Full Time, Fixed Term", "term_id" => 38],
            ["key" => "Contrat permanent", "term_id" => 38],
            ["key" => "Permanent", "term_id" => 38],
            ["key" => "Permanent contract", "term_id" => 38],
            ["key" => "Full Time Work From Home", "term_id" => 38],
            ["key" => "Full Time Part Time Shift Based", "term_id" => 38],
            ["key" => "Regular, Full Time", "term_id" => 38],
            ["key" => "Regular", "term_id" => 38],
            ["key" => "Full Time Shift Based", "term_id" => 38],
            ["key" => "Fulltime", "term_id" => 38],
            ["key" => "Full Time, Permanent", "term_id" => 38],
            ["key" => "Full - Time", "term_id" => 38],
            ["key" => "Full Time, Regular", "term_id" => 38],
            ["key" => "Full time On-site", "term_id" => 38],
            ["key" => "full", "term_id" => 38],
            ["key" => "Permanent / Full Time", "term_id" => 38],
            ["key" => "FULL_TIME", "term_id" => 38],
            ["key" => "Long term opportunities", "term_id" => 38],
            ["key" => "Full-time Regular", "term_id" => 38],
            ["key" => "Full Time Shift Based Work From Home", "term_id" => 38],
            ["key" => "Full-time", "term_id" => 38],
            ["key" => "Full Time Job", "term_id" => 38],
            ["key" => "Regular Employee Hire", "term_id" => 38],
            ["key" => "Full time role", "term_id" => 38],
            ["key" => "Regular Full-Time", "term_id" => 38],
            ["key" => "Permanent, Full Time", "term_id" => 38],
            ["key" => "Type: Permanent", "term_id" => 38],
            ["key" => "Full-time, Contract", "term_id" => 38],
            ["key" => "permanentfull time", "term_id" => 38],
            ["key" => "Employee", "term_id" => 38],
            ["key" => "Full-Time/Regular", "term_id" => 38],
            ["key" => "Permanent Job", "term_id" => 38],
            ["key" => "Staff / Permanent", "term_id" => 38],
            ["key" => "Permanent Full-time", "term_id" => 38],
            //Work From Home
            ["key" => "work-from-home", "term_id" => 471],
            ["key" => "Work From Home", "term_id" => 471],
            ["key" => "Shift Based Work From Home", "term_id" => 471],
            ["key" => "Work from Home online Jobs", "term_id" => 471],
            //Internship
            ["key" => "Internship", "term_id" => 1175],
            ["key" => "Part-Time Intern", "term_id" => 1175],
            ["key" => "Full-Time Intern", "term_id" => 1175],
            ["key" => "Student/Intern Hire", "term_id" => 1175],
            ["key" => "1 month in Summer/Winter", "term_id" => 1175],
        ]);

        $typeFiltered = collect($type)->filter(function ($item) use ($search) {
            // return false !== stripos($item["key"], $search);
            return strtolower($item["key"]) == strtolower($search);
        })->values();

        if($typeFiltered->isNotEmpty()){
            return $typeFiltered->first()['term_id'];
        }

        // Mail::to('esmail.shabayek@gmail.com')->send(new TermCreated($search, $jobCreated));
        return null;
    }
}
