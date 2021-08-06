<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLastScrapeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_scrape_infos', function (Blueprint $table) {
            $table->id();
            $table->string('executedBy');
            $table->string('city');
            $table->integer('guards_added');
            $table->integer('pharmacies_added');
            $table->integer('pharmacies_Updated');
            $table->integer('pharmacies_fails_count');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('last_scrape_infos');
    }
}
