<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB; // Import the DB facade

class ReduceLoanThroughSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reduce-loan-through-salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically handles loan reduction through salaries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define your SQL statement
        $sql = "CALL ProcessCreditInstallments()";
        // you must insert below code for terminal
        // * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1


        // Execute the SQL statement
        try {
            DB::statement($sql);
            $this->info('The loan reduction through salary has been successfully processed.');
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
