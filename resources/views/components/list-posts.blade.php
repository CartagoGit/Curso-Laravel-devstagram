{{ $title }}
<div class="flex flex-wrap justify-center">
    @foreach ($posts as $post)
        <article
            class="mx-4 my-4 flex h-auto basis-5/6 cursor-pointer flex-col overflow-hidden rounded-xl border border-gray-700 bg-gray-700 shadow transition-all duration-300 hover:ring hover:ring-gray-500 sm:basis-2/3 md:basis-2/5 lg:basis-1/4 xl:basis-1/5"
        >
            @if ($from === 'home')
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
            @endif
            <a
                class="flex h-full flex-col"
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
