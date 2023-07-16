@extends('layouts.app')

@section('titulo')
    Registrarse en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:items-center md:justify-center md:gap-10">
        <div class="p-5 md:w-6/12">
            <img
                class="rounded-lg"
                src="{{ asset('img/auth/registrar.jpg') }}"
                alt="Imagen de registro de usuario"
            >
        </div>

        <div class="rounded-lg bg-white p-6 shadow-xl md:w-4/12">
            <form
                action="{{ route('register') }}"
                method="POST"
                novalidate
            >
                @csrf
                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="nombre"
                    >
                        Nombre
                    </label>
                    <input
                        class="@error('nombre') border-red-500  @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="nombre"
                        name="nombre"
                        type="text"
                        value=" {{ old('nombre') }}"
                        placeholder="Nombre"
                    />
                    @error('nombre')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror

                </div>

                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="nick"
                    >
                        Nick del usuario
                    </label>
                    <input
                        class="@error('nick') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="nick"
                        name="nick"
                        type="text"
                        value="{{ old('nick') }}"
                        placeholder="Nick del usuario"
                    />
                    @error('nick')
                        <p
                            class="my-2 w-full rounded-lg bg-red-500 p-2 text-center text-sm text-white">
                            {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="email"
                    >
                        Email
                    </label>
                    <input
                        class="@error('email') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="email"
                        name="email"
                        type="text"
                        value="{{ old('email') }}"
                        placeholder="Email"
                    />
                    @error('email')
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
                        class="@error('password') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
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
                    <label
                        class="mb-2 block font-bold uppercase text-gray-500"
                        for="password_confirmation"
                    >
                        Verificar Contraseña
                    </label>
                    <input
                        class="@error('password') border-red-500 @enderror w-full rounded-lg border p-3 focus:outline-gray-300"
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        value="{{ old('password_confirmation') }}"
                        placeholder="Contraseña de verificación"
                    />

                </div>

                <button
                    class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700"
                    type="submit"
                >
                    Registrarse
                </button>
            </form>
        </div>
    </div>
@endsection
