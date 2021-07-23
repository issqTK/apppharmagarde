<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeFes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:fes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Fes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeFes)
    {
        parent::__construct();
        $this->scrapeFes = $scrapeFes;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeFes->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-fes.html', 'Fès', 10, 'Fès', 10);
    }
}
