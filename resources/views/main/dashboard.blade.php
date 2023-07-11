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
            <div class="flex flex-wrap justify-center ">
                @foreach ($posts as $post)
                    <div
                        class="border border-gray-700 rounded-xl flex flex-col overflow-hidden shadow bg-gray-700 mx-4 my-4
								flex basis-5/6 sm:basis-2/3 md:basis-2/5 lg:basis-1/4 xl:basis-1/5 cursor-pointer transition-all duration-300 hover:ring hover:ring-gray-500">

                        <span class="p-2 w-full text-center bg-gray-700 text-gray-100">
                            <p class="line-clamp-1" title="{{ $post->title }}">{{ $post->title }} </p>
                        </span>

                        <img src="{{ $post->image }}" alt="Imagen de la publicación {{ $post->title }}">

                        <div class="p-2 bg-white border-gray-700 border-t h-full ">

                            <p class="line-clamp-5 " title="{{ $post->description }}">{{ $post->description }}
                            </p>
                        </div>
                        <span class="text-right text-xs p-1 text-gray-400 mt-auto">{{ $post->created_at }}</span>
                    </div>
                @endforeach


					</div>
					<div class="flex justify-center">

						<div class="w-96">{{ $posts->links() }}</div>
					</div>
        @else
            <div class="flex justify-center">
                <div class="p-4 border-4 border-dashed border-gray-400 rounded-xl bg-white shadow">
                    <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones</p>
                </div>
            </div>
        @endif
    </section>

@endsection
