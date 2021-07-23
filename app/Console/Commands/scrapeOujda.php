<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeOujda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:oujda';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Oujda';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeOujda)
    {
        parent::__construct();
        $this->scrapeOujda = $scrapeOujda; 
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeRabat->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-oujda.html', 'Oujda', 5);
    }
}
