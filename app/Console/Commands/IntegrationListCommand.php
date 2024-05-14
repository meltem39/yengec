<?php

namespace App\Console\Commands;

use App\Models\Market;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class IntegrationListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integration:list {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command list users integrations.';

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
        $user_id = $this->argument("user_id");
        $item = Market::where("user_id", $user_id)->whereNull("deleted_at")->get();

        $this->info($item);
    }
}
