<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Handle circular flip cards
     *
     * @param  \Models\Card Collection with LengthAwarePaginator  $resource
     * @return array
     */
    public function __construct($resource, $number, $circular = false)
    {
        if($resource->flipcard && $circular){
            $resource->flipcard = null;
        }

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
          'id' => $this->id,
          'name' => $this->name,
          'types' => $this->types->pluck('name'),
          'subtypes' => $this->subtypes->pluck('name'),
          'supertypes' => $this->supertypes->pluck('name'),
          'rarity' => $this->rarity->name,
          'colors' => $this->colors->pluck('name'),
          'sets' => $this->sets->pluck('name'),
          'manaCost' => $this->mana_cost,
          'typeText' => $this->type_text,
          'convertedManaCost' => $this->converted_mana_cost,
          'text' => $this->text,
          'artist' => $this->artist,
          'power' => $this->power,
          'toughness' => $this->toughness,
          'layout' => $this->layout,
          'imageUrl' => $this->image_url,
          'flipcard' => $this->getFlipCardOrNull(),
          'tilted' => boolval($this->tilted),

      ];
    }

    private function getFlipCardOrNull(){
      if($this->flipcard){
        return new CardResource($this->flipcard, null, true);
      } else {
        return null;
      }
    }
}
