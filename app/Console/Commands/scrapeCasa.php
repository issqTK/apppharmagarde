<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeCasa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:casa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Casa';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeCasa)
    {
        parent::__construct();
        $this->scrapeCasa = $scrapeCasa;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeCasa->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-casablanca.html', 'Casablanca', 1);
    }
}
