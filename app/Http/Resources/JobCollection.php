<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class JobCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                "id" => $item->ID,
                "date" => $item->post_date,
                "title" => $item->post_title,
                "excerpt" => $item->post_excerpt,
                "content" => $item->post_content,
            ];
        });
    }
}
