<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Type;

class SeedType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $types = [
        ['name' => "Artifact"],
        ['name' => "Autobot"],
        ['name' => "Card"],
        ['name' => "Character"],
        ['name' => "Conspiracy"],
        ['name' => "Creature"],
        ['name' => "Dragon"],
        ['name' => "Elemental"],
        ['name' => "Enchantment"],
        ['name' => "Goblin"],
        ['name' => "Hero"],
        ['name' => "instant"],
        ['name' => "Instant"],
        ['name' => "Jaguar"],
        ['name' => "Knights"],
        ['name' => "Land"],
        ['name' => "Phenomenon"],
        ['name' => "Plane"],
        ['name' => "Planeswalker"],
        ['name' => "Scheme"],
        ['name' => "Sorcery"],
        ['name' => "Specter"],
        ['name' => "Summon"],
        ['name' => "Tribal"],
        ['name' => "Vanguard"],
        ['name' => "Wolf"],
        ['name' => "You’ll"]];

      foreach( $types as $type)
      {
        Type::create($type);
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
