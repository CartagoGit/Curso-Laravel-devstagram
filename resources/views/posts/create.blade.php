@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
	 @vite('resources/css/dropzone.css')
@endpush

@section('titulo')
    Crear una nueva publicación
@endsection
@section('contenido')
    <div class="flex flex-col md:flex-row md:items-center px-5 lg:px-20">
        <div class="md:w-1/2 px-10 flex min-h-[200px] self-stretch">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart" id="dropzone"
                class="dropzone border-dashed border-gray-200 rounded-xl border-[4px] w-full rounder flex flex-col justify-center bg-gray-50 shadow-xl items-center cursor-pointer hover:opacity-70 transition-opacity">
					 @csrf
                <div class="dz-message text-gray-500 uppercase font-bold" data-dz-message>
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
        <div class="md:w-1/2 p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="
				{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Título de la publicación
                    </label>
                    <input id="titulo" type="text" name="titulo" placeholder="Título de la publicación"
                        class="border p-3 w-full rounded-lg focus:outline-gray-300 @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}" />
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción de la publicación
                    </label>
                    <div class="relative">
                        <textarea id="descripcion" type="text" name="descripcion" minlength="10" maxlength="2200"
                            placeholder="Descripción de la publicación" oninput="updateDescripcionLength(this)"
                            class="border p-3 w-full rounded-lg focus:outline-gray-300 resize-y h-[200px] min-h-[100px] max-h-[500px]  @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                        <span class="absolute text-xs right-0 -bottom-3 text-gray-400">
                            <span id="descripcion-length">
                                {{ strlen(old('descripcion')) }}
                            </span>/2200
                        </span>
                        <script>
                            function updateDescripcionLength(textarea) {
                                let descripcionLength = textarea.value.length;
                                document.getElementById('descripcion-length').textContent = descripcionLength;
                            }
                        </script>
                    </div>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror

                </div>
                <button type="submit"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full font-bold p-3 text-white rounded-lg">
                    Publicar
                </button>
            </form>
        </div>
    </div>
@endsection
