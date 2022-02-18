<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('country')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('state_id')->constrained('state')->onUpdate('cascade')->onDelete('cascade');
            $table->string('city_name')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('active')->comment('0-Inactive, 1-Active')->default('1');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city');
    }
}
