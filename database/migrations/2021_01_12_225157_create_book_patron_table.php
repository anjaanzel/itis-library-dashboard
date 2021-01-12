<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPatronTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_patron', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id');
            $table->foreignId('patron_id');
            $table->string('book_code');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('patron_id')->references('id')->on('patrons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_patron');
    }
}
