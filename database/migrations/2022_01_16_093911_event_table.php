<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->string('event_name')->nullable();
			$table->string('event_image')->nullable();
			$table->text('event_description')->nullable();
			$table->dateTime('event_start_dttime', 0);
			$table->dateTime('event_end_dttime', 0);
			$table->dateTime('booking_end_dttime', 0);
			$table->tinyInteger('event_booking_status')->comment('0-Online, 1-Ofline');
			$table->text('event_booking_link')->nullable();
			$table->text('event_booking_address')->nullable();
			$table->float('event_cost', 8, 2);
			$table->text('event_website')->nullable();
			$table->bigInteger('event_total_likes')->nullable();
			$table->bigInteger('event_total_lead')->nullable();
			$table->bigInteger('event_total_reported')->nullable();
			$table->bigInteger('event_total_favorite')->nullable();
			$table->bigInteger('event_total_followers')->nullable();
			$table->tinyInteger('event_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('event_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('event_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('event');
	}
}
