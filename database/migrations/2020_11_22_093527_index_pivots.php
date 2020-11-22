<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IndexPivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('card_sets', function (Blueprint $table) {
          $table->index(['card_id', 'set_id']);
      });

      Schema::table('card_subtype', function (Blueprint $table) {
          $table->index(['card_id', 'subtype_id']);
      });

      Schema::table('card_types', function (Blueprint $table) {
          $table->index(['card_id', 'type_id']);
      });

      Schema::table('card_supertype', function (Blueprint $table) {
          $table->index(['card_id', 'supertype_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('card_sets', function (Blueprint $table) {
          $table->dropIndex(['card_id', 'set_id']);
      });

      Schema::table('card_subtype', function (Blueprint $table) {
          $table->dropIndex(['card_id', 'subtype_id']);
      });

      Schema::table('card_types', function (Blueprint $table) {
          $table->dropIndex(['card_id', 'type_id']);
      });

      Schema::table('card_supertype', function (Blueprint $table) {
          $table->dropIndex(['card_id', 'supertype_id']);
      });

    }
}
