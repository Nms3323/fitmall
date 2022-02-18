<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FollowHistoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follow_history', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('post_id');
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('service_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_service_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->tinyInteger('is_follow')->comment('0-Unfollow, 1-Follow')->default('1');
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
		Schema::dropIfExists('follow_history');
	}
}
