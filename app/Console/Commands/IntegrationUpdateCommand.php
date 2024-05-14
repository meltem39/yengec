<?php

namespace App\Console\Commands;

use App\Models\Market;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class IntegrationUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:update {integrationId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update the integration.';

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
     */
    public function handle()
    {
        date_default_timezone_set('Etc/GMT-3');
        $id = $this->argument("integrationId");

        Market::whereId($id)->update([
                'marketplaces' => 'n11',
                'username' => 'Meltem Özkan UPDATE',
                'password' => bcrypt('123456')
            ]
        );
        $this->info("update success");
    }
}
