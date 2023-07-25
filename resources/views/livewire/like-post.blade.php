<div>

    @if ($liked->checkUserLiked(auth()->user()))
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
    @endif

</div>
