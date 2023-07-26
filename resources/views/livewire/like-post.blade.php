<span class="flex items-center gap-1">

    {{ $liked->likes()->count() }} Likes
    @if (auth()->check())
        <button
            class="text-lg"
            wire:click="clickLike"
        >
            <span class="text-lg">{{ $isLikedByUser ? '❌' : '💖' }}</span>
        </button>
    @endif

</span>
