<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
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
            $table->string('type');
            $table->integer('converted_mana_cost');
            $table->integer('rarity_id');
            $table->integer('set_id');
            $table->text('text');
            $table->string('artist');
            $table->integer('power');
            $table->integer('toughness');
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
