<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return response()->json([
            'success' => true,
            'data' => $categories,
            'data' => $posts
        ]);
    }


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        $category_post = Post::where('category_id',$id)->get();
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
