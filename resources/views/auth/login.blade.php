@extends('layouts.app')

@section('titulo')
    Login
@endsection

@section('contenido')
    <div class="md:flex md:items-center md:justify-center md:gap-10">
        <div
            class="p-5 md:w-6/12"
            novalidate
        >
            <img
                class="rounded-lg"
                src="{{ asset('img/auth/login.jpg') }}"
                alt="Imagen de registro de usuario"
            >
        </div>

        <div class="rounded-lg bg-white p-6 shadow-xl md:w-4/12">
            <form
                action="{{ route('login') }}"
                method="POST"
                novalidate
            >
                @csrf

                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="credencial"
                    >
                        Nick o email del usuario
                    </label>
                    <input
                        class="@error('credencial') border-red-500  @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="credencial"
                        name="credencial"
                        type="text"
                        value="{{ old('credencial') }}"
                        placeholder="Nick o email del usuario"
                    />
                    @error('credencial')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="password"
                    >
                        Contraseña
                    </label>
                    <input
                        class="@error('password') border-red-500   @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="password"
                        name="password"
                        type="password"
                        value="{{ old('password') }}"
                        placeholder="Contraseña"
                    />
                    @error('password')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                    />
                    <label
                        class="text-sm text-gray-500"
                        for="remember"
                    >
                        Recordar
                    </label>
                </div>

                <button
                    class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
                    type="submit"
                >
                    Iniciar sesión
                </button>
                @if (@session('loginFailed'))
                    <p
                        class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                        {{ @session('loginFailed') }}</p>
                @endif
            </form>
        </div>
    </div>
@endsection
