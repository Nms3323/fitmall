<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('job_title_id')->constrained('job_title')->onUpdate('cascade')->onDelete('cascade');
			$table->string('job_image')->nullable();
			$table->text('job_description')->nullable();
			$table->float('job_min_salary', 8, 2);
			$table->float('job_max_salary', 8, 2);
			$table->tinyInteger('salary_duration')->comment('1-Per Session, 2-Day, 3-Week, 4-Month, 5-Year')->nullable();
			$table->text('job_website')->nullable();
			$table->bigInteger('job_total_likes')->nullable();
			$table->bigInteger('job_total_lead')->nullable();
			$table->bigInteger('job_total_reported')->nullable();
			$table->bigInteger('job_total_favorite')->nullable();
			$table->bigInteger('job_total_followers')->nullable();
			$table->tinyInteger('job_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('job_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('job_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('job');
	}
}
