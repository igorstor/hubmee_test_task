<?php

namespace Modules\Post\Http\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Modules\Post\Entities\Post;
use Modules\Post\Http\V1\Requests\Posts\CreatePostRequest;
use Modules\Post\Http\V1\Requests\Posts\PostListRequest;
use Modules\Post\Http\V1\Requests\Posts\UpdatePostRequest;
use Modules\Post\Transformers\PostTransformer;

class PostController extends Controller
{
    public function index(PostListRequest $request)
    {
        $posts = Post::query()
                     ->search($request->search)
                     ->with(['user'])
                     ->paginate();

        return PostTransformer::collection($posts);
    }

    public function store(CreatePostRequest $request)
    {
        // it's out of scope of the test task but i would check does user has permission to create post
        // $this->authorize('create', $post);

        // in real project we would create post via relation
        // $request->user()->posts()->create($request->validated())

        $post = Post::query()
                    ->create($request->validated());

        return PostTransformer::make($post->load('user'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // it's out of scope of the test task but i would check does user has permission to update this post
        // $this->authorize('update', $post);

        $post->update($request->validated());

        return PostTransformer::make($post->load('user'));
    }

    public function destroy(Request $request, Post $post)
    {
        // it's out of scope of the test task but i would check does user has permission to delete this post
//         $this->authorize('delete', $post);

        $post->delete();

        return Response::noContent();
    }
}
