@extends('layouts.app')

@section('titulo')
    Perfil de {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full flex flex-col flex-wrap items-center sm:w-8/12 md:flex-row xl:w-6/12 ">
            <div class="w-6/12 px-5">
                <img src="{{ asset('img/user/usuario.svg') }}" alt="imagen del usuario" />
            </div>
            <div class="sm:w-6/12 px-5 pt-5 flex flex-col md:justify-center items-center md:items-start md:px-10">
                {{-- <p class="text-gray-700 text-2xl">{{ auth()->user()->name }}</p> --}}
                <p class="text-gray-700 text-2xl mb-5">{{ $user->name }}</p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Seguidores
                    </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Siguiendo
                    </span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Posts
                    </span>
                </p>
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones de {{ $user->username }}
        </h2>
        @if ($posts->count())
            <div class="flex flex-wrap justify-center">
                @foreach ($posts as $post)
                    <div
                        class="border border-gray-700 rounded-xl flex flex-col overflow-hidden shadow bg-gray-700 mx-4 my-4
								flex basis-5/6 sm:basis-2/3 md:basis-2/5 lg:basis-1/4 xl:basis-1/5
								">

                        <span class="p-2 w-full text-center bg-gray-700 text-gray-100">{{ $post->title }}</span>
                        <a href="" class="">
                            <img src="{{ $post->image }}" alt="Imagen de la publicación {{ $post->title }}">
                        </a>
                        <span class="p-2 bg-white border-gray-700 border-t">{{ $post->description }}</span>
                        <span class="text-right text-xs p-1 text-gray-400">{{ $post->created_at }}</span>
                    </div>
                @endforeach

            </div>
        @else
            <div class="flex justify-center">
                <div class="p-4 border-4 border-dashed border-gray-400 rounded-xl bg-white shadow">
                    <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
                </div>
            </div>
        @endif
    </section>
    {{-- <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones de {{ $user->username }}
        </h2>
        @if ($posts->count())
            <div class="grid p-15 md:p-0 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-3/4 md:w-full mx-auto justify-center grid-flow-dense">

                @foreach ($posts as $post)
                    <div class="border border-gray-700 rounded-xl flex flex-col overflow-hidden shadow   bg-gray-700">
                        <span class="p-2 w-full text-center bg-gray-700 text-gray-100">{{ $post->title }}</span>
                        <a href="" class="">
                            <img src="{{ $post->image }}" alt="Imagen de la publicación {{ $post->title }}">
                        </a>
                        <span class="p-2 bg-white border-gray-700 border-t">{{ $post->description }}</span>
                        <span class="text-right text-xs p-1 text-gray-400">{{ $post->created_at }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center">
                <div class="p-4 border-4 border-dashed border-gray-400 rounded-xl bg-white shadow">

                    <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
                </div>

            </div>
        @endif
    </section> --}}
@endsection
