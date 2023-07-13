@extends('layouts.app')

@section('titulo')
    {{ $post->title }}
@endsection

@section('contenido')
    <div class="container mx-auto flex flex-wrap justify-center gap-4">
        <div class="w-4/5 sm:w-[45%] ">
            <div class="flex justify-center w-full">
                <img class="rounded-xl border-4 border-dashed  border-gray-300 sm:max-h-[400px] shadow-lg"
                    src="{{ $post->image }}" alt="Imagen de la publicación {{ $post->title }}">
            </div>


            <div>
                <div class="flex justify-between">
                    <span class="font-bold">{{ $post->user->username }}</span>
                    <span class="text-right">
                        0 Likes
                        @if (auth()->check())
                            <button>Boton Dar Like</button>
                        @endif
                    </span>
                </div>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5 rounded-xl outline outline-2 outline-gray-600 p-3 bg-white shadow-lg">
                    {{ $post->description }}

                </p>
            </div>
        </div>
        <form class="w-4/5 sm:w-[45%] flex flex-col"
            action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="POST">

            @csrf
            @if (auth()->check())
                <div class="shadow p-5 w-full rounded-lg bg-gray-200 flex flex-col h-full">
                    <p class="text-xl font-bold text-center mb-4">
                        Agregar comentario
                    </p>
                    @if (session('message'))
                        <p class="bg-green-500 text-white mb-2 rounded-lg text-sm p-2 text-center w-full">
                            {{ session('message') }}
                    @endif
                    <div class="h-full flex flex-col h-full">
                        <div class="relative flex flex h-full">
                            <textarea id="comentario" type="text" name="comentario" minlength="10" maxlength="2200"
                                placeholder="Agregar comentario..." oninput="updateCommentLength(this)"
                                class="border p-3 w-full rounded-lg focus:outline-gray-300 resize-y  min-h-[100px] h-full max-h-[500px] @error('comment') border-red-500 @enderror"></textarea>
                            <span class="absolute text-xs right-0 -bottom-4 text-gray-700">
                                <span id="comment-length">
                                    0
                                </span>/2200
                            </span>
                            <script>
                                function updateCommentLength(textarea) {
                                    let commentLength = textarea.value.length;
                                    document.getElementById('comment-length').textContent = commentLength;
                                }
                            </script>
                        </div>
                        @error('comentario')
                            <p class="bg-red-500 text-white mt-6 rounded-lg text-sm p-2 text-center w-full">{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="mt-4 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full font-bold p-3 text-white rounded-lg">
                    Enviar comentario
                </button>
            @else
                <div class="p-5 w-full grid place-items-center h-full">
                    <p
                        class="shadow rounded-lg bg-sky-800 text-xl font-bold text-center text-white border-4 border-dashed border-gray-800 p-8 mb-4">
                        Solo usuarios autenticados pueden hacer comentarios
                    </p>
                </div>
            @endif
        </form>
        <div class="shadow p-5 mb-5 rounded-lg bg-gray-800 text-white w-4/5 sm:w-[calc(90%+1rem)] sm:w-full max-w-[700px]">
            <p class="text-xl font-bold text-center mb-4">
                Comentarios
            </p>
            <div class="h-full flex flex-col h-full">
                @if ($post->comments->count() > 0)
                    @foreach ($post->comments as $comment)
                        <div class="relative flex flex h-full">
                            <div disabled="true" type="text" name="comentario" minlength="10" maxlength="2200"
                                class="text-left border-2 border-sky-400 p-3 w-full rounded-lg resize-none bg-white text-black">{{ $comment->comment }}</div>

                        </div>
                        <div class="mt-2 mb-10">
                            <div class="flex justify-between">
                                <span class="font-bold">{{ $post->user->username }}
                                    <span class="text-sm text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </span>
                                <span class="text-right">
                                    0 Likes
                                    @if (auth()->check())
                                        <button>Boton Dar Like</button>
                                    @endif
                                </span>
                            </div>
                            <p></p>

                        </div>
                    @endforeach
                @else
                    <p
                        class="p-5 rounded-lg border-4 border-dashed border-gray-400 text-center bg-white text-black text-lg text-bold">
                        No hay comentarios en la publicación</p>
                @endif


            </div>
        </div>
    </div>
@endsection
