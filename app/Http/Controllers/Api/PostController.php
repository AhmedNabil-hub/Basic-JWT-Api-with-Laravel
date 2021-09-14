<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePostRequest;
use App\Http\Requests\Api\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
	public function index()
	{

		$posts = PostResource::collection(Post::all());

		return response(
			$posts,
			200,
			[
				'Accept' => 'application/json',
				'message' => 'Posts retrieved successfully'
			]
		);
	}


	public function store(StorePostRequest $request)
	{
		// try {
		// 	$post = Post::create($request->all());

		// 	return response(
		// 		new PostResource($post),
		// 		201,
		// 		[
		// 		'Accept' => 'application/json',
		// 		'message' => 'Post created successfully'
		// 		]
		// 	);
		// } catch (\Exception $e) {
		// 	return response(
		// 		$e->getMessage(),
		// 		400,
		// 		[
		// 		'Accept' => 'application/json',
		// 		'message' => $e->getMessage()
		// 		]
		// 	);
		// }

		$data = $request->validated();

		$post = Post::create(collect($data)->except('is_admin'));

		return response(
			new PostResource($post),
			201,
			[
			'Accept' => 'application/json',
			'message' => 'Post created successfully'
			]
		);
	}


	public function show(Post $post)
	{
		$post = new PostResource($post);

		return response(
			$post,
			200,
			[
				'Accept' => 'application/json',
				'message' => 'Posts retrieved successfully'
			]
		);
	}


	public function update(UpdatePostRequest $request, Post $post)
	{
		$data = $request->validated();

		$post->update([
			'title' => $data['title'],
			'body' => $data['body']
		]);

		return response(
			new PostResource(Post::find($post->id)),
			201,
			[
			'Accept' => 'application/json',
			'message' => 'Post updated successfully'
			]
		);
	}


	public function destroy(Post $post)
	{
		$post->delete();

		return response(
			"",
			200,
			[
			'Accept' => 'application/json',
			'message' => 'Post deleted successfully'
			]
		);
	}
}
