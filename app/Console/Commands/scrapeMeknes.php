<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeMeknes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:meknes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Meknes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeMeknes)
    {
        parent::__construct();
        $this->scrapeMeknes = $scrapeMeknes;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeMeknes->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-meknes.html', 'Meknes', 6);
    }
}
