<?php

namespace App\Console\Commands;

use App\Http\Controllers\DepositsController;
use App\Models\Deposits;
use Illuminate\Console\Command;

class ChargePercentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charge:percent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The Command that charges once a minute from the deposit to the user\'s balance';

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
        $deposits = Deposits::all();
        $deposits->each(
            function ($item) {
                (new DepositsController())->chargingPercentFromDeposit($item->id);
            }
        );
    }
}
