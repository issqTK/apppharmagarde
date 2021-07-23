<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Sale';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeSale)
    {
        parent::__construct();
        $this->scrapeSale = $scrapeSale;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeSale->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-sale.html', 'Sale', 8);
    }
}
