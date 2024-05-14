<?php

namespace App\Console\Commands;

use App\Models\Market;
use Carbon\Carbon;
use Illuminate\Console\Command;

class IntegrationInsertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:save {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command insert a new integration.';

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
        $user_id = $this->argument("user_id");
        $item = Market::create([
                'user_id' => $user_id,
                'marketplaces' => 'trendyol',
                'username' => 'Meltem Özkan INSERT',
                'password' => bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        $this->info("insert success. ID = ". $item["id"]);

    }
}

