<?php

namespace Modules\Post\Http\V1\Controllers;

use App\Http\Controllers\Controller;
use Modules\Post\Entities\User;
use Illuminate\Http\Request;
use Modules\Post\Transformers\UserTransformer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
                     ->paginate();

        return UserTransformer::collection($users);
    }
}
