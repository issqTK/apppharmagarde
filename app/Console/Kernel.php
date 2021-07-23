<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\scrapeAgadir::class,
        Commands\scrapeCasa::class,
        Commands\scrapeEljadida::class,
        Commands\scrapeFes::class,
        Commands\scrapeKenitra::class,
        Commands\scrapeMarrakech::class,
        Commands\scrapeMeknes::class,
        Commands\scrapeMohammedia::class,
        Commands\scrapeOujda::class,
        Commands\scrapeRabat::class,
        Commands\scrapeSafi::class,
        Commands\scrapeSale::class,
        Commands\scrapeTanger::class,
        Commands\scrapeTemara::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('scrape:agadir')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scarpe:casa')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scarpe:eljadida')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scarpe:fes')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scarpe:kenitra')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:marrakech')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:meknes')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:mohammedia')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:oujda')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:rabat')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:safi')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:sale')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:tanger')->dailyAt('08:00')->timezone('Africa/Casablanca');
        $schedule->command('scrape:temara')->dailyAt('08:00')->timezone('Africa/Casablanca');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
