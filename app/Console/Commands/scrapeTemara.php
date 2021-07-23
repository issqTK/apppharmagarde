<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeTemara extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:temara';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Temara';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeTemara)
    {
        parent::__construct();
        $this->scrapeTemara = $scrapeTemara;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeTemara->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-temara.html', 'Temara', 14);
    }
}
