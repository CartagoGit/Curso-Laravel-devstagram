<span class="flex items-center gap-1">

    {{ $liked->likes()->count() }} Likes
    @if (auth()->check())

        {{-- @if ($liked->checkUserLiked(auth()->user())) --}}
        @php
            $isLikedByUser = $liked->checkUserLiked(auth()->user());
        @endphp
        <form
            novalidate
            action="{{ route('likes.' . ($isLikedByUser ? 'destroy' : 'store')) }}"
            method="POST"
        >
            @csrf
            @if ($isLikedByUser)
                @method('DELETE')
            @endif
            <input
                name="foreign"
                type="hidden"
                value="{{ $liked }}"
            >
            <input
                name="kindLike"
                type="hidden"
                value="{{ $kindLike }}"
            >
            <button
                class="text-lg"
                type="submit"
            >
                {{ $isLikedByUser ? '❌' : '💖' }}
            </button>
        </form>
        {{-- @else
        <form
            novalidate
            action="{{ route('likes.store') }}"
            method="POST"
        >
            @csrf
            <input
                name="foreign"
                type="hidden"
                value="{{ $liked }}"
            >
            <input
                name="kindLike"
                type="hidden"
                value="{{ $kindLike }}"
            >
            <button
                class="text-lg"
                type="submit"
            >

                💖
            </button>
        </form>
    @endif --}}
    @endif

</span>
