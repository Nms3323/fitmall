<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoinViaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coin_via', function (Blueprint $table) {
			$table->id();
			$table->text('description')->nullable();
			$table->string('via')->nullable();
			$table->integer('no_of_coin');
			$table->tinyInteger('can_withdraw')->comment('0-Can, 1-Can Not')->default('1');
			$table->tinyInteger('active')->comment('0-Inactive, 1-Active')->default('1');
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
		Schema::dropIfExists('coin_via');
	}
}
