<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->double('price', 15, 8)
                ->nullable();
            $table->text('address')
                ->nullable();
            $table->string('longitude', 100);
            $table->string('latitude', 100);
            $table->time('operational_start')
                ->nullable();
            $table->time('operational_end')
                ->nullable();
            $table->string('telephone')
                ->nullable();
            $table->foreignId('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
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
        Schema::dropIfExists('places');
    }
}
