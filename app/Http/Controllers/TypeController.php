<?php

namespace App\Http\Controllers;

use App\Post;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::all()->orderBy('id', 'DESC')->get();
        $posts = Post::all()->orderBy('id', 'DESC')->get();
        return response()->json([
            'success' => true,
            'data' => $types,
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
        $type_post = Post::where('type_id',$id)->with('user', 'category', 'type')->orderBy('id', 'DESC')->get();
        $id_= $id;
				$user = auth()->user();

        return response()->json([
            'success' => true,
            'data' => $type_post,
						'datauser' => $user,
        ]);
    }

    function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
