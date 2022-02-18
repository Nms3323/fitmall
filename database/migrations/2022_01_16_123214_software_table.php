<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoftwareTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('software', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->string('software_name')->nullable();
			$table->text('software_desc')->nullable();
			$table->text('software_website')->nullable();
			$table->bigInteger('software_total_likes')->nullable();
			$table->bigInteger('software_total_lead')->nullable();
			$table->bigInteger('software_total_reported')->nullable();
			$table->bigInteger('software_total_favorite')->nullable();
			$table->bigInteger('software_total_followers')->nullable();
			$table->tinyInteger('software_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('software_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('software_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('software');
	}
}
