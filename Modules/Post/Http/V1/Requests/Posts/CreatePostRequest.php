<?php

namespace Modules\Post\Http\V1\Requests\Posts;

use Modules\Post\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class CreatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'int', new Exists(User::class, 'id')],
            'title'   => ['required', 'string'],
            'body'    => ['required', 'string'],
        ];
    }
}
