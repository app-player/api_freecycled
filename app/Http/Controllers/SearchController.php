<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function getSearchResults(Request $request) {

			$data = $request->get('data');
			$search_data = Post::with('user', 'category', 'type')->where('title', 'like', "%{$data}%")->get();
			$user = auth()->user();
			return response()->json([
					'data' => $search_data,
					'user' => $user
				]);
			}
}
