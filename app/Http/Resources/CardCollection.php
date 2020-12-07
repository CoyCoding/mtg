<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CardCollection extends ResourceCollection
{

    public $collects = 'App\Http\Resources\CardResource';


    /**
     * Converts the LengthAwarePaginator to Api friendly model
     *
     * @param  \Models\Card Collection with LengthAwarePaginator  $resource
     * @return array
     */
    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'perPage' => $resource->perPage(),
            'currentPage' => $resource->currentPage(),
            'lastPage' => $resource->lastPage()
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
          'cards' => $this->collection,
          'pageInfo' => $this->pagination
      ];
    }
}
