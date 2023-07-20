@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    @if ($posts->count())
	 <h1 class="flex justify-center uppercase text-lg font-extrabold text-purple-800">Publicaciones de personas a las que sigues</h1>
        <div class="flex flex-wrap justify-center">
            @foreach ($posts as $post)
                <article
                    class="mx-4 my-4 flex h-auto basis-5/6 cursor-pointer flex-col overflow-hidden rounded-xl border border-gray-700 bg-gray-700 shadow transition-all duration-300 hover:ring hover:ring-gray-500 sm:basis-2/3 md:basis-2/5 lg:basis-1/4 xl:basis-1/5"
                >
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
                    <a
                        class="flex flex-col h-full"
                        href="{{ route('posts.show', [$post->user, $post->id]) }}"
                    >
                        <span
                            class="flex w-full items-center justify-center bg-gray-700 p-2 text-center text-gray-100"
                        >
                            <p
                                class="line-clamp-1"
                                title="{{ $post->title }}"
                            >
                                {{ $post->title }}
                            </p>
                        </span>

                        <img
                            src="{{ $post->image }}"
                            alt="Imagen de la publicación {{ $post->title }}"
                        />

                        <div class="h-full border-t border-gray-700 bg-white p-2">
                            <p
                                class="line-clamp-5"
                                title="{{ $post->description }}"
                            >
                                {{ $post->description }}
                            </p>
                        </div>
                        <span class="mt-auto p-1 text-right text-xs text-gray-400">
                            {{ $post->created_at }}
                        </span>
                    </a>
                </article>
            @endforeach
        </div>

        <div class="flex justify-center">
            <div class="w-96">
                {{ $posts->links() }}
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center text-center">
            <div class="m-16 flex justify-center">
                <div
                    class="rounded-xl border-4 border-dashed border-gray-400 bg-white p-4 shadow">
                    <p
                        class="text-center text-sm font-bold uppercase text-gray-600">
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
