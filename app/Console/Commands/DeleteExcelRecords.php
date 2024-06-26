<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteExcelRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:delete-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete records from the excel table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Your task logic here
        $date = Carbon::now()->subDays(7);
        DB::table('excel')->where('created_at', '<', $date)->delete();
        $this->info('Records deleted from excel table');
        return 0;
    }
}

