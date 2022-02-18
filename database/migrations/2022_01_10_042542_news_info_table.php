<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsInfoTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_info', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->string('news_title')->nullable();
			$table->string('news_image')->nullable();
			$table->text('news_description')->nullable();
			$table->text('news_external_link')->nullable();
			$table->bigInteger('news_total_likes')->nullable();
			$table->bigInteger('news_total_lead')->nullable();
			$table->bigInteger('news_total_reported')->nullable();
			$table->bigInteger('news_total_favorite')->nullable();
			$table->bigInteger('news_total_followers')->nullable();
			$table->tinyInteger('news_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('news_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('news_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('news_info');
	}
}
