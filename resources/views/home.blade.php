@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    @if ($posts->count())
        <div class="grid md:grid-cols-5 gap-4">
            @foreach ($posts as $post)
                <div>

                    {{ $post->title }}
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
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
@endsection
