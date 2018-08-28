<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PurgeAdoptableCatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cats:purge-adoptable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge the adoptable cats table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('adoptable_cats')->truncate();
    }
}
