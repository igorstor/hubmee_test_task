<?php

namespace Modules\Post\Http\V1\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostListRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search' => ['sometimes', 'string', 'max:15'],
        ];
    }
}
