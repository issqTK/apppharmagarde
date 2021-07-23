<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeMarrakech extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:marrakech';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Marrakech';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeMarrakech)
    {
        parent::__construct();
        $this->scrapeMarrakech = $scrapeMarrakech;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeMarrakech->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-marrakech.html', 'Marrakech', 3);
    }
}
