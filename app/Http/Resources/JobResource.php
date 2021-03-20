<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->ID,
            "date" => $this->post_date,
            "title" => $this->post_title,
            "excerpt" => $this->post_excerpt,
            "content" => $this->post_content,
            "meta" => JobMetaResource::collection($this->meta),
        ];
    }
}
