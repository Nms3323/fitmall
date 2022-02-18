<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NutritionistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nutrition_name')->nullable();
            $table->text('nutrition_desc')->nullable();
            $table->text('nutrition_website')->nullable();
            $table->bigInteger('nutrition_total_likes')->nullable();
            $table->bigInteger('nutrition_total_lead')->nullable();
            $table->bigInteger('nutrition_total_reported')->nullable();
            $table->bigInteger('nutrition_total_favorite')->nullable();
            $table->bigInteger('nutrition_total_followers')->nullable();
            $table->tinyInteger('nutrition_boost_option')->comment('0-Not Available, 1-Available')->default('1');
            $table->tinyInteger('nutrition_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
            $table->tinyInteger('nutrition_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
        Schema::dropIfExists('nutritionist');
    }
}
