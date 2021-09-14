<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = Post::all();

    return view('posts.index', compact('posts'));
	}


	public function create()
	{
		return view('posts.create');
	}


	public function store(Request $request)
	{
		try {
      Post::create($request->all());

      return redirect()->route('posts.index')
        ->with('success', 'Post created successfully');
    } catch (\Exception $e) {
      return redirect()->back()
        ->withErrors(['error' => $e->getMessage()]);
    }
	}


	public function show(Post $post)
	{
		//
	}


	public function edit(Post $post)
	{
		return view('posts.edit', compact('post'));
	}


	public function update(Request $request, Post $post)
	{
		try {
      $post->update($request->all());

      return redirect()->route('posts.index')
        ->with('success', 'Post updated successfully');
    } catch (\Exception $e) {
      return redirect()->back()
        ->withErrors(['error' => $e->getMessage()]);
    }
	}


	public function destroy(Post $post)
	{
		try {
      $post->delete();

      return redirect()->route('posts.index')
        ->with('success', 'Post deleted successfully');
    } catch (\Exception $e) {
      return redirect()->back()
        ->withErrors(['error' => $e->getMessage()]);
    }
	}
}
