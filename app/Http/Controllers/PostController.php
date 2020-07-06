<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function display_user_post()
    {
        $posts = auth()->user()->posts()->with('user', 'category', 'type')->get();
				$user = auth()->user();
				$total = auth()->user()->posts()->with('type')->get()->count();
				$total_offer = auth()->user()->posts()->with('type')->where('type_id', 1)->get()->count();
				$total_request = auth()->user()->posts()->with('type')->where('type_id', 2)->get()->count();
        return response()->json([
            'success' => true,
            'data' => $posts,
						'user' => $user,
						'total' => $total,
						'total_offer' => $total_offer,
						'total_request' => $total_request
        ]);
    }

    public function show_user_post($id)
    {
        $post = auth()->user()->posts()->with('user', 'category', 'type')->get()->find($id);
				$user = auth()->user();
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $post->toArray(),
						'user' => $user,
        ], 400);
    }

    public function postdata(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'image_path' => 'mimes:jpeg,jpg,png|required',
            'category_id' => 'required',
            'type_id' => 'required',
        ]);

        $target_dir = "upload/images";
        if(!file_exists($target_dir)){
            mkdir($target_dir, 0777, true);
        }
            $filename_type = request('image_path')->getClientOriginalExtension();
            $filename = $target_dir . "/" .rand() . '_' . time() . '.' . $filename_type;
            move_uploaded_file($_FILES['image_path']['tmp_name'], $filename);
            $image_url = 'http://127.0.0.1:8000/' . $filename;

        $post = new Post();
        $post->title = $request->title;
        $post->image_path = $filename;
        $post->category_id = $request->category_id;
        $post->type_id = $request->type_id;
        $post->image_url = $image_url;
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
                'data'=>$post,
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
