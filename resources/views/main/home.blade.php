@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    @if ($posts->count())
        {{-- <x-list-posts :posts="$posts" /> --}}
        <x-list-posts>
            <x-slot:title>
                <h1
                    class="flex justify-center text-lg font-extrabold uppercase text-gray-400">
                    @if (auth()->check())
                        Publicaciones de personas a las que sigues
                    @else
                        <a href="{{ route('register') }}">
                            Últimas publicaciones. Registrate para participar
                        </a>
                    @endif
                </h1>

            </x-slot:title>
				<x-slot:creator>
					<a
					class="w-full bg-white p-2 text-center transition-colors hover:bg-gray-200"
					href={{ route('posts.index', [$post->user]) }}
			  >

					<p
						 class="line-clamp-1"
						 title="{{ $post->user->username }}"
					>
						 <span>
							  Usuario:
						 </span>
						 <span class="text-lg font-bold uppercase text-sky-800">
							  {{ $post->user->username }}
						 </span>
					</p>
			  </a>
					 </x-slot:creator>
        </x-list-posts>
    @else
        <div class="flex flex-col items-center justify-center text-center">
            <div class="m-16 flex justify-center">
                <div
                    class="rounded-xl border-4 border-dashed border-gray-400 bg-white p-4 shadow">
                    <p class="text-center text-sm font-bold uppercase text-gray-600">
                        No hay publicaciones
                    </p>
                </div>
            </div>
            <a
                class="rounded-lg bg-blue-500 px-4 py-2 font-bold text-white transition-colors hover:bg-blue-700"
                href="{{ route('posts.create') }}"
            >
                Crear publicación
            </a>
        </div>
    @endif

    {{-- * Otra forma de hacerlo --}}
    {{-- @forelse ($posts as $post)
        <div class="flex justify-center">
            <div class="w-96">
                {{ $post->title }}
            </div>
        </div>
    @empty
        <p>No hay publicaciones</p>
    @endforelse --}}
@endsection
