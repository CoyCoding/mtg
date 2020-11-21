<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mana_cost');
            $table->string('type_text');
            $table->integer('converted_mana_cost');
            $table->integer('rarity_id')->references('id')->on('rarities')
        ->onDelete('cascade');
            $table->text('text');
            $table->string('artist');
            $table->integer('power')->nullable();
            $table->integer('toughness')->nullable();
            $table->string('layout');
            $table->string('image_url');
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
        Schema::dropIfExists('cards');
    }
}
