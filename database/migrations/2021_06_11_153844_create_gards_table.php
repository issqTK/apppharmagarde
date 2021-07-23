<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gards', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->string('guard_type');
            $table->unsignedInteger('pharmacy_id');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
            $table->dateTimeTz('created_at')->default( DB::raw('CURRENT_TIMESTAMP') );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gards');
    }
}
