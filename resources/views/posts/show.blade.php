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
                <p class="mt-5 rounded-xl outline outline-2 outline-gray-600 p-3 bg-white shadow-lg">
                    {{ $post->description }}

                </p>
            </div>
        </div>
        <form class="w-4/5 sm:w-[45%] flex flex-col">
            <div class="shadow p-5 w-full rounded-lg bg-gray-200 flex flex-col h-full">
                <p class="text-xl font-bold text-center mb-4">
                    Agregar comentario
                </p>
                <div class="h-full flex flex-col h-full">
                    @csrf
                    <div class="relative flex flex h-full">
                        <textarea id="comment" type="text" name="comment" minlength="10" maxlength="2200"
                            placeholder="Agregar comentario..." oninput="updateCommentLength(this)"
                            class="border p-3 w-full rounded-lg focus:outline-gray-300 resize-y h-[200px] min-h-[100px] h-full @error('comment') border-red-500 @enderror"></textarea>
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
                    @error('comment')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror
						</div>
					</div>
					<button type="submit"
						 class="mt-4 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full font-bold p-3 text-white rounded-lg">
						 Enviar comentario
					</button>
			</form>
			<div class="shadow p-5 mb-5 rounded-lg bg-gray-800 text-white w-4/5 sm:w-[calc(90%+1rem)] sm:w-full">
				 <p class="text-xl font-bold text-center mb-4">
					  Comentarios
				 </p>
			</div>
    </div>
@endsection
