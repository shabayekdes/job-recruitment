<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveOldJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:job';

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
        Job::where('post_type', 'job_listing')->where('post_date','<=',Carbon::now()->subdays(30))->delete();
    }
}
