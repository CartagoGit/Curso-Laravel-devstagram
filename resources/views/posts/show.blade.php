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
                    <span class="text-right">0 Likes</span>
                </div>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5 rounded-xl border-2 border-gray-600 p-3 bg-white shadow-lg">
                    {{ $post->description }}

                </p>
            </div>
        </div>
        <div class="w-4/5 sm:w-1/2">
            <div class="shadow p-5 mb-5 rounded-lg bg-gray-300">
                <p class="text-xl font-bold text-center mb-4">
                    Agregar comentario
                </p>
                <form action="">
                    @csrf
                    <div class="relative">
                        <textarea id="descripcion" type="text" name="descripcion" minlength="10" maxlength="2200"
                            placeholder="Descripción de la publicación" oninput="updateDescripcionLength(this)"
                            class="border p-3 w-full rounded-lg focus:outline-gray-300 resize-y h-[200px] min-h-[100px] max-h-[500px]  @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                        <span class="absolute text-xs right-0 -bottom-3 text-gray-700">
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
                </form>
            </div>
				<div class="shadow p-5 mb-5 rounded-lg bg-gray-700 text-white">
					<p class="text-xl font-bold text-center mb-4">
						 Comentarios
					</p>
				</div>
        </div>
    </div>
@endsection
