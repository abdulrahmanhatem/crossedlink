<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PricingRequest;
use Carbon\Carbon;
class DeleteExpiredPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletePackage:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Deletes Packages On Expired DAte';

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
     * @return mixed
     */
    public function handle()
    {
        $package = PricingRequest::whereBetween('expired_date',  [Carbon::now()->subYears(2), Carbon::now()])->update(['state' => 2]);;
        /*PricingRequest::destroy($packages->toArray());*/
        echo 'Operation Done';

    }
}
