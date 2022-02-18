<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FavoriteHistoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favorite_history', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('post_id')->nullable();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('service_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_service_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->tinyInteger('is_favorite')->comment('0-Unfavorite, 1-Favorite')->default('1');
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
		Schema::dropIfExists('favorite_history');
	}
}
