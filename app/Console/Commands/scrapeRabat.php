<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeRabat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:rabat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Rabat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeRabat)
    {
        parent::__construct();
        $this->scrapeRabat = $scrapeRabat;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeRabat->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-rabat.html', 'Rabat', 2);
    }
}
