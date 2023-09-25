<?php

namespace Modules\Post\Http\V1\Requests\Posts;

use Modules\Post\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class UpdatePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['sometimes', 'int', new Exists(User::class, 'id')],
            'title'   => ['sometimes', 'string'],
            'body'    => ['sometimes', 'string'],
        ];
    }
}
