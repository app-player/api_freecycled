<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function display_categories()
    {
        $posts = Post::with('category', 'type', 'user')->orderBy('id', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function show_categories($id)
    {
        $category_post = Post::where('category_id',$id)->with('user', 'category', 'type')->orderBy('id', 'DESC')->get();
        $id_= $id;

        return response()->json([
            'success' => true,
            'data' => $category_post,
        ]);
    }


    public function edit(Category $category)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {

    }
}
