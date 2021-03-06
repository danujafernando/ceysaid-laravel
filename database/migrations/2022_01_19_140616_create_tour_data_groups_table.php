<?php

use App\Models\TourDataGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourDataGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_data_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('section')->default(TourDataGroup::PRICE_INCLUDE);
            $table->unsignedBigInteger('tour_id');
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_data_groups');
    }
}
