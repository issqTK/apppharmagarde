<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('address', 255);
            $table->string('phone', 20)->unique();
            $table->text('location_url')->nullable();
            $table->text('gmaps_url')->nullable();
            $table->decimal('lat', $precision = 10, $scale = 8)->nullable();
            $table->decimal('long', $precision = 10, $scale = 8)->nullable();
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacies');
    }
}
