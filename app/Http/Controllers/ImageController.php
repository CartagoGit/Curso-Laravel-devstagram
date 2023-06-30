<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
		$imagenServidor->fit(1000, 1000);
		// $imagenPath = public_path('uploads') . '/images/' . $nombreImage;
		$baseCarpeta = 'uploads/images';
		$rutaCarpeta = public_path($baseCarpeta);
		if (!file_exists($rutaCarpeta)) {
			mkdir($rutaCarpeta, 0755, true);
		}
		$imagenPath = $rutaCarpeta . '/' . $nombreImage;
		$imagenServidor->save($imagenPath);
		// $image->store('images', 'public');
		$imageData = [
			'data' => $imagenServidor->filesize(),
			'width' => $imagenServidor->width(),
			'height' => $imagenServidor->height(),
			'mime' => $imagenServidor->mime(),
			'extension' => $image->extension(),
			'original_name' => $image->getClientOriginalName(),
			'name' => $nombreImage,
			'path' => $rutaCarpeta,
			'base_path' => $baseCarpeta,
			'path_full' => $imagenPath,
			'public_path' => '/' . $baseCarpeta . '/' . $nombreImage,
		];

		return response()->json(['data' => $imageData]);
	}
}
