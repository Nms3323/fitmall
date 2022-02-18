<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NutritionistImageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nutritionist_image', function (Blueprint $table) {
			$table->id();
			$table->foreignId('nutrition_id')->constrained('nutritionist')->onUpdate('cascade')->onDelete('cascade');
			$table->string('nutrition_image')->nullable();
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
		Schema::dropIfExists('nutritionist_image');
	}
}
