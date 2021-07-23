<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeSafi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:safi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Safi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeSafi)
    {
        parent::__construct();
        $this->scrapeSafi = $scrapeSafi;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeSafi->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-safi.html', 'Safi', 9);
    }
}
