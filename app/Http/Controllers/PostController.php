<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts;

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function show($id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $post->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'image' => 'required',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->image = $request->image;
        $post->category_id = $request->category_id;
        $post->type_id = $request->type_id;

        if (auth()->user()->posts()->save($post))
            return response()->json([
                'success' => true,
                'data' => $post->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post could not be added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post with id ' . $id . ' not found'
            ], 400);
        }

        $updated = $post->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post could not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post with id ' . $id . ' not found'
            ], 400);
        }

        if ($post->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post could not be deleted'
            ], 500);
        }
    }
}
