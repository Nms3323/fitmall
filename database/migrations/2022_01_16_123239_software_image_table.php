<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoftwareImageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('software_image', function (Blueprint $table) {
			$table->id();
			$table->foreignId('software_id')->constrained('software')->onUpdate('cascade')->onDelete('cascade');
			$table->string('software_image')->nullable();
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
		Schema::dropIfExists('software_image');
	}
}
