<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FitnessCenterTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fitness_center', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->string('center_name')->nullable();
			$table->text('center_desc')->nullable();
			$table->text('center_website')->nullable();
			$table->foreignId('city_id')->constrained('city')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('state_id')->constrained('state')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('country_id')->constrained('country')->onUpdate('cascade')->onDelete('cascade');
			$table->bigInteger('center_total_likes')->nullable();
			$table->bigInteger('center_total_lead')->nullable();
			$table->bigInteger('center_total_reported')->nullable();
			$table->bigInteger('center_total_favorite')->nullable();
			$table->bigInteger('center_total_followers')->nullable();
			$table->tinyInteger('center_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('center_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('center_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('fitness_center');
	}
}
