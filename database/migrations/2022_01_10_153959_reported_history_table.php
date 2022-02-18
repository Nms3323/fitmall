<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportedHistoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reported_history', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('post_id')->nullable();
			$table->foreignId('service_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_service_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('reason_id')->constrained('reported_reason')->onUpdate('cascade')->onDelete('cascade');
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
		Schema::dropIfExists('reported_history');
	}
}
