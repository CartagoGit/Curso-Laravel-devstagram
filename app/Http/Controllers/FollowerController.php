<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}
	//
	public function store(Request $request, User $followed)
	{
		$follower = auth()->user();
		$existFollow = Follower::where('followed_id', $followed->id)
			->where('follower_id', $follower->id)
			->exists();
		if ($existFollow) {
			$this->destroy($request, $followed);
		}
		Follower::create([
			'followed_id' => $followed->id,
			'follower_id' => $follower->id,
		]);
		return back();
	}

	public function destroy(Request $request, User $followed)
	{
		$follower = auth()->user();
		if ($followed->id === $follower->id) {
			return back();
		}
		$followBD = Follower::where('followed_id', $followed->id)
			->where('follower_id', $follower->id)
			->first();
		$existFollow = $followBD->exists();
		if (!$existFollow) {
			$this->store($request, $followed);
		}

		$followBD->delete();
		return back();
	}
}
