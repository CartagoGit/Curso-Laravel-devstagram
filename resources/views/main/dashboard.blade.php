@extends('layouts.app')

@section('titulo')
    Perfil de {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="flex flex-col flex-wrap items-center w-full sm:w-8/12 md:flex-row xl:w-6/12 ">
            <div class="w-6/12 px-5">
                <img src="{{ asset('img/user/usuario.svg') }}" alt="imagen del usuario" />
            </div>
            <div class="flex flex-col items-center px-5 pt-5 sm:w-6/12 md:justify-center md:items-start md:px-10">
                {{-- <p class="text-2xl text-gray-700">{{ auth()->user()->name }}</p> --}}
                <div class="flex items-center mb-5 ">

                    <span class="flex gap-2 text-2xl text-gray-700">
                        <span class="flex">{{ $user->name }}</span>
                        @auth()
                            @if ($user->id === auth()->user()->id)
                                <a class="self-center cursor-pointer" title="Editar perfil del usuario">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-[20px] mt-[4px]"  alignment-baseline="baseline">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>



                                </a>
                            @endif
                        @endauth
                    </span>
                </div>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    <!-- REVIEW HARCODEADO DESDE POST CONTRROLLER -->
                    {{ count($followers) }}
                    <span class="font-normal">
                        Seguidores
                    </span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    <!-- REVIEW HARCODEADO DESDE POST CONTRROLLER -->
                    {{ count($followed) }}
                    <span class="font-normal">
                        Siguiendo
                    </span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{ $posts->count() }}
                    <span class="font-normal">
                        Posts
                    </span>
                </p>

            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="my-10 text-4xl font-black text-center">
            Publicaciones de {{ $user->username }}
        </h2>
        @if ($posts->count())
            <div class="flex flex-wrap justify-center ">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', [$user, $post]) }}"
                        class="flex flex-col mx-4 my-4 overflow-hidden transition-all duration-300 bg-gray-700 border border-gray-700 shadow cursor-pointer rounded-xl basis-5/6 sm:basis-2/3 md:basis-2/5 lg:basis-1/4 xl:basis-1/5 hover:ring hover:ring-gray-500">

                        <span class="w-full p-2 text-center text-gray-100 bg-gray-700">
                            <p class="line-clamp-1" title="{{ $post->title }}">{{ $post->title }} </p>
                        </span>

                        <img src="{{ $post->image }}" alt="Imagen de la publicación {{ $post->title }}">

                        <div class="h-full p-2 bg-white border-t border-gray-700 ">

                            <p class="line-clamp-5 " title="{{ $post->description }}">{{ $post->description }}
                            </p>
                        </div>
                        <span class="p-1 mt-auto text-xs text-right text-gray-400">{{ $post->created_at }}</span>
                    </a>
                @endforeach


            </div>
            <div class="flex justify-center">

                <div class="w-96">{{ $posts->links() }}</div>
            </div>
        @else
            <div class="flex justify-center">
                <div class="p-4 bg-white border-4 border-gray-400 border-dashed shadow rounded-xl">
                    <p class="text-sm font-bold text-center text-gray-600 uppercase">No hay publicaciones</p>
                </div>
            </div>
        @endif
    </section>

@endsection
