<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IndexCardColorPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('card_colors', function (Blueprint $table) {
          $table->index(['card_id', 'color_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('card_colors', function (Blueprint $table) {
          $table->dropIndex(['card_id', 'color_id']);
      });
    }
}
