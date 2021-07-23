<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeMohammedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:mohammedia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Mohammedia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeMohammedia)
    {
        parent::__construct();
        $this->scrapeMohammedia = $scrapeMohammedia;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeMohammedia->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-mohammedia.html', 'Mohammedia', 12);
    }
}
