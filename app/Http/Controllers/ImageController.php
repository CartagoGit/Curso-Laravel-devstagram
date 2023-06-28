<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
	//
	public function store(Request $request)
	{
		//  return "Imagen controller";
		$image = $request->file('file');
		$nombreImage = Str::uuid() . '.' . $image->extension();
		$imagenServidor = Image::make($image);
		$imagenServidor->fit(1000,1000);
		$imagenPath = public_path('uploads') . '/images/' . $nombreImage;
		$imagenServidor->save($imagenPath);
		// $image->store('images', 'public');
		return response()->json(['image' => $image->extension()]);
	}
}
