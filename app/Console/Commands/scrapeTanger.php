<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeTanger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scarpe:tanger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Tanger';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeTanger)
    {
        parent::__construct();
        $this->scrapeTanger = $scrapeTanger;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeTanger->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-tanger.html', 'Tanger', 13);
    }
}
