@extends('layouts.app')

@section('titulo')
    Login
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/auth/login.jpg') }}" alt="Imagen de registro de usuario" class="rounded-lg">
        </div>

        <div class="md:w-4/12 p-6 bg-white rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div class="mb-5">
                    <label for="credencial" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nick o email del usuario
                    </label>
                    <input id="credencial" type="text" name="credencial" placeholder="Nick o email del usuario"
                        class="border p-3 w-full rounded-lg focus:outline-gray-300 @error('credencial') border-red-500  @enderror"
                        value="{{ old('credencial') }}" />
                    @error('credencial')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input id="password" type="password" name="password" placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg focus:outline-gray-300 @error('password') border-red-500   @enderror"
                        value="{{ old('password') }}" />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember" />
                    <label class="text-gray-500 text-sm" for="remember">Recordar</label>
                </div>



                <button type="submit"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full font-bold p-3 text-white rounded-lg">Iniciar
                    sesión</button>
                @if (@session('loginFailed'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center w-full">
                        {{ @session('loginFailed') }}</p>
                @endif
            </form>
        </div>
    </div>
@endsection
