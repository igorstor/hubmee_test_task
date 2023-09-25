<?php

namespace Modules\Post\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'posts' => PostTransformer::collection($this->whenLoaded('posts')),
        ];
    }
}
