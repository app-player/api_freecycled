<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Proceed;
class ProceedController extends Controller
{
	public function index()
	{
		$posts = Proceed::with('user')->get();
		$user = auth()->user();
		return response()->json([
			'success' => true,
			'data' => $posts,
			'user' => $user
		]);
	}
	public function store(Request $request)
	{
			$this->validate($request, [
					'phone_number' => 'required',
					'location_id' => 'required|integer',
					'link_facebook' => 'required',
			]);

			$post = new Proceed();
			$post->phone_number = $request->phone_number;
			$post->location_id = $request->location_id;
			$post->link_facebook = $request->link_facebook;
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
}
