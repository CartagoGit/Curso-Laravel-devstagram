@extends('layouts.app')

@section('titulo')
    {{ $post->title }}
@endsection

@section('contenido')
    <div class="container mx-auto flex flex-wrap justify-center gap-4">
        <div class="w-4/5 sm:w-[45%]">
            <div class="flex w-full justify-center">
                <img
                    class="rounded-xl border-4 border-dashed border-gray-300 shadow-lg sm:max-h-[400px]"
                    src="{{ $post->image }}"
                    alt="Imagen de la publicación {{ $post->title }}"
                >
            </div>

            <div>
                <div class="flex justify-between">
                    <span class="font-bold">
                        <a href="{{ route('posts.index', $post->user->username) }}">
                            {{ $post->user->username }}
                        </a>
                    </span>
                    <span class="flex items-center gap-1 text-right">
                        {{ $post->likes()->count() }} Likes
                        @if (auth()->check())
                            {{-- <form action="{{ route('likes.store', ['user' => auth()->user(), 'foreign' => $post]) }}" --}}
										<livewire:like-post />
                            @if ($post->checkUserLiked(auth()->user()))

                                <form
                                    novalidate
                                    action="{{ route('likes.destroy') }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <input
                                        name="foreign"
                                        type="hidden"
                                        value="{{ $post }}"
                                    >
                                    <input
                                        name="kindLike"
                                        type="hidden"
                                        value="post"
                                    >
                                    <button
                                        class="text-lg"
                                        type="submit"
                                    >
                                        ❌
                                    </button>
                                </form>
                            @else
                                <form
                                    novalidate
                                    action="{{ route('likes.store') }}"
                                    method="POST"
                                >
                                    @csrf
                                    <input
                                        name="foreign"
                                        type="hidden"
                                        value="{{ $post }}"
                                    >
                                    <input
                                        name="kindLike"
                                        type="hidden"
                                        value="post"
                                    >
                                    <button
                                        class="text-lg"
                                        type="submit"
                                    >
                                        {{-- {{ $post->likes()->where('user_id', auth()->id())->where('post_id', $post->id)->exists()? '❌': '💖' }} --}}
                                        {{-- {{ $post->checkUserLiked(auth()->user()) ? '❌' : '💖' }} --}}
                                        💖
                                    </button>
                                </form>
                            @endif
                        @endif

                    </span>
                </div>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}</p>
                <p
                    class="mt-5 rounded-xl bg-white p-3 shadow-lg outline outline-2 outline-gray-600">
                    {{ $post->description }}

                </p>
                {{-- {{ dd($post) }} --}}
                {{-- @if (auth()->id() == $post->user_id && $post->user && isset($post->user->path)) --}}
                @if (auth()->id() == $post->user_id)
                    <div class="mt-5 flex justify-between gap-10">
                        <a
                            class="l cursor-pointer rounded-lg bg-amber-600 p-3 font-bold uppercase text-white transition-colors hover:bg-amber-700"
                            href="#"
                        >
                            Editar publicación
                        </a>
                        <form
                            novalidate
                            action="{{ route('posts.destroy', [
                                'user' => $post->user->path,
                                'post' => $post->id,
                            ]) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                class="w-full cursor-pointer rounded-lg bg-red-600 p-3 font-bold uppercase text-white transition-colors hover:bg-red-700"
                                type="submit"
                            >
                                Eliminar publicación
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <form
            class="flex w-4/5 flex-col sm:w-[45%]"
            novalidate
            action="{{ route('comments.store', [
                'user' => $user,
                'post' => $post,
            ]) }}"
            method="POST"
        >

            @csrf
            @if (auth()->check())
                <div
                    class="flex h-full w-full flex-col rounded-lg bg-gray-200 p-5 shadow">
                    <p class="mb-4 text-center text-xl font-bold">
                        Agregar comentario
                    </p>
                    @if (session('message'))
                        <p
                            class="mb-2 w-full rounded-lg bg-green-500 p-2 text-center text-sm text-white">
                            {{ session('message') }}
                    @endif
                    <div class="flex h-full flex-col">
                        <div class="relative flex h-full">
                            <textarea
                                class="@error('comment') border-red-500 @enderror h-full max-h-[500px] min-h-[100px] w-full resize-y rounded-lg border p-3 focus:outline-gray-300"
                                id="comentario"
                                name="comentario"
                                type="text"
                                minlength="10"
                                maxlength="2200"
                                placeholder="Agregar comentario..."
                                oninput="updateCommentLength(this)"
                            ></textarea>
                            <span
                                class="absolute -bottom-4 right-0 text-xs text-gray-700"
                            >
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
                            <p
                                class="mt-6 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <button
                    class="mt-4 w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
                    type="submit"
                >
                    Enviar comentario
                </button>
            @else
                <div class="grid h-full w-full place-items-center p-5">
                    <p
                        class="mb-4 rounded-lg border-4 border-dashed border-gray-800 bg-sky-800 p-8 text-center text-xl font-bold text-white shadow">
                        Solo usuarios autenticados pueden hacer comentarios
                    </p>
                </div>
            @endif
        </form>
        <div
            class="mb-5 w-4/5 max-w-[700px] rounded-lg bg-gray-800 p-5 text-white shadow sm:w-[calc(90%+1rem)] sm:w-full">
            <p class="mb-4 text-center text-xl font-bold">
                Comentarios
            </p>
            <div class="flex h-full flex-col">
                @if ($post->comments->count() > 0)
                    @foreach ($post->comments as $comment)
                        <div class="relative flex h-full">
                            <div
                                class="w-full resize-none rounded-lg border-2 border-sky-400 bg-white p-3 text-left text-black"
                                name="comentario"
                                type="text"
                                disabled="true"
                                minlength="10"
                                maxlength="2200"
                            >
                                {{ $comment->comment }}</div>

                        </div>
                        <div class="mb-10 mt-2">
                            <div class="flex justify-between">
                                <span class="font-bold">
                                    <a
                                        href="{{ route('posts.index', $comment->user) }}">{{ $comment->user->username }}
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </span>
                                <span class="flex items-center gap-4 text-right">
                                    @if (auth()->check() && auth()->user()->id == $comment->user_id)
                                        <form
                                            class="cursor-pointer text-sm text-red-500"
                                            novalidate
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                href="#"
                                            >Eliminar Comentario</button>
                                        </form>
                                    @endif
                                    <span class="flex items-center gap-1">

                                        {{ $comment->likes()->count() }} Likes
                                        @if (auth()->check())
                                            {{-- <form action="{{ route('likes.store', ['user' => auth()->user(), 'foreign' => $post]) }}" --}}
                                            <form
                                                novalidate
                                                action="{{ route('likes.store') }}"
                                                method="POST"
                                            >
                                                @csrf
                                                <input
                                                    name="foreign"
                                                    type="hidden"
                                                    value="{{ $comment }}"
                                                >
                                                <input
                                                    name="kindLike"
                                                    type="hidden"
                                                    value="comment"
                                                >
                                                <button
                                                    class="text-lg"
                                                    type="submit"
                                                >
                                                    {{ $comment->likes()->where('user_id', auth()->id())->where('comment_id', $comment->id)->exists()? '❌': '💖' }}
                                                </button>
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
                        class="text-bold rounded-lg border-4 border-dashed border-gray-400 bg-white p-5 text-center text-lg text-black">
                        No hay comentarios en la publicación</p>
                @endif

            </div>
        </div>
    </div>
@endsection
