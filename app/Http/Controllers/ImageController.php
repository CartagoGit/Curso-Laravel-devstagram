<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
	//
	public function store(Request $request)
	{
		//  return "Imagen controller";
		$image = $request->file('file');
		$image->store('images', 'public');
		return response()->json(['image' => $image->extension()]);
	}
}
