<?php

namespace App\Console\Commands;

use App\Models\Market;
use Illuminate\Console\Command;

class IntegrationDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:delete {integrationId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command delete integration.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        date_default_timezone_set('Etc/GMT-3');
        date_default_timezone_set('Etc/GMT-3');
        $id = $this->argument("integrationId");

        Market::whereId($id)->delete();
        $this->info("delete success");
        //
    }
}
