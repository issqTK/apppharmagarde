<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\last_scrape_info;
use Carbon\Carbon;

use App\Http\Controllers\scrapeClass;

class schedule extends Controller
{
    public function __construct(scrapeClass $scraper) {
        $this->scraper = $scraper;
    }

    public function exec() {
        $this->scraper->scrapeAll();
        
        $gardCount = session()->get('gardCount');
        $pharmaCount = session()->get('pharmacyCount');
        $pharmaUpdate = session()->get('pharmacyUpdated');
        $pharmaFails = session()->get('pharmaFails');

        last_scrape_info::where('executedBy', '=', 'App')
            ->update([
                'guards_added' => $gardCount,
                'pharmacies_added' => $pharmaCount,
                'pharmacies_Updated' => $pharmaUpdate,
                'pharmacies_fails_count' => $pharmaFails,
                'updated_at' => Carbon::now()
            ]);
        
        return redirect()->route('scrapping');
    }

    public function cron() {
        $this->scraper->scrapeAll();
       
        $gardCount = session()->get('gardCount');
        $pharmaCount = session()->get('pharmacyCount');
        $pharmaUpdate = session()->get('pharmacyUpdated');
        $pharmaFails = session()->get('pharmaFails');

        last_scrape_info::where('executedBy', 'Cron')
            ->update([
                'guards_added' => $gardCount,
                'pharmacies_added' => $pharmaCount,
                'pharmacies_Updated' => $pharmaUpdate,
                'pharmacies_fails_count' => $pharmaFails,
                'updated_at' => Carbon::now()
            ]);

        return response()->json('cron executed successfully', 200);
    }
}
