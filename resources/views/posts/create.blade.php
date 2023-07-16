@extends('layouts.app')

@push('styles')
    <link
        type="text/css"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        rel="stylesheet"
    />
    @vite('resources/css/dropzone.css')
@endpush

@section('titulo')
    Crear una nueva publicación
@endsection
@section('contenido')
    <div class="flex flex-col px-5 md:flex-row md:items-center lg:px-20">
        <div class="flex min-h-[200px] self-stretch px-10 md:w-1/2">
            <form
                class="dropzone rounder flex w-full cursor-pointer flex-col items-center justify-center rounded-xl border-[4px] border-dashed border-gray-200 bg-gray-50 shadow-xl transition-opacity hover:opacity-70"
                id="dropzone"
                novalidate
                action="{{ route('images.store') }}"
                method="POST"
                enctype="multipart"
            >
                @csrf
                <div
                    class="dz-message font-bold uppercase text-gray-500"
                    data-dz-message
                >
                    <span>
                        Suelta
                        <span class="underline">
                            aquí
                        </span>
                        tu imagen
                    </span>
                </div>
            </form>
        </div>
        <div class="mt-10 rounded-lg bg-white p-10 shadow-xl md:mt-0 md:w-1/2">
            <form
                novalidate
                action="{{ route('posts.store') }}"
                method="POST"
                novalidate
            >
                @csrf
                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="titulo"
                    >
                        Título de la publicación
                    </label>
                    <input
                        class="@error('titulo') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="titulo"
                        name="titulo"
                        type="text"
                        value="{{ old('titulo') }}"
                        placeholder="Título de la publicación"
                    />
                    @error('titulo')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="descripcion"
                    >
                        Descripción de la publicación
                    </label>
                    <div class="relative">
                        <textarea
                            class="@error('descripcion') border-red-500 @enderror h-[200px] max-h-[500px] min-h-[100px] w-full resize-y rounded-lg border p-3 focus:outline-gray-300"
                            id="descripcion"
                            name="descripcion"
                            type="text"
                            minlength="10"
                            maxlength="2200"
                            placeholder="Descripción de la publicación"
                            oninput="updateDescripcionLength(this)"
                        >{{ old('descripcion') }}</textarea>
                        <span
                            class="absolute -bottom-4 right-0 text-xs text-gray-400"
                        >
                            <span id="descripcion-length">
                                {{ strlen(old('descripcion')) }}
                            </span>/2200
                        </span>
                        <script>
                            function updateDescripcionLength(textarea) {
                                let descripcionLength = textarea.value.length;
                                document.getElementById('descripcion-length').textContent =
                                    descripcionLength;
                            }
                        </script>
                    </div>
                    @error('descripcion')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-5">
                    <input
                        name="imagen"
                        type="hidden"
                        value="{{ old('imagen') }}"
                    />
                    @error('imagen')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror
                </div>
                <button
                    class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
                    type="submit"
                >
                    Publicar
                </button>
            </form>
        </div>
    </div>
@endsection
