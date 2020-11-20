<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Color;

class SeedColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $colors = [
        ['name' => 'White'],
        ['name' => 'Black'],
        ['name' => 'Green'],
        ['name' => 'Blue'],
        ['name' => 'Red']
      ];

      foreach( $colors as $color)
      {
        Color::create($color);
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Color::truncate();
    }
}