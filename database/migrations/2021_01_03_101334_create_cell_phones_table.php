<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_phones', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('model_name');
            $table->string('price');
            $table->string('ram_capacity')->nullable();
            $table->string('rom_capacity')->nullable();
            $table->string('primary_camera')->nullable();
            $table->string('secondary_camera')->nullable();
            $table->string('screen_size')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreignId('created_by')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cell_phones');
    }
}
