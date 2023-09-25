<?php

namespace Modules\Post\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PostTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'body'  => $this->body,
            'user'  => UserTransformer::make($this->whenLoaded('user')),
        ];
    }
}
