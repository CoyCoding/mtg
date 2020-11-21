<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCardDataTypesToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
          $table->string('mana_cost')->change();
          $table->string('type_text')->change();
          $table->string('converted_mana_cost')->change();
          $table->text('text')->nullable()->change();
          $table->string('artist')->nullable()->change();
          $table->string('power')->nullable()->change();
          $table->string('toughness')->nullable()->change();
          $table->string('layout')->nullable()->change();
          $table->string('image_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('string', function (Blueprint $table) {
            //
        });
    }
}
