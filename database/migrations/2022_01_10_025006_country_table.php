<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CountryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('country', function (Blueprint $table) {
			$table->id();
			$table->string('country_name')->nullable();
			$table->string('slug')->nullable();
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
		Schema::dropIfExists('country');
	}
}
