<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\scrapeClass;

class scrapeAgadir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:agadir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Scrape Agadir';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(scrapeClass $scrapeAgadir)
    {
        parent::__construct();
        $this->scrapeAgadir = $scrapeAgadir;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scrapeAgadir->scarpe('https://www.annuaire-gratuit.ma/pharmacie-garde-agadir.html', 'Agadir', 7);
    }
}
