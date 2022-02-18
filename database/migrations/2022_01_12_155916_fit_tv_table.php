<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FitTvTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fit_tv', function (Blueprint $table) {
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->text('uploaded_link')->nullable();
			$table->string('vdo_title')->nullable();
			$table->string('vdo_display')->nullable();
			$table->text('fit_tv_description')->nullable();
			$table->text('fit_tv_external_link')->nullable();
			$table->bigInteger('fit_tv_total_likes')->nullable();
			$table->bigInteger('fit_tv_total_lead')->nullable();
			$table->bigInteger('fit_tv_total_reported')->nullable();
			$table->bigInteger('fit_tv_total_favorite')->nullable();
			$table->bigInteger('fit_tv_total_followers')->nullable();
			$table->tinyInteger('fit_tv_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('fit_tv_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('fit_tv_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('fit_tv');
	}
}
