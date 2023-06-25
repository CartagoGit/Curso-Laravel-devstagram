@extends('layouts.app')

@section('titulo')
    Registrarse en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/auth/registrar.jpg') }}" alt="Imagen de registro de usuario" class="rounded-lg">
        </div>

        <div class="md:w-4/12 p-6 bg-white rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="nombre" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input id="nombre" type="text" name="nombre" placeholder="Nombre"
                        class="border p-3 w-full rounded-lg  focus:outline-gray-300
                        @error('nombre') border-red-500  @enderror"
                        value="{{ old('nombre') }}" />
                    @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-5">
                    <label for="nick" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nick del usuario
                    </label>
                    <input id="nick" type="text" name="nick" placeholder="Nick del usuario"
                        class="border p-3 w-full rounded-lg  focus:outline-gray-300 @error('nick') border-red-500 @enderror"
                        value="{{ old('nick') }}" />
                    @error('nick')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" type="text" name="email" placeholder="Email"
                        class="border p-3 w-full rounded-lg focus:outline-gray-300 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input id="password" type="password" name="password" placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg focus:outline-gray-300  @error('password') border-red-500 @enderror"
                        value="{{ old('password') }}" />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Verificar Contraseña
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Contraseña de verificación"
                        class="border  focus:outline-gray-300 p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        value="{{ old('password_confirmation') }}" />

                </div>

                <input type="submit" value="Registrarse"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full font-bold p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection
