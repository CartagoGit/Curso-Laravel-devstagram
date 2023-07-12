@extends('layouts.app')

@section('titulo')
    {{ $post->title }}
@endsection

@section('contenido')
    <div class="container mx-auto flex flex-wrap justify-center">
        <div class="w-4/5 sm:w-[45%] ">
            <div class="flex justify-center w-full">
                <img class="rounded-xl border-4 border-dashed  border-gray-300 sm:max-h-[400px] shadow-lg" src="{{ $post->image }}"
                    alt="Imagen de la publicación {{ $post->title }}">
            </div>


            <div>
                <div class="flex justify-between">
                    <span class="font-bold">{{ $post->user->username }}</span>
                    <span class="text-right">0 Likes</span>
                </div>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5 rounded-xl border-2 border-gray-600 p-3 bg-white shadow-lg">
                    {{ $post->description }}

                </p>
            </div>
        </div>
        <div class="w-4/5 sm:w-1/2">
        </div>
    </div>
@endsection
