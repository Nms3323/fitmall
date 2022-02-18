<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EquiementImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equiement_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equiement_id')->constrained('equiement')->onUpdate('cascade')->onDelete('cascade');
            $table->text('equ_images')->nullable();
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
        Schema::dropIfExists('equiement_images');
    }
}
