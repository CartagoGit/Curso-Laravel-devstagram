@extends('layouts.app')

@section('titulo')
    {{ $post->title }}
@endsection

@section('contenido')
    <div class="container flex flex-wrap justify-center gap-4 mx-auto">
        <div class="w-4/5 sm:w-[45%] ">
            <div class="flex justify-center w-full">
                <img class="rounded-xl border-4 border-dashed  border-gray-300 sm:max-h-[400px] shadow-lg"
                    src="{{ $post->image }}" alt="Imagen de la publicación {{ $post->title }}">
            </div>


            <div>
                <div class="flex justify-between">
                    <span class="font-bold"> <a
                            href="{{ route('posts.index', $post->user->username) }}">{{ $post->user->username }}
                        </a></span>
                    <span class="flex items-center gap-1 text-right">
							{{ $post->likes()->count() }} Likes
                        @if (auth()->check())
                            {{-- <form action="{{ route('likes.store', ['user' => auth()->user(), 'foreign' => $post]) }}" --}}
                            <form action="{{ route('likes.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="foreign" value="{{ $post }}">
                                <input type="hidden" name="typeLike" value="post">
                                <button type="submit"
                                    class="text-lg">{{ $post->likes()->where('user_id', auth()->id())->where('post_id', $post->id)->exists()? '❌': '💖' }}</button>
                            </form>
                        @endif
                    </span>
                </div>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="p-3 mt-5 bg-white shadow-lg rounded-xl outline outline-2 outline-gray-600">
                    {{ $post->description }}

                </p>
                {{-- {{ dd($post) }} --}}
                {{-- @if (auth()->id() == $post->user_id && $post->user && isset($post->user->path)) --}}
                @if (auth()->id() == $post->user_id)
                    <div class="flex justify-between gap-10 mt-5">
                        <a href="#"
                            class="p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-amber-600 l hover:bg-amber-700">
                            Editar publicación
                        </a>
                        <form action="{{ route('posts.destroy', ['user' => $post->user->path, 'post' => $post->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full p-3 font-bold text-white uppercase transition-colors bg-red-600 rounded-lg cursor-pointer hover:bg-red-700">
                                Eliminar publicación
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <form class="w-4/5 sm:w-[45%] flex flex-col"
            action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="POST">

            @csrf
            @if (auth()->check())
                <div class="flex flex-col w-full h-full p-5 bg-gray-200 rounded-lg shadow">
                    <p class="mb-4 text-xl font-bold text-center">
                        Agregar comentario
                    </p>
                    @if (session('message'))
                        <p class="w-full p-2 mb-2 text-sm text-center text-white bg-green-500 rounded-lg">
                            {{ session('message') }}
                    @endif
                    <div class="flex flex-col h-full">
                        <div class="relative flex h-full">
                            <textarea id="comentario" type="text" name="comentario" minlength="10" maxlength="2200"
                                placeholder="Agregar comentario..." oninput="updateCommentLength(this)"
                                class="border p-3 w-full rounded-lg focus:outline-gray-300 resize-y  min-h-[100px] h-full max-h-[500px] @error('comment') border-red-500 @enderror"></textarea>
                            <span class="absolute right-0 text-xs text-gray-700 -bottom-4">
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
                            <p class="w-full p-2 mt-6 text-sm text-center text-white bg-red-500 rounded-lg">{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full p-3 mt-4 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700">
                    Enviar comentario
                </button>
            @else
                <div class="grid w-full h-full p-5 place-items-center">
                    <p
                        class="p-8 mb-4 text-xl font-bold text-center text-white border-4 border-gray-800 border-dashed rounded-lg shadow bg-sky-800">
                        Solo usuarios autenticados pueden hacer comentarios
                    </p>
                </div>
            @endif
        </form>
        <div class="shadow p-5 mb-5 rounded-lg bg-gray-800 text-white w-4/5 sm:w-[calc(90%+1rem)] sm:w-full max-w-[700px]">
            <p class="mb-4 text-xl font-bold text-center">
                Comentarios
            </p>
            <div class="flex flex-col h-full">
                @if ($post->comments->count() > 0)
                    @foreach ($post->comments as $comment)
                        <div class="relative flex h-full">
                            <div disabled="true" type="text" name="comentario" minlength="10" maxlength="2200"
                                class="w-full p-3 text-left text-black bg-white border-2 rounded-lg resize-none border-sky-400">
                                {{ $comment->comment }}</div>

                        </div>
                        <div class="mt-2 mb-10">
                            <div class="flex justify-between">
                                <span class="font-bold">
                                    <a href="{{ route('posts.index', $comment->user) }}">{{ $comment->user->username }}
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </span>
                                <span class="flex items-center gap-4 text-right">
                                    @if (auth()->user()->id == $comment->user_id)
                                        <form method="POST" class="text-sm text-red-500 cursor-pointer">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="#">Eliminar Comentario</button>
                                        </form>
                                    @endif
                                    <span class="flex items-center gap-1">

                                        {{ $comment->likes()->count() }} Likes
													 @if (auth()->check())
													 {{-- <form action="{{ route('likes.store', ['user' => auth()->user(), 'foreign' => $post]) }}" --}}
													 <form action="{{ route('likes.store') }}" method="POST">
														  @csrf
														  <input type="hidden" name="foreign" value="{{ $comment }}">
														  <input type="hidden" name="typeLike" value="comment">
														  <button type="submit"
																class="text-lg">{{ $comment->likes()->where('user_id', auth()->id())->where('comment_id', $comment->id)->exists()? '❌': '💖' }}</button>
													 </form>
												@endif
                                    </span>
                                </span>
                            </div>
                            <p></p>

                        </div>
                    @endforeach
                @else
                    <p
                        class="p-5 text-lg text-center text-black bg-white border-4 border-gray-400 border-dashed rounded-lg text-bold">
                        No hay comentarios en la publicación</p>
                @endif


            </div>
        </div>
    </div>
@endsection
