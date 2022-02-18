<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrainerTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trainer', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->string('trainer_name')->nullable();
			$table->text('trainer_desc')->nullable();
			$table->text('trainer_website')->nullable();
			$table->bigInteger('trainer_total_likes')->nullable();
			$table->bigInteger('trainer_total_lead')->nullable();
			$table->bigInteger('trainer_total_reported')->nullable();
			$table->bigInteger('trainer_total_favorite')->nullable();
			$table->bigInteger('trainer_total_followers')->nullable();
			$table->tinyInteger('trainer_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('trainer_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('trainer_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('trainer');
	}
}
