<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rarity;

class SeedRarities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $rs = [
        ["name" =>"Common"],
        ["name" =>"Uncommon"],
        ["name" =>"Rare"],
        ["name" =>"Mythic Rare"]
      ];

      foreach($rs as $rarity)
      {
        Rarity::create($rarity);
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Rarity::truncate();
    }
}
